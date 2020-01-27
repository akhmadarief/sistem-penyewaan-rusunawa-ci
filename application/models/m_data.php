<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_data extends CI_Model {

    function data_penghuni(){
        return $this->db->get('penghuni');
    }

    function data_fakultas(){
        return $this->db->get('fakultas');
    }

    function data_prodi($id_fakultas){
        return $this->db->get_where('prodi', array('id_fakultas' => $id_fakultas));
    }

    function data_kamar($lantai){
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->like('lantai', $lantai, 'after');
        return $this->db->get();
    }

    function detail_kamar($no_kamar, $status){
        return $this->db->get_where('penghuni', array('no_kamar' => $no_kamar, 'status' => $status));
    }
}