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
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('dasbor'); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function dasbor(){
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('dasbor'); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function pilih_kamar(){
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('pilih_kamar'); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function tambah_penghuni(){
        $data_fakultas['fakultas'] = $this->m_data->data_fakultas()->result();
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('tambah_penghuni', $data_fakultas); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function edit_penghuni(){
        $data_fakultas['fakultas'] = $this->m_data->data_fakultas()->result();
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('edit_penghuni', $data_fakultas); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function daftar_harga(){
        $data_penghuni['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('daftar_harga', $data_penghuni); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function daftar_kamar(){
        $data_penghuni['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('daftar_kamar', $data_penghuni); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function daftar_penghuni(){
        $data_penghuni['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('daftar_penghuni', $data_penghuni); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function laporan_keuangan(){
        $data_penghuni['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('laporan_keuangan', $data_penghuni); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function laporan_piutang(){
        $data_penghuni['penghuni'] = $this->m_data->data_penghuni()->result();
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('laporan_piutang', $data_penghuni); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }

    function kosong(){
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('_partials/sidebar');
        $this->load->view('kosong'); //page content
        $this->load->view('_partials/footer');
        $this->load->view('_partials/theme-config');
        $this->load->view('_partials/preloader');
        $this->load->view('_partials/js');
    }
}