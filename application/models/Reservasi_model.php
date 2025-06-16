<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservasi_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_id($id) {
        $this->db->select('reservasi.*, pasien.nama_pasien, pasien.no_hp, layanan.jenis_layanan, layanan.harga');
        $this->db->from('reservasi');
        $this->db->join('pasien', 'pasien.id_pasien = reservasi.id_pasien');
        $this->db->join('layanan', 'layanan.No = reservasi.id_layanan');
        $this->db->where('reservasi.No', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Add the update method
    public function update($id, $data) {
        $this->db->where('No', $id);
        return $this->db->update('reservasi', $data);
    }

    // Add method to get patient reservations
    public function get_patient_reservations($patient_id) {
        $this->db->select('reservasi.*, layanan.jenis_layanan, layanan.harga');
        $this->db->from('reservasi');
        $this->db->join('layanan', 'layanan.No = reservasi.id_layanan');
        $this->db->where('reservasi.id_pasien', $patient_id);
        $this->db->order_by('reservasi.tgl_jam', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Add delete method
    public function delete($id) {
        $this->db->where('No', $id);
        return $this->db->delete('reservasi');
    }

    public function is_time_available($datetime, $layanan_id, $exclude_id = null) {
        // Handle multiple layanan IDs
        if(is_array($layanan_id)) {
            $layanan_ids = $layanan_id;
        } else {
            $layanan_ids = explode(',', $layanan_id);
        }
        
        $total_duration = 0;
        foreach($layanan_ids as $id) {
            $layanan = $this->db->get_where('layanan', ['No' => $id])->row();
            $total_duration += intval($layanan->waktu_pengerjaan);
        }
        
        $start_time = date('Y-m-d H:i:s', strtotime($datetime));
        $end_time = date('Y-m-d H:i:s', strtotime($datetime . " +{$total_duration} minutes"));
        
        $this->db->where('tgl_jam <', $end_time);
        $this->db->where('tgl_jam >=', $start_time);
        if($exclude_id) {
            $this->db->where('No !=', $exclude_id);
        }
        
        return $this->db->get('reservasi')->num_rows() == 0;
    }
    
    public function insert($data) {
        return $this->db->insert('reservasi', $data);
    }
    
    public function update_reservation_time($id, $new_datetime) {
        return $this->db->where('No', $id)
                        ->update('reservasi', ['tgl_jam' => $new_datetime]);
    }
    
    public function get_all() {
        $this->db->select('reservasi.*, pasien.nama_pasien, layanan.jenis_layanan, layanan.harga');
        $this->db->from('reservasi');
        $this->db->join('pasien', 'pasien.id_pasien = reservasi.id_pasien');
        $this->db->join('layanan', 'layanan.No = reservasi.id_layanan');
        $this->db->order_by('tgl_jam', 'DESC');
        return $this->db->get()->result();
    }
}