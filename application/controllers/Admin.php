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
        $this->load->view('_partials/v_js');
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
        $this->load->view('_partials/v_js');
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

        $cek_kamar = $this->m_data->cek_kamar($no_kamar)->row();

        if (!isset($no_kamar)) redirect('admin/pilih_kamar');

        else if (!$cek_kamar) show_404();

        else if ($cek_kamar->status == 'terisi2') echo '<script>alert ("Kamar sudah terisi penuh, silakan pilih kamar lain"); window.location="'.base_url('admin/pilih_kamar').'";</script>';

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

        $data['judul_halaman'] = 'Edit Penghuni';
        $data['fakultas'] = $this->m_data->data_fakultas()->result();
        $data['penghuni'] = $this->m_data->data_penghuni_by_id($id)->row();

        if (!$data['penghuni']) show_404();

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
        $data['penghuni'] = $this->m_data->data_penghuni()->result();
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
        $this->load->view('_partials/v_js');
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
        $this->load->view('_partials/v_js');
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
        $this->load->view('_partials/v_js');
    }
}
