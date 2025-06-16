<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Obat_model');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Data Obat';
        $data['obat'] = $this->Obat_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('obat/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Obat';
        
        if($this->input->post()) {
            $data = array(
                'nama_obat' => $this->input->post('nama_obat'),
                'deskripsi' => $this->input->post('deskripsi'),
                'stok' => $this->input->post('stok'),
                'harga' => $this->input->post('harga'),
                'expired' => $this->input->post('expired')
            );
            
            $this->Obat_model->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('obat');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('obat/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Obat';
        $data['obat'] = $this->Obat_model->get_by_id($id);
        
        if($this->input->post()) {
            $data = array(
                'nama_obat' => $this->input->post('nama_obat'),
                'deskripsi' => $this->input->post('deskripsi'),
                'stok' => $this->input->post('stok'),
                'expired' => $this->input->post('expired')
            );
            
            $this->Obat_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
            redirect('obat');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('obat/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        $this->Obat_model->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('obat');
    }

    public function print() {
        $data['title'] = 'Print Data Obat';
        $data['obat'] = $this->Obat_model->get_all();
        
        $this->load->view('obat/print', $data);
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
    
        $data['obat'] = $this->db->get('obat')->result();
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['title'] = 'Print Laporan Obat';
        
        $this->load->view('obat/print_report', $data);
    }
}