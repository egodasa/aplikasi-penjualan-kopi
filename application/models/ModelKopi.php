<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKopi extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "kopi";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["id_kategori","nama","gambar","stok","harga","satuan","deskripsi"];
    $this->view = "data_kopi";
  }
}
