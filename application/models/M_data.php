<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {
    
    function data_penghuni(){
        $this->db->order_by('no_kamar', 'asc');
        return $this->db->get('penghuni');
    }
    
    function data_penghuni_by_id($id){
        $this->db->select('*');
        $this->db->from('penghuni');
        $this->db->join('prodi', 'penghuni.id_prodi = prodi.id_prodi');
        $this->db->where('id', $id);
        return $this->db->get();
    }

    function data_penghuni_by_kamar($no_kamar){
        $this->db->select('id, no_kamar, nama, penghuni.nim, no, nama_prodi, tgl_masuk, tgl_keluar, biaya');
        $this->db->select_sum('bayar');
        $this->db->from('keuangan');
        $this->db->join('penghuni', 'keuangan.nim = penghuni.nim');
        $this->db->join('prodi', 'penghuni.id_prodi = prodi.id_prodi');
        $this->db->where('no_kamar', $no_kamar);
        $this->db->group_by(array('id', 'no_kamar', 'nama', 'nim', 'no', 'nama_prodi', 'tgl_masuk', 'tgl_keluar', 'biaya'));
        return $this->db->get();
    }

    function data_fakultas(){
        return $this->db->get('fakultas');
    }

    function data_prodi_by_id_fakultas($id_fakultas){
        return $this->db->get_where('prodi', array('id_fakultas' => $id_fakultas));
    }

    function data_kamar(){
        return $this->db->get('kamar');
    }

    function data_kamar_tersedia(){
        $this->db->select('*');
        $this->db->where('status', 'kosong');
        $this->db->or_where('status', 'terisi1');
        return $this->db->get('kamar');
    }

    function data_harga_kamar(){
        return $this->db->get('harga');
    }

    function data_harga_kamar_by_lantai($lantai){
        return $this->db->get_where('harga', array('lantai' => $lantai));
    }

    function data_kamar_by_lantai($lantai){
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->like('lantai', $lantai, 'after');
        return $this->db->get();
    }

    function cek_kamar($no_kamar){
        return $this->db->get_where('kamar', array('no_kamar' => $no_kamar));
    }

    function insert_penghuni($data){
        $this->db->insert('penghuni', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    function update_status_kamar($no_kamar, $data_update_kamar){
        $this->db->where('no_kamar', $no_kamar);
        $this->db->update('kamar', $data_update_kamar);
    }

    function insert_pembayaran($data_pembayaran){
        return $this->db->insert('keuangan', $data_pembayaran) ? true : false;
    }

    function data_pembayaran(){
        $this->db->select('*');
        $this->db->from('keuangan');
        $this->db->join('penghuni', 'keuangan.nim = penghuni.nim');
        $this->db->order_by('id_pembayaran', 'asc');
        return $this->db->get();
    }

    function data_keuangan_per_penghuni(){
        $this->db->select('no_kamar, nama, penghuni.nim, biaya');
        $this->db->select_sum('bayar');
        $this->db->from('keuangan');
        $this->db->join('penghuni', 'keuangan.nim = penghuni.nim');
        $this->db->group_by(array('no_kamar', 'nama', 'nim', 'biaya'));
        return $this->db->get();
    }

    function data_keuangan_per_penghuni_by_nim($nim){
        $this->db->select('penghuni.nim, no_kamar, nama, biaya');
        $this->db->select_sum('bayar');
        $this->db->from('keuangan');
        $this->db->join('penghuni', 'keuangan.nim = penghuni.nim');
        $this->db->where('penghuni.nim !=', $nim);
        $this->db->group_by(array('no_kamar', 'nama', 'nim', 'biaya'));
        return $this->db->get();
    }

    function data_keuangan_per_penghuni_by_nim_2($nim){
        $this->db->select('penghuni.nim, no_kamar, nama, biaya, isi_kamar');
        $this->db->select_sum('bayar');
        $this->db->from('keuangan');
        $this->db->join('penghuni', 'keuangan.nim = penghuni.nim');
        $this->db->where('penghuni.nim', $nim);
        $this->db->group_by(array('no_kamar', 'nama', 'nim', 'biaya', 'isi_kamar'));
        return $this->db->get();
    }

    function update_penghuni($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('penghuni', $data) ? true : false;
    }
/*
    function update_penghuni($id, $data){
        $this->db->where('id', $id);
        $this->db->update('penghuni', $data);
        //$this->db->ins;
        //return $this->db->update('penghuni', $data) ? true : false;
    }
*/
    function delete_penghuni($id){
        $this->db->delete('penghuni', array('id' => $id));
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    function jumlah_penghuni_gedung($gedung){
        return array(
            'terisi1' => $this->db->get_where('kamar', "gedung = '$gedung' AND (status = 'terisi1' OR status = 'terisi1 piutang')")->num_rows(),
            'terisi2' => $this->db->get_where('kamar', "gedung = '$gedung' AND (status = 'terisi2' OR status = 'terisi2 piutang')")->num_rows(),
            'sendiri' => $this->db->get_where('kamar', array('gedung' => $gedung, 'status' => 'sendiri'))->num_rows()
        );
    }
/*
    function update_password($username, $password, $password_baru){
        //$this->db->where(array('username' => $username, 'password' => $password));
        return $this->db->update('admin', array('username' => $username, 'password' => $password), array('password' => $password_baru)) ? true : false;
    }
*/

    // function data_user_by_username($username){
    //     $this->db->select('*');
    //     $this->db->from('admin');
    //     $this->db->where('username', $username);
    //     return $this->db->get();
    // }

    function update_password($username, $password_baru){
        $this->db->where('username', $username);
        return $this->db->update('admin', array('password' => $password_baru)) ? true : false;
    }

    function data_user(){
        $this->db->select('nama, username');
        $this->db->where('username !=', 'admin');
        return $this->db->get('admin');
    }

    function insert_user($user_baru){
        $this->db->insert('admin', $user_baru);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    function delete_user($username){
        $this->db->delete('admin', array('username' => $username));
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
