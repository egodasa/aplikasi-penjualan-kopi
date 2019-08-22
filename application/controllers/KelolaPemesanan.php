<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

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
    $this->_dts['data_list'] = $this->pemesanan->ambilData();  // Proses pengambilan data dari database
    $this->_dts['data_user'] = $this->user->ambilData();  // Proses pengambilan data dari database
    $this->view('pemesanan', $this->_dts); // Oper data dari database ke view
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $this->program->tambahData($this->input->post(NULL, TRUE));
    
    header("Location: ".site_url("pemesanan")); // Arahkan kembali user ke halaman daftar
  }
  
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $this->program->ubahData($this->input->post("id"), $this->input->post(NULL, TRUE));
    
    header("Location: ".site_url("pemesanan")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->program->hapusData($this->input->get('id')); // Proses hapus data
    
    header("Location: ".site_url("pemesanan")); // // Arahkan user kembali ke halaman daftar
  }
  
  public function detailPemesanan($id_pesan)
  {
    $this->_dts['data_pemesanan'] = $this->pemesanan->ambilData($id_pesan);
    $this->_dts['data_list'] = $this->detail_pesan->ambilDataDenganKOndisi(["id_pesan" => $id_pesan]);
    $this->view('detail-pemesanan', $this->_dts); // Oper data dari database ke view
  }
  
  public function tambahNoResi()
  {
    $data = $this->input->post(NULL, true);
    $this->pemesanan->updateNoResi($data['id'], $data['noresi']);
    
    notifikasi("Berhasil", "Nomor Resi berhasil ditambahkan", "success");
    header("Location: ".site_url("pemesanan")); // Arahkan kembali user ke halaman daftar
  }
}
