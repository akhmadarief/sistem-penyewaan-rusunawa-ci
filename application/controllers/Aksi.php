<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aksi extends CI_Controller {

    function __construct(){
        parent::__construct();
        if ($this->session->userdata('status') != 'login'){
            redirect (base_url('login'));
        }
        $this->load->model('m_data');
    }

    function get_prodi(){
        $id_fakultas =  $this->input->post('id_fakultas');
        $prodi = $this->m_data->data_prodi_by_id($id_fakultas);

        echo '<option></option>';
        foreach ($prodi->result() as $prodi){
            echo '<option value="'.$prodi->id_prodi.'">'.$prodi->nama_prodi.'</option>';
        }
    }

    function get_kamar(){
        $lantai = $this->input->post('lantai');
        $kamar = $this->m_data->data_kamar_by_lantai($lantai);

        echo json_encode($kamar->result());
    }

    function get_detail_kamar(){
        $no_kamar = $this->input->post('no_kamar');
        $detail_kamar = $this->m_data->data_penghuni_by_kamar($no_kamar);

        echo json_encode ($detail_kamar->result());
    }

    function aksi_tambah_penghuni(){
        $no_kamar       = $this->input->post('no_kamar');
        $isi_kamar      = $this->input->post('isi_kamar');
        $nama           = $this->input->post('nama');
        $nim            = $this->input->post('nim');
        $id_fakultas    = $this->input->post('id_fakultas');
        $id_prodi       = $this->input->post('id_prodi');
        $tempat_lahir   = $this->input->post('tempat_lahir');
        $tgl_lahir      = $this->input->post('tgl_lahir');
        $agama          = $this->input->post('agama');
        $alamat         = $this->input->post('alamat');
        $no             = $this->input->post('no');
        $nama_ortu      = $this->input->post('nama_ortu');
        $pekerjaan_ortu = $this->input->post('pekerjaan_ortu');
        $alamat_ortu    = $this->input->post('alamat_ortu');
        $no_ortu        = $this->input->post('no_ortu');
        $tgl_masuk      = $this->input->post('tgl_masuk');
        $tgl_keluar     = $this->input->post('tgl_keluar');
        $kategori       = $this->input->post('kategori');

        $data = array(
            'no_kamar'      => $no_kamar,
            'isi_kamar'     => $isi_kamar,
            'nama'          => $nama,
            'nim'           => $nim,
            'id_fakultas'   => $id_fakultas,
            'id_prodi'      => $id_prodi,
            'tempat_lahir'  => $tempat_lahir,
            'tgl_lahir'     => $tgl_lahir,
            'agama'         => $agama,
            'alamat'        => $alamat,
            'no'            => $no,
            'nama_ortu'     => $nama_ortu,
            'pekerjaan_ortu'=> $pekerjaan_ortu,
            'alamat_ortu'   => $alamat_ortu,
            'no_ortu'       => $no_ortu,
            'tgl_masuk'     => $tgl_masuk,
            'tgl_keluar'    => $tgl_keluar,
            'kategori'      => $kategori
        );

        if ($this->m_data->insert_penghuni($data) == true){
            $cek_kamar = $this->m_data->cek_kamar($no_kamar)->row();

            if ($cek_kamar->status == 'kosong' and $isi_kamar == '2') $status_kamar = 'terisi1';

            else if ($cek_kamar->status == 'kosong' and $isi_kamar == '1') $status_kamar = 'sendiri';

            else if ($cek_kamar->status == 'terisi1') $status_kamar = 'terisi2';

            $this->m_data->update_status_kamar($no_kamar, $status_kamar);

            //redirect('admin/pilih_kamar');
            echo 'berhasil disimpan gan';
        }
        else {
            echo 'gagal disimpan gan :(';
        }
    }

    function aksi_hapus_penghuni($id = null){

        if (!isset($id)) redirect('admin/daftar_penghuni');

        if ($this->m_data->delete_penghuni($id) == true){
            //redirect('admin/daftar_penghuni');
            echo 'berhasil dihapus gan';
        }
        else {
            echo 'gagal gan :(';
        }
    }
}
