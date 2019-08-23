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
  public function getKota()
  {
    $url = "https://api.rajaongkir.com/starter/city";
    $query_string = http_build_query($_GET);
    
    if(!empty($_GET))
    {
      $url .= "?".$query_string;
    }
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: 7e0dc077f101a5076023d132112fb690"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    
    $result_tmp = json_decode($response);
    $result = [];
    
    $result['code'] = $result_tmp->rajaongkir->status->code;
    $result['message'] = $result_tmp->rajaongkir->status->description;
    $result['data'] = null;
    
    if (!$err) {
      $result['data'] = $result_tmp->rajaongkir->results;
    }
    
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
  public function getProvinsi()
  {
    $url = "https://api.rajaongkir.com/starter/province";
    $query_string = http_build_query($_GET);
    
    if(!empty($_GET))
    {
      $url .= "?".$query_string;
    }
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: 7e0dc077f101a5076023d132112fb690"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    
    $result_tmp = json_decode($response);
    $result = [];
    
    $result['code'] = $result_tmp->rajaongkir->status->code;
    $result['message'] = $result_tmp->rajaongkir->status->description;
    $result['data'] = null;
    
    if (!$err) {
      $result['data'] = $result_tmp->rajaongkir->results;
    }
    
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
  public function getOngkir()
  {
    $url = "https://api.rajaongkir.com/starter/cost";
    $query_string = http_build_query($_GET);
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $query_string,
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 7e0dc077f101a5076023d132112fb690"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    
    $result_tmp = json_decode($response);
    $result = [];
    
    $result['code'] = $result_tmp->rajaongkir->status->code;
    $result['message'] = $result_tmp->rajaongkir->status->description;
    $result['data'] = null;
    
    if (!$err) {
      $result['data'] = $result_tmp->rajaongkir->results;
    }
    
    echo json_encode($result, JSON_PRETTY_PRINT);
  }
}
