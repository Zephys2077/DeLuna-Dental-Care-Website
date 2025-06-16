<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Pasien_model');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Data Pasien';
        $data['pasien'] = $this->Pasien_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pasien/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Pasien';
        
        // Generate new ID Pasien (format: D001, D002, etc)
        $last_id = $this->db->query("SELECT MAX(CAST(SUBSTRING(id_pasien, 2) AS SIGNED)) as last_number FROM pasien")->row();
        $number = ($last_id && $last_id->last_number) ? $last_id->last_number + 1 : 1;
        $data['new_id'] = 'D' . str_pad($number, 3, '0', STR_PAD_LEFT);

        if ($this->input->post()) {
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tanggal_lahir = date('d-m-Y', strtotime($this->input->post('tanggal_lahir')));
            
            $data = array(
                'id_pasien' => $data['new_id'], // Use generated ID instead of POST data
                'nama_pasien' => $this->input->post('nama_pasien'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'tempat_tgl_lahir' => $tempat_lahir . ', ' . $tanggal_lahir
            );
            
            $this->db->insert('pasien', $data);
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            redirect('pasien');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pasien/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Pasien';
        $data['pasien'] = $this->Pasien_model->get_by_id($id);
        
        if($this->input->post()) {
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tanggal_lahir = date('d-m-Y', strtotime($this->input->post('tanggal_lahir')));
            
            $data = array(
                'nama_pasien' => $this->input->post('nama_pasien'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'tempat_tgl_lahir' => $tempat_lahir . ', ' . $tanggal_lahir
            );
            
            $this->Pasien_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
            redirect('pasien');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pasien/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        try {
            if ($this->Pasien_model->delete($id)) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Data gagal dihapus');
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => true]);
            return;
        }
        
        if (!$this->input->is_ajax_request()) {
            redirect('pasien');
        } else {
            echo json_encode(['success' => true]);
        }
    }

    public function print() {
        $data['title'] = 'Print Data Pasien';
        $data['pasien'] = $this->Pasien_model->get_all();
        
        $this->load->view('pasien/print', $data);
    }
    
    public function form($id = null) {
        if ($id) {
            $data['pasien'] = $this->Pasien_model->get_by_id($id);
            $data['title'] = 'Edit Pasien';
        } else {
            $data['new_id'] = $this->Pasien_model->generate_unique_id();
            $data['title'] = 'Tambah Pasien';
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pasien/form', $data);
        $this->load->view('templates/footer');
    }

    public function generate_report() {
        $period = $this->input->post('period');
        $start_date = null;
        $end_date = null;
    
        switch ($period) {
            case 'daily':
                $start_date = date('Y-m-d 00:00:00');
                $end_date = date('Y-m-d 23:59:59');
                break;
            case 'weekly':
                $start_date = date('Y-m-d 00:00:00', strtotime('monday this week'));
                $end_date = date('Y-m-d 23:59:59', strtotime('sunday this week'));
                break;
            case 'monthly':
                $start_date = date('Y-m-01 00:00:00');
                $end_date = date('Y-m-t 23:59:59');
                break;
            case 'yearly':
                $start_date = date('Y-01-01 00:00:00');
                $end_date = date('Y-12-31 23:59:59');
                break;
            case 'custom':
                $start_date = $this->input->post('start_date') . ' 00:00:00';
                $end_date = $this->input->post('end_date') . ' 23:59:59';
                break;
        }
    
        // Get all patients since we don't have created_at column
        $data['pasien'] = $this->db->get('pasien')->result();
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['title'] = 'Print Laporan Pasien';
        $data['period_text'] = $this->_get_period_text($period);
        
        $this->load->view('pasien/print_report', $data);
    }

    private function _get_period_text($period) {
        switch ($period) {
            case 'daily':
                return 'Hari Ini';
            case 'weekly':
                return 'Minggu Ini';
            case 'monthly':
                return 'Bulan Ini';
            case 'yearly':
                return 'Tahun Ini';
            case 'custom':
                return 'Periode Kustom';
            default:
                return '';
        }
    }
}