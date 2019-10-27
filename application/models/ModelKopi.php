<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKopi extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "kopi";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["id_kategori","nama","gambar","stok","harga","satuan","deskripsi", "berat", "diskon"];
    $this->view = "data_kopi";
  }
  public function tambahKopi($id, $jumlah)
  {
  	$this->db->query("UPDATE kopi SET stok = stok + ".$jumlah." WHERE id = ".$id);
  }
}
