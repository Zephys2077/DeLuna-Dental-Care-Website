<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dental_booking extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Dental_service_model', 'Dental_booking_model']);
    }
    
    public function services() {
        $data['layanan'] = $this->Dental_service_model->get_all_services();
        $this->load->view('dental/service_list', $data);
    }
    
    public function create($service_id) {
        if (!$this->session->userdata('patient_logged_in')) {
            redirect('auth/login');
        }

        $data['layanan'] = $this->Dental_service_model->get_service_by_id($service_id);
        
        if (!$data['layanan']) {
            show_404();
        }

        if ($this->input->post()) {
            $booking_data = [
                'tgl_jam' => $this->input->post('tgl_jam'),
                'id_pasien' => $this->session->userdata('patient_id'),
                'id_layanan' => $service_id,
                'keluhan' => $this->input->post('keluhan'),
                'harga' => $data['layanan']->harga,
                'status' => 'Pending'
            ];

            if ($this->Dental_booking_model->create_booking($booking_data)) {
                $this->session->set_flashdata('success', 'Booking berhasil dibuat');
                redirect('dental_booking/services');
            } else {
                $this->session->set_flashdata('error', 'Gagal membuat booking');
            }
        }
        
        $this->load->view('dental/booking_form', $data);
    }
}