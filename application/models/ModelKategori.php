<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKategori extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "kategori";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["nama_kategori"];
   
  }
}
