<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index() {
        $this->load->model('Layanan_model');
        $data['layanan'] = $this->Layanan_model->get_all_layanan(); // Changed from get_all() to get_all_layanan()
        $this->load->view('home', $data);
    }
}