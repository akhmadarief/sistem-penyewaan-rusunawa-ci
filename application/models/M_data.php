<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

    function data_penghuni($where){
        // $this->db->select('id, no_kamar, nama, nim, penghuni.id_prodi, nama_prodi, penghuni.id_fakultas, nama_fakultas, tempat_lahir, tgl_lahir, agama, alamat, no, nama_ortu, pekerjaan_ortu, alamat_ortu, no_ortu, tgl_masuk, tgl_keluar, kategori, isi_kamar, status, biaya');
        // $this->db->select_sum('bayar');
        // $this->db->from('penghuni');
        // $this->db->join('prodi', 'penghuni.id_prodi = prodi.id_prodi');
        // $this->db->join('fakultas', 'penghuni.id_fakultas = fakultas.id_fakultas');
        // $this->db->join('keuangan', 'penghuni.id = keuangan.id_penghuni', 'left');
        // $this->db->where($where);
        // $this->db->group_by(array('id', 'no_kamar', 'nama', 'nim', 'id_prodi', 'nama_prodi', 'id_fakultas', 'nama_fakultas', 'tempat_lahir', 'tgl_lahir', 'agama', 'alamat', 'no', 'nama_ortu', 'pekerjaan_ortu', 'alamat_ortu', 'no_ortu', 'tgl_masuk', 'tgl_keluar', 'kategori', 'isi_kamar', 'status', 'biaya'));
        // $this->db->order_by('no_kamar', 'asc');
        // return $this->db->get();
        return $this->db->get_where('data_penghuni', $where);
    }

    function data_pembayaran($where){
        // $this->db->select('id_penghuni, id_pembayaran, no_kamar, nama, penghuni.nim, tgl_bayar, biaya, bayar');
        // $this->db->from('penghuni');
        // $this->db->join('keuangan', 'penghuni.id = keuangan.id_penghuni');
        // $this->db->where($where);
        // $this->db->order_by("STR_TO_DATE(tgl_bayar,'%d-%m-%Y') DESC");
        // return $this->db->get();
        return $this->db->get_where('data_pembayaran', $where);
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

    function update_penghuni($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('penghuni', $data) ? true : false;
    }

    function update_pembayaran($id_pembayaran, $data){
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->update('keuangan', $data) ? true : false;
    }

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
