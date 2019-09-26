<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

use Coreproc\CryptoGuard\CryptoGuard;

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
      header("Location: ".site_url("/"));
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
    session_destroy();
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
  
  public function lupaPassword(){
  	$email = $this->input->post("email");
  	$data_user = $this->user->ambilDataDenganKondisi(["email" => $email]);
  	
  	if(count($data_user) == 1)
  	{
  		$waktu = date("Y-m-d H:i:s");
  		$waktu = date('Y-m-d H:i:s', strtotime("+1 hours", strtotime($waktu)));
  		
  		$cryptoGuard = new CryptoGuard(base_url().site_url());

			$token = $cryptoGuard->encrypt($waktu." ".$email);

			// echo $cryptoGuard->decrypt($token);

       //kode untuk mengirim email
    	$from = "noreply@solok-radjo.dafma.id";
    	$to = $email;
    	$subject = "Reset Password Akun Solok Radjo";
    	$message = "Silahkan klik atau akses URL BERIKUT ".site_url('reset-password?token='.$token)." untuk melakukan reset password akun website Solok Radjo. Link tersebut hanya berlaku 1 jam.";
    	$headers = "From:" . $from;
    	mail($to,$subject,$message, $headers);
    	
    	
  		notifikasi("Berhasil", "Silahkan cek email Anda untuk petunjuk cara mereset password", "success");
  	}
  	else
  	{
  		notifikasi("Peringatan", "Email yang Anda masukkan belum terdaftar", "danger");
  	}
  	header('Location: '.site_url('/'));
  }
  
  public function resetPassword()
  {
  	if(empty($this->input->get("token")))
  	{
  		notifikasi("Peringatan", "Anda tidak berhak mengakses halaman ini!", "danger");
  	}
  	else
  	{ 
  		$token = $this->input->get("token");
	  	$cryptoGuard = new CryptoGuard(base_url().site_url());
			$hasil_token = $cryptoGuard->decrypt($token);
			$hasil_token = explode(" ", $hasil_token);
			$email = $hasil_token[2];
			$waktu = $hasil_token[0]." ".$hasil_token[1];
			$waktu_sekarang = date("Y-m-d H:i:s");
			$selisih_waktu = selisihWaktu($waktu, $waktu_sekarang);
			if($selisih_waktu['hari'] == 0 && $selisih_waktu['jam'] == 0)
			{
				$this->_dts['token'] = $token;
				$this->view("reset-password", $this->_dts);	
			}
			else
			{
				notifikasi("Peringatan", "Anda tidak berhak mengakses halaman ini!", "danger");	
				header('Location: '.site_url('/'));
			}
  	}
  	
  }
  
  public function prosesResetPassword()
  {
  	if(empty($this->input->post("token")))
  	{
  		notifikasi("Peringatan", "Anda tidak berhak mengakses halaman ini!", "danger");
  	}
  	else
  	{
  		$token = $this->input->post("token");
	  	$cryptoGuard = new CryptoGuard(base_url().site_url());
			$hasil_token = $cryptoGuard->decrypt($token);
			$hasil_token = explode(" ", $hasil_token);
			$email = $hasil_token[2];
			$waktu = $hasil_token[0]." ".$hasil_token[1];
			$waktu_sekarang = date("Y-m-d H:i:s");
			$selisih_waktu = selisihWaktu($waktu, $waktu_sekarang);
			
			if($selisih_waktu['hari'] == 0 && $selisih_waktu['jam'] == 0)
			{
				$pass = $this->input->post("password");
				$this->user->resetPassword($email, $pass);
				notifikasi("Berhasil", "Password berhasil direset!", "success");	
			}
			else
			{
				notifikasi("Peringatan", "Anda tidak berhak mengakses halaman ini!", "danger");	
			}
  	}
  	header('Location: '.site_url('/'));
  }
}
