<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Patient_model');
        $this->load->model('Reservasi_model'); // Tambahkan ini
    }

    public function dashboard() {
        if (!$this->session->userdata('patient_logged_in')) {
            redirect('patient/login');
        }
        
        $this->load->model('Layanan_model');
        $data['layanan'] = $this->Layanan_model->get_all_layanan();
        
        // Load riwayat reservasi
        $data['reservasi'] = $this->Reservasi_model->get_patient_reservations(
            $this->session->userdata('patient_id')
        );
        
        $this->load->view('patient/dashboard', $data);
    }

    public function reservasi($action = '', $id = '') {
        if (!$this->session->userdata('patient_logged_in')) {
            redirect('patient/login');
        }

        if ($action == 'add' && $id) {
            // Load layanan model
            $this->load->model('Layanan_model');
            $data['layanan'] = $this->Layanan_model->get_layanan_by_id($id);
            
            if (!$data['layanan']) {
                $this->session->set_flashdata('error', 'Layanan tidak ditemukan');
                redirect('patient/dashboard');
            }

            if ($this->input->post()) {
                $reservasi_data = [
                    'tgl_jam' => $this->input->post('tgl_jam'),
                    'id_pasien' => $this->session->userdata('patient_id'),
                    'id_layanan' => $id,
                    'keluhan' => $this->input->post('keluhan'),
                    'harga' => $data['layanan']->harga,
                    'status' => 'Pending'
                ];

                if ($this->Reservasi_model->create($reservasi_data)) {
                    $this->session->set_flashdata('success', 'Reservasi berhasil dibuat');
                    redirect('patient/reservasi/list');
                } else {
                    $this->session->set_flashdata('error', 'Gagal membuat reservasi');
                }
            }

            $this->load->view('patient/reservasi_form', $data);
        }
    }

    public function create_reservation($id_layanan = null) {
        if (!$this->session->userdata('patient_logged_in')) {
            redirect('patient/login');
        }

        $this->load->model('Layanan_model');
        $data['layanan'] = $this->Layanan_model->get_layanan_by_id($id_layanan);
        
        if (!$data['layanan']) {
            show_404();
        }

        if ($this->input->post()) {
            $reservasi_data = [
                'tgl_jam' => $this->input->post('tgl_jam'),
                'id_pasien' => $this->session->userdata('patient_id'),
                'id_layanan' => $id_layanan,
                'keluhan' => $this->input->post('keluhan'),
                'harga' => $data['layanan']->harga,
                'status' => 'Pending'
            ];

            if ($this->Reservasi_model->insert($reservasi_data)) {
                $this->session->set_flashdata('success', 'Reservasi berhasil dibuat');
                redirect('patient/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Gagal membuat reservasi');
            }
        }
        
        $this->load->view('patient/create_reservation', $data);
    }

    public function reservasi_history() {
        if (!$this->session->userdata('patient_logged_in')) {
            redirect('patient/login');
        }
    
        $this->load->model(['Reservasi_model', 'Layanan_model']);
        
        $data['reservasi'] = $this->Reservasi_model->get_patient_reservations(
            $this->session->userdata('patient_id')
        );
        
        $this->load->view('patient/reservasi_history', $data);
    }

    public function reschedule() {
        if (!$this->session->userdata('patient_logged_in')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }
    
        $this->load->model('Reservasi_model');
        
        $data = [
            'tgl_jam' => $this->input->post('new_datetime')
        ];
        
        $reservation_id = $this->input->post('reservation_id');
        
        $update = $this->Reservasi_model->update($reservation_id, $data);
        
        if ($update) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengubah jadwal']);
        }
    }
}