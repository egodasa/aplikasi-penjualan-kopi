<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaPemesanan extends MY_Controller {
  // Nama Tabel
  private $table = "pemesanan";
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelDetailPesanan", "detail_pesan");
    $this->load->model("ModelPemesanan", "pemesanan");
  }
  //  Method untuk menampilkan data
  public function daftar()
  {
    if(isset($this->input->get('id_pemesanan')))
    {
      $_SESSION['id_pemesanan_terpilih'] = $this->input->get('id_pemesanan');
    }
    $this->_dts['data_list'] = $this->detail_pesan->ambilDataDenganKondisi(['id_pesan' => $_SESSION['id_pemesanan_terpilih']]);  // Proses pengambilan data dari database
    $this->_dts['data_pemesanan'] = $this->pemesanan->ambilData($_SESSION['id_pemesanan_terpilih']);
    $this->view('detail-pemesanan', $this->_dts); // Oper data dari database ke view
  }
}
