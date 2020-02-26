<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct(){
        parent::__construct();
        if ($this->session->userdata('status') != 'login'){
            redirect (base_url('login'));
        }
        $this->load->model('m_data');
    }

    function super_user(){
        if ($this->session->userdata('username') != 'admin'){
            redirect (base_url(''));
        }
    }

    function index(){
        $data = $this->jumlah_kamar();
        $data['judul_halaman'] = 'Dasbor';
        $data['total'] = $this->m_data->total_data_keuangan()->row();
        $data['username'] = $this->session->userdata('username');

        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('v_dasbor'); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function doncu(){ //buat cek query
        $where = array('1' => '1');
        // $nim = '12431';
        // $no_kamar = 'A2.20';
        //$data['doncu']=$this->m_data->data_harga_kamar_by_no_kamar('A2.01');
        //$this->m_data->detail_penghuni(array('nim' => $nim, 'no_kamar' => $no_kamar, 'status' => 'Penghuni'));
        $a = (($this->m_data->data_harga_kamar_by_no_kamar('A2.01')->row())->harga) + $penghuni->harga;
        echo $a;
        // $tgl_keluar = date('d-m-Y', strtotime('20-02-2020'));
        // $tgl_keluar_baru = date('d-m-Y', strtotime($tgl_keluar.' + 1 year'));
        // echo $tgl_keluar_baru;
    }

    function dasbor(){
        $data = $this->jumlah_kamar();
        $data['judul_halaman'] = 'Dasbor';
        $data['total'] = $this->m_data->total_data_keuangan()->row();
        $data['username'] = $this->session->userdata('username');

        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('v_dasbor'); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function jumlah_kamar(){
        $data['a']=$this->m_data->jumlah_penghuni_gedung('A');
        $data['b']=$this->m_data->jumlah_penghuni_gedung('B');
        $data['c']=$this->m_data->jumlah_penghuni_gedung('C');
        $data['d']=$this->m_data->jumlah_penghuni_gedung('D');
        $data['e']=$this->m_data->jumlah_penghuni_gedung('E');
        return $data;
    }

    function pilih_kamar(){
        $data['judul_halaman'] = 'Pilih Kamar';
        $data['username'] = $this->session->userdata('username');

        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_pilih_kamar'); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function tambah_penghuni($no_kamar = null){

        if (!isset($no_kamar)) redirect('admin/pilih_kamar');

        $cek_kamar = $this->m_data->cek_kamar($no_kamar)->row();

        if (!$cek_kamar) show_404();

        else if (strpos($cek_kamar->status, 'terisi2') !== false or strpos($cek_kamar->status, 'sendiri') !== false) echo '<script>alert ("Kamar sudah terisi penuh, silakan pilih kamar lain"); window.location="'.base_url('admin/pilih_kamar').'";</script>';

        $data['judul_halaman'] = 'Tambah Penghuni';
        $data['username'] = $this->session->userdata('username');
        $data['harga_kamar'] = $this->m_data->data_harga_kamar_by_lantai($cek_kamar->lantai)->row();
        $data['no_kamar'] = $no_kamar;
        $data['status_kamar'] = $cek_kamar->status;
        $data['fakultas'] = $this->m_data->data_fakultas()->result();

        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_tambah_penghuni', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function edit_penghuni($id = null){

        if (!isset($id)) redirect('admin/daftar_penghuni');

        $data['penghuni'] = $this->m_data->detail_penghuni(array('id' => $id))->row();

        if (!$data['penghuni']) show_404();

        $id_fakultas = $data['penghuni']->id_fakultas;

        $data['judul_halaman'] = 'Edit Penghuni';
        $data['username'] = $this->session->userdata('username');
        $data['kamar'] = $this->m_data->data_kamar_tersedia()->result();
        $data['prodi'] = $this->m_data->data_prodi_by_id_fakultas($id_fakultas)->result();
        $data['fakultas'] = $this->m_data->data_fakultas()->result();

        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_edit_penghuni', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function daftar_kamar(){
        $data['judul_halaman'] = 'Daftar Kamar';
        $data['username'] = $this->session->userdata('username');
        $data['kamar'] = $this->m_data->data_kamar()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_daftar_kamar', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function daftar_kamar_cetak(){
        $data['kamar'] = $this->m_data->data_kamar()->result();
        $this->load->view('v_daftar_kamar_cetak', $data);
    }

    function daftar_harga(){
        $data['judul_halaman'] = 'Daftar Harga Kamar';
        $data['username'] = $this->session->userdata('username');
        $data['daftar_harga'] = $this->m_data->data_harga_kamar()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_daftar_harga', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function daftar_penghuni(){
        $data['judul_halaman'] = 'Daftar Penghuni';
        $data['username'] = $this->session->userdata('username');
        $data['penghuni'] = $this->m_data->detail_penghuni(array('status' => 'Penghuni'))->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_daftar_penghuni', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function daftar_ekspenghuni(){
        $data['judul_halaman'] = 'Daftar Eks-Penghuni';
        $data['username'] = $this->session->userdata('username');
        $data['penghuni'] = $this->m_data->detail_penghuni(array('status' => 'Eks-Penghuni'))->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_daftar_penghuni', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function daftar_penghuni_cetak(){
        $data['penghuni'] = $this->m_data->detail_penghuni(array('status' => 'Penghuni'))->result();
        $this->load->view('v_daftar_penghuni_cetak', $data);
    }

    function riwayat_pembayaran(){
        $data['judul_halaman'] = 'Riwayat Pembayaran';
        $data['username'] = $this->session->userdata('username');
        $data['pembayaran'] = $this->m_data->detail_pembayaran(array('1' => '1'))->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_riwayat_pembayaran', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function edit_pembayaran($id_pembayaran = null){

        if (!isset($id_pembayaran)) redirect('admin/riwayat_pembayaran');

        $data['judul_halaman'] = 'Edit Pembayaran';
        $data['username'] = $this->session->userdata('username');
        $data['pembayaran'] = $this->m_data->detail_pembayaran(array('id_pembayaran' => $id_pembayaran))->row();

        if (!$data['pembayaran']) show_404();

        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_edit_pembayaran', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function riwayat_pembayaran_cetak(){
        $data['judul_halaman'] = 'Riwayat Pembayaran';
        $data['username'] = $this->session->userdata('username');
        $data['pembayaran'] = $this->m_data->detail_pembayaran(array('1' => '1'))->result();
        $this->load->view('v_riwayat_pembayaran_cetak', $data); //page content
    }

    function laporan_keuangan(){
        $data['judul_halaman'] = 'Laporan Keuangan';
        $data['username'] = $this->session->userdata('username');
        $data['keuangan'] = $this->m_data->detail_penghuni(array('1' => '1'))->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_laporan_keuangan', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function laporan_keuangan_cetak(){
        $data['keuangan'] = $this->m_data->detail_penghuni(array('1' => '1'))->result();
        //$data['keuangan'] = $this->m_data->data_keuangan_per_penghuni()->result();
        $this->load->view('v_laporan_keuangan_cetak', $data);
    }

    function laporan_piutang(){
        $data['judul_halaman'] = 'Laporan Piutang';
        $data['username'] = $this->session->userdata('username');
        $data['penghuni'] = $this->m_data->detail_penghuni(array('1' => '1'))->result();
        $data['keuangan1'] = $this->m_data->detail_penghuni(array('1' => '1'))->result();
        //$data['keuangan1'] = $this->m_data->data_keuangan_per_penghuni()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_laporan_piutang', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function tabel_user(){
        $this->super_user();
        $data['judul_halaman'] = 'Daftar User';
        $data['username'] = $this->session->userdata('username');
        $data['user'] = $this->m_data->data_user()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_tabel_user', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function ubah_pass(){
        $data['judul_halaman'] = 'Ubah Password';
        $data['pesan'] = $this->session->flashdata('pesan');
        $data['username'] = $this->session->userdata('username');
        $this->load->view('_partials/v_head_form', $data);
        $this->load->view('v_ubah_pass');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js_form');
    }

    function tambah_user(){
        $this->super_user();
        $data['judul_halaman'] = 'Tambah User';
        $data['pesan'] = $this->session->flashdata('pesan');
        $this->load->view('_partials/v_head_form', $data);
        $this->load->view('v_tambah_user');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js_form');
    }
}
