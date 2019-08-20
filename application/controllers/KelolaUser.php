<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaUser extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelUser", "user");
  }
  //  Method untuk menampilkan data
  public function daftar()
  {
    $this->_dts['data_list'] = $this->user->ambilData();  // Proses pengambilan data dari database
    $this->view('user', $this->_dts); // Oper data dari database ke view
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $this->user->tambahData($this->input->post(NULL, TRUE));
    
    header("Location: ".site_url("user")); // Arahkan kembali user ke halaman daftar
  }
  
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $this->user->ubahData($this->input->post("id"), $this->input->post(NULL, TRUE));
    
    header("Location: ".site_url("user")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->user->hapusData($this->input->get('id')); // Proses hapus data
    
    header("Location: ".site_url("user")); // // Arahkan user kembali ke halaman daftar
  }
}
