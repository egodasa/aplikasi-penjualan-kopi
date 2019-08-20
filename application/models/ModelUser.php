<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelUser extends MY_Model {
  function __construct()
  {
    parent::__construct();
    $this->tabel = "users";
    $this->primaryKey = "id";
    $this->kolomBawaanCrud = ["nama", "email","telepon","username","password","akses_level"];
  }
  public function editProfil($id, $data)
  {
    $this->db->update($this->table, [
       "nama" => $data["nama"],    // daftar kolom yang akan diedit ke tabel
      "email" => $data["email"],
      "telepon" => $data["telepon"]
    ],[
      $this->primaryKey => $id
    ]);
    return true;
  }
 public function gantiPassword($id, $data)
  {
    $this->db->update($this->table, [
       "password" => $data["password"]   // daftar kolom yang akan diedit ke tabel
      
    ],[
      $this->primaryKey => $id
    ]);
    return true;
  }
 
}
