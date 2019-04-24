<?php

/**
 *
 */
class Mahasiswa_model extends CI_Model
{
  public function getMahasiswa($id = null){

    if ($id === null) {
      $query = $this->db->get('mahasiswa')->result_array();
    }else{
      $query = $this->db->get_where('mahasiswa',['id' => $id])->result_array();
    }
    return $query;

  }

  public function deleteMahasiswa($id){

    $this->db->delete('mahasiswa',['id' => $id]);
    return $this->db->affected_rows();

  }

  public function createMahasiswa($data){

    $this->db->insert('mahasiswa', $data);
    return $this->db->affected_rows();

  }

  public function updateMahasiswa($data, $id){

    $this->db->update('mahasiswa', $data, ['id' => $id]);
    return $this->db->affected_rows();

  }

}





 ?>
