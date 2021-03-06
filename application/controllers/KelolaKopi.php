<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaKopi extends MY_Controller {
  // Nama Tabel
  private $table = "kopi";
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelKopi", "kopi");
    $this->load->model("ModelPemesanan", "pemesanan");
    $this->load->model("ModelKategori", "kategori");
    $this->load->model("ModelKeranjang", "keranjang");
  }
  //  Method untuk menampilkan data
  public function daftar()
  {
    $this->_dts['data_list'] = $this->kopi->ambilData();  // Proses pengambilan data dari database
    $this->_dts['data_kategori'] = $this->kategori->ambilData();  // Proses pengambilan data dari database
    $this->view('kopi', $this->_dts); // Oper data dari database ke view
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $data = $this->input->post(NULL, TRUE);
    $data['gambar'] = fileUpload($_FILES['gambar'], "./assets/img/");
    $this->kopi->tambahData($data);
    
    header("Location: ".site_url("kopi")); // Arahkan kembali user ke halaman daftar
  }
  
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $id = $this->input->post("id");
    $data_lama = $this->kopi->ambilData($id);
    $foto_lama = $data_lama['gambar'];
    $foto_baru = $data_lama['gambar'];
    $data_baru = $this->input->post(NULL, TRUE);
    
    // jika gambar baru diupload, maka hapus gambar lama dan upload gambar baru
    if(file_exists($_FILES['gambar']['tmp_name']) || is_uploaded_file($_FILES['gambar']['tmp_name']))
    {
        unlink("./assets/img/".$foto_lama);
        $foto_baru = fileUpload($_FILES['gambar'], "./assets/img/");
    }
    
    $data_baru['gambar'] = $foto_baru;

    $this->kopi->ubahData($this->input->post("id"), $data_baru);
    
    header("Location: ".site_url("kopi")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->kopi->hapusData($this->input->get('id')); // Proses hapus data
    
    header("Location: ".site_url("kopi")); // // Arahkan user kembali ke halaman daftar
  }
  public function detailKopi($id)
  {
    $this->_dts['detail_kopi'] = $this->kopi->ambilData($id);
    $this->view('detail-produk', $this->_dts);
  }
  
  public function tambahKeranjang()
  {
    $this->keranjang->tambahData($this->input->post(NULL, true));
    notifikasi("Berhasil", "Produk berhasil ditambahkan ke keranjang", "success");
    header("Location: ".site_url());
  }
  
  public function keranjang()
  {
    $this->_dts['data_list'] = $this->keranjang->ambilDataDenganKondisi(["id_user" => $_SESSION['id']]);
    $this->view('keranjang', $this->_dts);
  }
  
  public function editKeranjang()
  {
    $data_keranjang = $this->input->post("id");
    foreach($data_keranjang as $nomor => $data)
    {
      $this->keranjang->editKeranjang($data, $this->input->post("jumlah")[$nomor]);
    }
    notifikasi("Berhasil", "Keranjang produk berhasil diedit", "success");
    header("Location: ".site_url('keranjang'));
  }
  public function hapusKeranjang($id)
  {
    $this->keranjang->hapusData($id);
    notifikasi("Berhasil", "Produk berhasil dihapus", "success");
    header("Location: ".site_url('keranjang'));
  }
  
  public function checkout()
  {
    $this->_dts['data_list'] = $this->keranjang->ambilDataDenganKondisi(["id_user" => $_SESSION['id']]);
    $this->view('checkout', $this->_dts);
  }
  public function prosesCheckout()
  {
    $id_pesan = $this->pemesanan->tambahData($this->input->post(NULL, true));
    $this->keranjang->checkout($_SESSION['id'], $id_pesan);
    notifikasi("Berhasil", "Pemesanan berhasil dilakukan.", "success");
    header("Location: ".site_url('/'));
  }
  public function cetakLaporanKopi()
  {
    $this->_dts['data_list'] = $this->kopi->ambilData();
    $this->view("cetak-laporan-kopi", $this->_dts);
  }
}
