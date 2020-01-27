<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('m_login');
    }

    function index(){
        $this->load->view('v_login');
    }

    function aksi_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $admin = $this->m_login->cek_login($username, $password);
        if ($admin->num_rows() > 0){
            $admin = $admin->row();
            $data_session = array(
                'nama' => $admin->nama,
                'username' => $admin->username,
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect (base_url('admin'));
        }
        else {
            redirect (base_url('login'));
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect (base_url('login'));
    }
}