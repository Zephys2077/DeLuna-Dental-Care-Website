<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Layanan_model');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Data Layanan';
        $data['layanan'] = $this->Layanan_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('layanan/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Layanan';
        
        if($this->input->post()) {
            $data = array(
                'jenis_layanan' => $this->input->post('jenis_layanan'),
                'harga' => $this->input->post('harga'),
                'waktu_pengerjaan' => $this->input->post('waktu_pengerjaan')
            );
            
            $this->Layanan_model->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('layanan');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('layanan/form');
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Layanan';
        $data['layanan'] = $this->Layanan_model->get_by_id($id);
        
        if($this->input->post()) {
            $data = array(
                'jenis_layanan' => $this->input->post('jenis_layanan'),
                'harga' => $this->input->post('harga'),
                'waktu_pengerjaan' => $this->input->post('waktu_pengerjaan')
            );
            
            $this->Layanan_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
            redirect('layanan');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('layanan/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        if ($this->input->is_ajax_request()) {
            try {
                if ($this->Layanan_model->delete($id)) {
                    echo json_encode(['success' => true]);
                } else {
                    http_response_code(400);
                    echo json_encode(['error' => 'Data layanan tidak dapat dihapus karena masih digunakan dalam reservasi']);
                }
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['error' => 'Data layanan tidak dapat dihapus karena masih digunakan dalam reservasi']);
            }
        } else {
            redirect('layanan');
        }
    }
}