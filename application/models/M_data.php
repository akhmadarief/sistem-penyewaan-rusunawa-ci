<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

    function data_penghuni(){
        return $this->db->get('penghuni');
    }

    function data_penghuni_by_id($id){
        return $this->db->get_where('penghuni', array('id' => $id));
    }

    function data_fakultas(){
        return $this->db->get('fakultas');
    }

    function data_prodi_by_id($id_fakultas){
        return $this->db->get_where('prodi', array('id_fakultas' => $id_fakultas));
    }

    function data_kamar_by_lantai($lantai){
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->like('lantai', $lantai, 'after');
        return $this->db->get();
    }

    function data_penghuni_by_kamar($no_kamar){
        return $this->db->get_where('penghuni', array('no_kamar' => $no_kamar));
    }

    function cek_kamar($no_kamar){
        return $this->db->get_where('kamar', array('no_kamar' => $no_kamar));
    }

    function insert_penghuni($data){
        $this->db->insert('penghuni', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function update_status_kamar($no_kamar, $status_kamar){
        $this->db->where('no_kamar', $no_kamar);
        $this->db->update('kamar', array('status' => $status_kamar));
    }

    function delete_penghuni($id){
        $this->db->delete('penghuni', array('id' => $id));
        return ($this->db->affected_rows() != 1 ? false : true);
    }
}
