<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

    function __construct(){
        parent::__construct();
        if ($this->session->userdata('status') != 'login'){
            redirect (base_url('login'));
        }
        $this->load->model('m_data');
    }

    function index(){
        $data['judul_halaman'] = 'Dasbor';
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_dasbor'); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js', $data);
    }

    function dasbor(){
        $data['judul_halaman'] = 'Dasbor';
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_dasbor'); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js', $data);
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
        $this->load->view('_partials/v_js', $data);
    }

    function tambah_penghuni(){
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
        $this->load->view('_partials/v_js', $data);
    }

    function edit_penghuni($id){
        $data['judul_halaman'] = 'Edit Penghuni';
        $data['penghuni'] = $this->m_data->data_penghuni_by_id($id)->row();
        $data['fakultas'] = $this->m_data->data_fakultas()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_edit_penghuni', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js', $data);
    }

    function daftar_kamar(){
        $data['judul_halaman'] = 'Daftar Kamar';
        $data['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_daftar_kamar', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js', $data);
    }

    function daftar_harga(){
        $data['judul_halaman'] = 'Daftar Harga Kamar';
        $data['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_daftar_harga', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js', $data);
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
        $this->load->view('_partials/v_js', $data);
    }

    function laporan_keuangan(){
        $data['judul_halaman'] = 'Laporan Keuangan';
        $data['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_laporan_keuangan', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js', $data);
    }

    function laporan_piutang(){
        $data['judul_halaman'] = 'Laporan Piutang';
        $data['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_laporan_piutang', $data); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js', $data);
    }

    function kosong(){
        $data['judul_halaman'] = 'Kosong';
        $this->load->view('_partials/v_head', $data);
        $this->load->view('_partials/v_header');
        $this->load->view('_partials/v_sidebar', $data);
        $this->load->view('_partials/v_breadcrump', $data);
        $this->load->view('v_kosong'); //page content
        $this->load->view('_partials/v_footer');
        $this->load->view('_partials/v_theme-config');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js', $data);
    }
}