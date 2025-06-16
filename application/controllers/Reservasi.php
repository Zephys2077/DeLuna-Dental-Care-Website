<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservasi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Reservasi_model', 'Pasien_model', 'Layanan_model']);
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
        {
            $this->db->select('reservasi.*, pasien.no_hp, pasien.nama_pasien, layanan.jenis_layanan');
            $this->db->from('reservasi');
            $this->db->join('pasien', 'pasien.id_pasien = reservasi.id_pasien');
            $this->db->join('layanan', 'layanan.No = reservasi.id_layanan');
            $data['reservasi'] = $this->db->get()->result();
            
            $data['title'] = 'Data Reservasi';
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('reservasi/index', $data);
            $this->load->view('templates/footer');
        }

    public function add() {
        $data['title'] = 'Tambah Reservasi';
        $data['pasien'] = $this->Pasien_model->get_all();
        $data['layanan'] = $this->Layanan_model->get_all();
        
        if($this->input->post()) {
            $layanan_ids = $this->input->post('id_layanan');
            $total_harga = 0;
            
            // Handle multiple layanan
            if(is_array($layanan_ids)) {
                foreach($layanan_ids as $id) {
                    $layanan = $this->Layanan_model->get_by_id(intval($id));
                    if($layanan) {
                        $total_harga += $layanan->harga;
                    }
                }
                $layanan_id = implode(',', $layanan_ids);
            } else {
                $layanan = $this->Layanan_model->get_by_id(intval($layanan_ids));
                if($layanan) {
                    $total_harga = $layanan->harga;
                    $layanan_id = $layanan_ids;
                }
            }

            $data = array(
                'tgl_jam' => $this->input->post('tgl_jam'),
                'id_pasien' => $this->input->post('id_pasien'),
                'id_layanan' => $layanan_id,
                'keluhan' => $this->input->post('keluhan'),
                'harga' => $total_harga,
                'status' => 'Pending'
            );
            
            $this->Reservasi_model->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('reservasi');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('reservasi/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Reservasi';
        $data['reservasi'] = $this->Reservasi_model->get_by_id($id);
        $data['pasien'] = $this->Pasien_model->get_all();
        $data['layanan'] = $this->Layanan_model->get_all();
        
        if($this->input->post()) {
            $layanan_ids = $this->input->post('id_layanan');
            $total_harga = 0;
            
            // Handle multiple layanan
            if(is_array($layanan_ids)) {
                foreach($layanan_ids as $layanan_id) {
                    $layanan = $this->Layanan_model->get_by_id($layanan_id);
                    $total_harga += $layanan->harga;
                }
                $layanan_id = implode(',', $layanan_ids);
            } else {
                $layanan = $this->Layanan_model->get_by_id($layanan_ids);
                $total_harga = $layanan->harga;
                $layanan_id = $layanan_ids;
            }

            $data = array(
                'tgl_jam' => $this->input->post('tgl_jam'),
                'id_pasien' => $this->input->post('id_pasien'),
                'id_layanan' => $layanan_id,
                'keluhan' => $this->input->post('keluhan'),
                'harga' => $total_harga
            );
            
            $this->Reservasi_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
            redirect('reservasi');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('reservasi/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        $this->Reservasi_model->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('reservasi');
    }

    public function check_availability() {
        $tgl_jam = $this->input->post('tgl_jam');
        $id_layanan = $this->input->post('id_layanan');
        $id_pasien = $this->input->post('id_pasien');
        $layanan = $this->Layanan_model->get_by_id($id_layanan);
        
        $is_booked = $this->Reservasi_model->check_availability($tgl_jam, $layanan->waktu_pengerjaan, $id_pasien);
        
        echo json_encode([
            'is_booked' => $is_booked,
            'message' => $is_booked ? 'Pasien ini sudah memiliki jadwal reservasi di waktu yang sama' : ''
        ]);
    }

    public function check_available_time() {
        $selected_time = $this->input->post('selected_time');
        $layanan_id = $this->input->post('layanan_id');
        
        // Get layanan details
        $layanan = $this->db->get_where('layanan', ['No' => $layanan_id])->row();
        
        // Convert hours to minutes (1 hour = 60 minutes)
        $duration = intval($layanan->waktu_pengerjaan) * 60; 
        
        // Convert selected time to datetime objects
        $start_time = new DateTime($selected_time);
        $end_time = clone $start_time;
        $end_time->modify("+{$duration} minutes");
        
        // Check for overlapping reservations
        $this->db->select('r.*, l.waktu_pengerjaan');
        $this->db->from('reservasi r');
        $this->db->join('layanan l', 'r.id_layanan = l.No');
        $this->db->where('r.status !=', 'cancelled');
        
        // Check if any existing reservation overlaps with the new time slot
        $this->db->where("(
            (r.tgl_jam <= '{$start_time->format('Y-m-d H:i:s')}' AND DATE_ADD(r.tgl_jam, INTERVAL (l.waktu_pengerjaan * 60) MINUTE) > '{$start_time->format('Y-m-d H:i:s')}')
            OR 
            (r.tgl_jam < '{$end_time->format('Y-m-d H:i:s')}' AND r.tgl_jam >= '{$start_time->format('Y-m-d H:i:s')}')
        )");
        
        $existing = $this->db->get()->num_rows();
        
        echo json_encode([
            'available' => $existing === 0,
            'start_time' => $start_time->format('Y-m-d H:i:s'),
            'end_time' => $end_time->format('Y-m-d H:i:s'),
            'duration' => $duration
        ]);
    }

    public function selesai($id) {
        $reservasi = $this->Reservasi_model->get_by_id($id);
        
        // Update reservasi status
        $this->Reservasi_model->update($id, ['status' => 'Selesai']);
        
        // Insert to rekam medis
        $data = array(
            'id_pasien' => $reservasi->id_pasien,
            'id_layanan' => $reservasi->id_layanan,
            'tanggal' => $reservasi->tgl_jam,
            'keluhan' => $reservasi->keluhan
        );
        
        $this->load->model('Rekam_medis_model');
        $this->Rekam_medis_model->insert($data);
        
        $this->session->set_flashdata('success', 'Reservasi berhasil ditandai selesai');
        redirect('reservasi');
    }

    public function print() {
        $data['title'] = 'Print Reservasi';
        $data['reservasi'] = $this->Reservasi_model->get_all();
        
        $this->load->view('reservasi/print', $data);
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
    
        $this->db->select('reservasi.*, pasien.nama_pasien, layanan.jenis_layanan');
        $this->db->from('reservasi');
        $this->db->join('pasien', 'pasien.id_pasien = reservasi.id_pasien');
        $this->db->join('layanan', 'layanan.No = reservasi.id_layanan');
        $this->db->where('reservasi.tgl_jam >=', $start_date);
        $this->db->where('reservasi.tgl_jam <=', $end_date);
        $data['reservasi'] = $this->db->get()->result();
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['total_pendapatan'] = array_sum(array_column($data['reservasi'], 'harga'));
        $data['title'] = 'Print Laporan Reservasi';
        
        $this->load->view('reservasi/print_report', $data);
    }
}