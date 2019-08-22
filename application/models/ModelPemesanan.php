<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPemesanan extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "pemesanan";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["id_user","tgl_pesan","nama_ekspedisi","total_ongkir","status","noresi"];
    $this->view = "data_pemesanan";
  }
  public function laporanPenjualan()
  {
      return $this->db->query("SELECT pemesanan.id, pemesanan.id_user, pemesanan.tgl_pesan, pemesanan.nama_ekspedisi, SUM(detail_pesan.jumlah) AS jumlah_beli, (SUM(kopi.harga*detail_pesan.jumlah)+ pemesanan.total_ongkir) AS total_bayar FROM pemesanan JOIN detail_pesan ON pemesanan.id = detail_pesan.id_pesan JOIN kopi ON detail_pesan.id_kopi = kopi.id ")->fetchAll(PDO::FETCH_ASSOC);
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
