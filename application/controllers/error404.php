<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class error404 extends CI_Controller {

    public function index(){
        $this->load->view('_partials/v_head');
        $this->load->view('errors/404.php');
        $this->load->view('_partials/v_preloader');
        $this->load->view('_partials/v_js');
    }
}