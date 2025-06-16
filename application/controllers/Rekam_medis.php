<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medis extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Rekam_medis_model');
        $this->load->model('Pasien_model');
        $this->load->model('Layanan_model');
        $this->load->model('Obat_model');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Rekam Medis';
        
        // Get all medical records with patient and service details
        $this->db->select('rekam_medis.*, pasien.nama_pasien, layanan.jenis_layanan');
        $this->db->from('rekam_medis');
        $this->db->join('pasien', 'pasien.id_pasien = rekam_medis.id_pasien');
        $this->db->join('layanan', 'layanan.No = rekam_medis.id_layanan');
        $this->db->order_by('rekam_medis.tanggal', 'DESC');
        $records = $this->db->get()->result();
        
        // Group records by patient ID
        $grouped_records = [];
        foreach($records as $record) {
            $grouped_records[$record->id_pasien][] = $record;
        }
        $data['grouped_records'] = $grouped_records;
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekam_medis/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Rekam Medis';
        
        // Get patients, services, and medicines data
        $data['pasien'] = $this->db->get('pasien')->result();
        $data['layanan'] = $this->db->get('layanan')->result();
        $data['obat'] = $this->db->get('obat')->result();
    
        if ($this->input->post()) {
            $post = $this->input->post();
            
            // Format obat array to string
            $post['obat'] = implode(', ', $post['obat']);
            $post['tanggal'] = date('Y-m-d H:i:s');
            
            $this->db->insert('rekam_medis', $post);
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            redirect('rekam_medis');
        }
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekam_medis/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Rekam Medis';
        $data['rekam_medis'] = $this->Rekam_medis_model->get_by_id($id);
        $data['pasien'] = $this->Pasien_model->get_all();
        $data['layanan'] = $this->Layanan_model->get_all();
        $data['obat'] = $this->Obat_model->get_all();
        
        if($this->input->post()) {
            $data = array(
                'id_layanan' => $this->input->post('id_layanan'),
                'keluhan' => $this->input->post('keluhan'),
                'diagnosa' => $this->input->post('diagnosa'),
                'tindakan' => $this->input->post('tindakan'),
                'obat' => implode(', ', $this->input->post('obat')),
                'keterangan' => $this->input->post('keterangan')
            );
            
            $this->Rekam_medis_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
            redirect('rekam_medis');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekam_medis/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        $this->Rekam_medis_model->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('rekam_medis');
    }

    public function print($id) {
        $this->db->select('rm.*, p.nama_pasien, l.jenis_layanan');
        $this->db->from('rekam_medis rm');
        $this->db->join('pasien p', 'p.id_pasien = rm.id_pasien');
        $this->db->join('layanan l', 'l.No = rm.id_layanan');
        $this->db->where('rm.id', $id);
        $data['record'] = $this->db->get()->row();
        
        if (!$data['record']) {
            show_404();
        }
        
        $this->load->view('rekam_medis/print', $data);
    }

    public function get_patient_phone() {
        $id_pasien = $this->input->post('id_pasien');
        $patient = $this->db->get_where('pasien', ['id_pasien' => $id_pasien])->row();
        echo json_encode(['phone' => $patient->no_hp]);
    }
}