<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Patient_model');
    }

    public function index() {
        $this->load->view('auth/patient_login');
    }

    public function auth() {
        $id_pasien = $this->input->post('id_pasien');
        $no_hp = $this->input->post('no_hp');
        
        $patient = $this->Patient_model->check_login($id_pasien, $no_hp);
        
        if($patient) {
            $this->session->set_userdata([
                'patient_logged_in' => true,
                'patient_id' => $patient->id_pasien,
                'patient_name' => $patient->nama_pasien
            ]);
            redirect('patient/dashboard');
        } else {
            $this->session->set_flashdata('error', 'ID Pasien atau Nomor HP salah');
            redirect('Patient_login');
        }
    }
}