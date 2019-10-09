<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPemesanan extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "pemesanan";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["id_user","tgl_pesan","nama_ekspedisi","total_ongkir","status","noresi", "alamat"];
    $this->view = "data_pemesanan";
  }
  public function laporanPenjualan($kondisi = "1", $parameter_kondisi = [])
  {
    return $this->db->query("SELECT * FROM laporan_penjualan WHERE ".$kondisi, $parameter_kondisi)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function updateStatusPemesanan($id, $status)
  {
    $this->db->update($this->tabel, [
      "status" => $status
    ],[
      $this->primaryKey => $id
    ]);
    return true;
  }
  public function updateNoResi($id, $noresi)
  {
    $this->db->update($this->tabel, [
      "noresi" => $noresi,
      "status" => "Sudah dikirim"
    ],[
      $this->primaryKey => $id
    ]);
    return true;
  }
}
