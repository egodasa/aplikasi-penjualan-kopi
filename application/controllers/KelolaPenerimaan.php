<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class KelolaPenerimaan extends MY_Controller {
  // Nama Tabel
  private $table = "penerimaan_stok";
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelKopi", "kopi");
    $this->load->model("ModelPenerimaan", "penerimaan");
  }
  //  Method untuk menampilkan data
  public function daftar()
  {
    $this->_dts['data_list'] = $this->penerimaan->ambilData();  // Proses pengambilan data dari database
    $this->_dts['data_kopi'] = $this->kopi->ambilData();  // Proses pengambilan data dari database
    $this->view('penerimaan', $this->_dts); // Oper data dari database ke view
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $data = $this->input->post(NULL, TRUE);
    $this->penerimaan->tambahData($data);
    
    header("Location: ".site_url("penerimaan")); // Arahkan kembali user ke halaman daftar
  }
  
  public function cetakFaktur($id)
  {
    $this->_dts['data'] = $this->penerimaan->ambilData($id);
    $content = $this->renderView('cetak-faktur-penerimaan', $this->_dts);
    $dompdf = new Dompdf(array('enable_remote' => true));
    $dompdf->loadHtml($content);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    
    $dompdf->stream("faktur-penerimaan.pdf", array("Attachment" => false));
    exit(0);
  }
  
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $id = $this->input->post("id");
    $data_baru = $this->input->post(NULL, TRUE);
    
    $this->penerimaan->ubahData($id, $data_baru);
    
    header("Location: ".site_url("penerimaan")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->penerimaan->hapusData($this->input->get('id')); // Proses hapus data
    header("Location: ".site_url("penerimaan")); // // Arahkan user kembali ke halaman daftar
  }
}
