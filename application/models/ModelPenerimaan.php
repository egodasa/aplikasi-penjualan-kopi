<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPenerimaan extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "penerimaan_stok";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["id_kopi", "id_user","tgl_terima","jumlah","no_faktur", "keterangan"];
    $this->view = "data_penerimaan_stok";
  }
}
