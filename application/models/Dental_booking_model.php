<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dental_booking_model extends CI_Model {
    
    private $table = 'reservasi';
    
    public function create_booking($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function get_patient_bookings($patient_id) {
        $this->db->select('r.*, l.jenis_layanan');
        $this->db->from($this->table . ' r');
        $this->db->join('layanan l', 'l.No = r.id_layanan');
        $this->db->where('r.id_pasien', $patient_id);
        $this->db->order_by('r.tgl_jam', 'DESC');
        return $this->db->get()->result();
    }
}