<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['total_pasien'] = $this->db->count_all('pasien');
        
        // Get today's total reservations
        $this->db->where('DATE(tgl_jam)', date('Y-m-d'));
        $data['total_reservasi'] = $this->db->count_all_results('reservasi');
        
        $data['total_omset'] = $this->db->select_sum('harga')->get('reservasi')->row()->harga ?? 0;
        
        // Get today's filled schedules
        $this->db->select('r.*, p.nama_pasien, l.jenis_layanan, l.waktu_pengerjaan');
        $this->db->from('reservasi r');
        $this->db->join('pasien p', 'p.id_pasien = r.id_pasien');
        $this->db->join('layanan l', 'l.No = r.id_layanan');
        $this->db->where('DATE(r.tgl_jam)', date('Y-m-d'));
        $this->db->order_by('r.tgl_jam', 'ASC');
        $data['jadwal_hari_ini'] = $this->db->get()->result();

        // Calculate end time for each schedule
        foreach ($data['jadwal_hari_ini'] as $jadwal) {
            $jadwal->waktu_selesai = date('H:i', strtotime("+{$jadwal->waktu_pengerjaan} minutes", strtotime($jadwal->tgl_jam)));
        }
        
        $this->load->model(['Reservasi_model', 'Pasien_model', 'Layanan_model']);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}