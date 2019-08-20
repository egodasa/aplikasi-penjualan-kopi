<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDetailPesanan extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "detail_pesan";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["id_pesan","id_kopi","jumlah"];
    $this->view = "data_detail_pesan";
  }
}
