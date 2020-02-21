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
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        //$this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_dasbor'); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }

    function dasbor(){
        $data = $this->jumlah_kamar();
        $data['judul_halaman'] = 'Dasbor';
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        //$this->load->view('_partials/v_breadcrump', $data);
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

        $data['harga_kamar'] = $this->m_data->data_harga_kamar_by_lantai($cek_kamar->lantai)->row();
        $data['no_kamar'] = $no_kamar;
        $data['status_kamar'] = $cek_kamar->status;
        $data['judul_halaman'] = 'Tambah Penghuni';
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

        $data['penghuni'] = $this->m_data->data_penghuni_by_id($id)->row();

        if (!$data['penghuni']) show_404();

        $id_fakultas = $data['penghuni']->id_fakultas;

        $data['kamar'] = $this->m_data->data_kamar_tersedia()->result();
        $data['prodi'] = $this->m_data->data_prodi_by_id_fakultas($id_fakultas)->result();
        //$data['prodi1'] = $this->m_data->data_prodi_by_id_fakultas($id_fakultas)->result();
        $data['judul_halaman'] = 'Edit Penghuni';
        $data['fakultas'] = $this->m_data->data_fakultas()->result();
        //$data['fakultas1'] = $this->m_data->data_fakultas()->result();

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
        $data['penghuni'] = $this->m_data->data_penghuni()->result();
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
        $data['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('v_daftar_penghuni_cetak', $data);
    }

    function riwayat_pembayaran(){
        $data['judul_halaman'] = 'Riwayat Pembayaran';
        $data['pembayaran'] = $this->m_data->data_pembayaran()->result();
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
        $data['pembayaran'] = $this->m_data->data_pembayaran_by_id_pembayaran($id_pembayaran)->row();

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
        $data['pembayaran'] = $this->m_data->data_pembayaran()->result();
        $this->load->view('v_riwayat_pembayaran_cetak', $data); //page content
    }

    function laporan_keuangan(){
        $data['judul_halaman'] = 'Daftar Piutang';
        $data['keuangan'] = $this->m_data->data_keuangan_per_penghuni()->result();
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
        $data['keuangan'] = $this->m_data->data_keuangan_per_penghuni()->result();
        $this->load->view('v_laporan_keuangan_cetak', $data);
    }

    function laporan_piutang(){
        $data['judul_halaman'] = 'Daftar Piutang';
        $data['penghuni'] = $this->m_data->data_penghuni()->result();
        $data['keuangan1'] = $this->m_data->data_keuangan_per_penghuni()->result();
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
        $data['username'] = $this->session->userdata('username');
        $this->load->view('_partials/v_head_form', $data);
        $this->load->view('v_ubah_pass');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js_form');
    }

    function ubah_pass_gagal(){
        $data['judul_halaman'] = 'Ubah Password';
        $data['username'] = $this->session->userdata('username');
        $this->load->view('_partials/v_head_form', $data);
        $this->load->view('v_ubah_pass_gagal');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js_form');
    }

    function tambah_user(){
        $this->super_user();
        $data['judul_halaman'] = 'Tambah User';
        $this->load->view('_partials/v_head_form', $data);
        $this->load->view('v_tambah_user');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js_form');
    }

    function tambah_user_gagal(){
        $this->super_user();
        $data['judul_halaman'] = 'Tambah User';
        $this->load->view('_partials/v_head_form', $data);
        $this->load->view('v_tambah_user_gagal');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js_form');
    }
}
