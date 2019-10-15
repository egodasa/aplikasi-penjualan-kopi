<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Medoo\medoo;

class KelolaPemesanan extends MY_Controller {
  // Nama Tabel
  private $table = "pemesanan";
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelPemesanan", "pemesanan");
    $this->load->model("ModelDetailPesanan", "detail_pesan");
    $this->load->model("ModelUser", "user");
  }
  //  Method untuk menampilkan data
  public function daftar()
  {
  	if($_SESSION['akses_level'] == "Admin")
  	{
  		$this->_dts['data_list'] = $this->pemesanan->ambilData();  // Proses pengambilan data dari database	
  	}
  	else
  	{
  		$this->_dts['data_list'] = $this->pemesanan->ambilDataDenganKondisi(["id_user" => $_SESSION['id']]);  // Proses pengambilan data dari database
  	}
    
    $this->_dts['data_user'] = $this->user->ambilData();  // Proses pengambilan data dari database
    $this->view('pemesanan', $this->_dts); // Oper data dari database ke view
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $this->pemesanan->tambahData($this->input->post(NULL, TRUE));
    
    header("Location: ".site_url("pemesanan")); // Arahkan kembali user ke halaman daftar
  }
  
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $this->pemesanan->ubahData($this->input->post("id"), $this->input->post(NULL, TRUE));
    
    header("Location: ".site_url("pemesanan")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->pemesanan->hapusData($this->input->get('id')); // Proses hapus data
    
    header("Location: ".site_url("pemesanan")); // // Arahkan user kembali ke halaman daftar
  }
  
  public function detailPemesanan($id_pesan)
  {
    $this->_dts['data_pemesanan'] = $this->pemesanan->ambilData($id_pesan);
    $this->_dts['data_list'] = $this->detail_pesan->ambilDataDenganKOndisi(["id_pesan" => $id_pesan]);
    $this->view('detail-pemesanan', $this->_dts); // Oper data dari database ke view
  }
  
  public function cetakFaktur($id_pesan)
  {
    $this->_dts['data_pemesanan'] = $this->pemesanan->ambilData($id_pesan);
    $this->_dts['data_list'] = $this->detail_pesan->ambilDataDenganKOndisi(["id_pesan" => $id_pesan]);
    $content = $this->renderView('cetak-faktur', $this->_dts);
    $dompdf = new Dompdf(array('enable_remote' => true));
    $dompdf->loadHtml($content);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    
    $dompdf->stream("faktur.pdf", array("Attachment" => false));
    exit(0);
  }
  
  public function tambahNoResi()
  {
    $data = $this->input->post(NULL, true);
    $this->pemesanan->updateNoResi($data['id'], $data['noresi']);
    
    notifikasi("Berhasil", "Nomor Resi berhasil ditambahkan", "success");
    header("Location: ".site_url("pemesanan")); // Arahkan kembali user ke halaman daftar
  }
  public function laporanPemesanan()
  {
    $this->view("laporan-pemesanan");
  }
  public function cetakLaporanPemesanan()
  {
  	$view = "cetak-laporan-pemesanan";
    $parameter_kondisi = [];
    
    $data = $this->input->get(NULL,  true);
    $judul = "";
    $parameter_kondisi = [];
    switch($data['jenis'])
    {
      case "harian":
        $judul = "HARIAN";
        $kondisi .= " DATE(tgl_pesan) = DATE(:tgl_pesan)";
        $parameter_kondisi[':tgl_pesan'] = $data['tgl_pesan'];
        $this->_dts['data_list'] = $this->pemesanan->laporanPenjualan($kondisi, $parameter_kondisi);
      break;
      case "bulanan":
        $judul = " BULANAN";
        $kondisi .= " LEFT(tgl_pesan, 7) = LEFT(:tgl_pesan, 7)";
        $parameter_kondisi[':tgl_pesan'] = $data['tgl_pesan'];
        $this->_dts['data_list'] = $this->pemesanan->laporanPenjualan($kondisi, $parameter_kondisi);
      break;
      case "tahunan":
      	$tahun = substr($data['tgl_pesan'], 0, 4);
        $judul = "Tahun ".substr($data['tgl_pesan'], 0, 4);
        $kondisi .= " LEFT(tgl_pesan, 4) = LEFT(:tgl_pesan, 4)";
        $parameter_kondisi[':tgl_pesan'] = $data['tgl_pesan'];
        $this->_dts['data_list'] = $this->db->query("Select 
																	kopi.nama,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-01'), 0) as januari, 
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-02'), 0) as februari,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-03'), 0) as maret,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-04'), 0) as april,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-05'), 0) as mei,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-06'), 0) as juni,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-07'), 0) as juli,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-08'), 0) as agustus,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-09'), 0) as september,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-10'), 0) as oktober,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-11'), 0) as november,
																	IFNULL((SELECT SUM(data_detail_pesan.sub_total) 
																	FROM data_detail_pesan WHERE data_detail_pesan.id_kopi = kopi.id and 
																	`data_detail_pesan`.`status` not in ('Belum bayar','Sedang diverifikasi','Pembayaran ditolak') AND 
																	LEFT(data_detail_pesan.tgl_pesan, 7) = '".$tahun."-22'), 0) as desember 
																	From kopi 
																	")->fetchAll(PDO::FETCH_ASSOC);
																	$view = "cetak-laporan-pemesanan-tahunan";
      break;
      case "periode":
        $judul = "Laporan Penjualan Per Periode <br> Tanggal ".TanggalIndo($data['tgl_pesan_awal'])." - ".TanggalIndo($data['tgl_pesan_akhir']);
        $kondisi .= "DATE(tgl_pesan) >= DATE(:tgl_pesan_awal) AND DATE(tgl_pesan) <= DATE(:tgl_pesan_akhir)";
        $parameter_kondisi[':tgl_pesan_awal'] = $data['tgl_pesan_awal'];
        $parameter_kondisi[':tgl_pesan_akhir'] = $data['tgl_pesan_akhir'];
        $this->_dts['data_list'] = $this->pemesanan->laporanPenjualan($kondisi, $parameter_kondisi);
      break;
    }
    $kondisi.= " AND status IN ('Pembayaran diterima','Sudah dikirim')";
    $this->_dts['judul'] = $judul;
    $this->view($view, $this->_dts);
  }
}
