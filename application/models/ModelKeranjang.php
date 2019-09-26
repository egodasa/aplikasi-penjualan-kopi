<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKeranjang extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "keranjang";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["id_user","id_kopi","jumlah", "diskon"];
    $this->view = "data_keranjang";
  }

  public function editKeranjang($id, $jumlah)
  {
    $this->db->update($this->tabel, [
      "jumlah" => $jumlah    // daftar kolom yang akan diedit ke tabel
    ],[
      $this->primaryKey => $id
    ]);
    return true;
  }

  public function checkout($id_user, $id_pesan)
  {
    $this->db->query("INSERT INTO detail_pesan (id_pesan, id_kopi, jumlah, diskon) SELECT :id_pesan AS id_pesan, id_kopi, jumlah, diskon FROM keranjang WHERE id_user = :id_user", [":id_pesan" => $id_pesan, ":id_user" => $id_user]);
    $this->db->query("DELETE FROM keranjang WHERE id_user = :id_user", [":id_user" => $id_user]);
    return true;
  }
}
