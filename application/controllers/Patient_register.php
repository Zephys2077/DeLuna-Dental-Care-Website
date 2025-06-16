<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_register extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Patient_model');
    }

    public function index()
    {
        $this->load->model('Pasien_model');
        // Clear any cached data
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        
        $data['generated_id'] = $this->Pasien_model->get_last_id();
        $this->load->view('auth/patient_register', $data);
    }

    public function register() {
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = date('d-m-Y', strtotime($this->input->post('tanggal_lahir')));
        
        $data = array(
            'id_pasien' => $this->input->post('id_pasien'),
            'nama_pasien' => $this->input->post('nama_pasien'),
            'no_hp' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
            'tempat_tgl_lahir' => $tempat_lahir . ', ' . $tanggal_lahir
        );

        // Remove direct insert and only use the model method
        if($this->Patient_model->register($data)) {
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('Patient_login');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar.');
            redirect('Patient_register');
        }
    }
}