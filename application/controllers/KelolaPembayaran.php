<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaPembayaran extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelPembayaran", "pembayaran");
    $this->load->model("ModelPemesanan", "pemesanan");
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function konfirmasiPembayaran()
  {
    $data = $this->input->post(NULL, TRUE);
    $data['bukti_bayar'] = fileUpload($_FILES['bukti_bayar'], "./assets/img/");
    $data['status_bayar'] = "Belum Diperiksa";
    
    $this->pembayaran->tambahData($data);
    $this->pemesanan->updateStatusPemesanan($data['id_pesan'], "Sedang diverifikasi");
    
    notifikasi("Berhasil", "Pembayaran berhasil dikonfirmasi", "success");
    header("Location: ".site_url("pemesanan")); // Arahkan kembali user ke halaman daftar
  }
  
  public function verifikasiPembayaran()
  {
    $data = $this->input->post(NULL, true);
    $status_pemesanan = "";
    $this->pembayaran->updateStatusPembayaran($data['id'], $data['status_bayar']);
    
    if($data['status_bayar'] == 'Diterima')
    {
      $status_pemesanan = "Pembayaran diterima";
    }
    else
    {
      $status_pemesanan = "Pembayaran ditolak";
    }
    
    $this->pemesanan->updateStatusPemesanan($data['id'], $status_pemesanan);
    
    notifikasi("Berhasil", "Pembayaran berhasil verifikasi", "success");
    header("Location: ".site_url("pemesanan")); // Arahkan kembali user ke halaman daftar
  }
}
