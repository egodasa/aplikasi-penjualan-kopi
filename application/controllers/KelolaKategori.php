<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaKategori extends MY_Controller {
  // Nama Tabel
  private $table = "kategori";
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelKategori", "kategori");
  }
  //  Method untuk menampilkan data
  public function daftar()
  {
    $this->_dts['data_list'] = $this->kategori->ambilData();  // Proses pengambilan data dari database
    $this->view('kategori', $this->_dts); // Oper data dari database ke view
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $this->kategori->tambahData($this->input->post(NULL, TRUE));
    
    header("Location: ".site_url("kategori")); // Arahkan kembali user ke halaman daftar
  }
  
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $this->kategori->ubahData($this->input->post("id"), $this->input->post(NULL, TRUE));
    
    header("Location: ".site_url("kategori")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->kategori->hapusData($this->input->get('id')); // Proses hapus data
    
    header("Location: ".site_url("kategori")); // // Arahkan user kembali ke halaman daftar
  }
}
