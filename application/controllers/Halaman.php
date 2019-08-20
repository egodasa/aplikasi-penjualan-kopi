<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelUser", "user");
    $this->load->model("ModelKopi", "kopi");
  }
  
  public function home()
  {
    $this->_dts['data_list'] = $this->kopi->ambilData();
    $this->view("home", $this->_dts);
  }
  public function prosesLogin()
  {
    $cek = $this->user->ambilDataDenganKondisi(["username" => $this->input->post('username'), "password" => $this->input->post('password')]);
    if(count($cek) == 0)
    {
      notifikasi("Peringatan", "Username atau password salah!", "danger");
      header('Location: '.site_url('/'));
    }
    else
    {
      $_SESSION = $cek[0];
      header('Location: '.site_url('/'));
      notifikasi("Pesan", "Anda berhasil login", "success");
      
    }
  }
  
  public function prosesRegister()
  {
    $cek = $this->user->ambilDataDenganKondisi(["OR" => ["email" => $this->input->post("email"), "username" => $this->input->post("username")]]);
    if(count($cek) > 0)
    {
      notifikasi("Registrasi gagal!", "Username atau email sudah pernah digunakan!", "warning");
      header("Location: ".site_url("admin/register"));
    }
    else
    {
      $this->user->tambahData($this->input->post(NULL, TRUE));
      notifikasi("Registrasi berhasil.", "Anda sudah bisa login sekarang.", "success");
      header("Location: ".site_url("/"));
    }
  }
  public function prosesLogout()
  {
    unset($_SESSION['username']);
    notifikasi("Pesan", "Anda berhasil logout", "success");
    header('Location: '.site_url('/'));
  }
  public function dilarang()
  {
    $this->view('dilarang');
  }
}
