<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPembayaran extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "pembayaran";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["id_pesan","jumlah_bayar","nama_bank","norek","tgl_bayar","status_bayar","bank_tujuan","norek_tujuan","bukti_bayar"];
    $this->view = "data_pembayaran";
  }
}
