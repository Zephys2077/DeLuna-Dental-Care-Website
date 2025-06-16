<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_reservation_model extends CI_Model {
    
    private $table = 'reservasi';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function create_reservation($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function check_availability($datetime, $layanan_id) {
        $this->db->where('tgl_jam', $datetime);
        $this->db->where('id_layanan', $layanan_id);
        $this->db->where('status !=', 'Cancelled');
        $query = $this->db->get($this->table);
        return $query->num_rows() === 0;
    }
    
    public function get_patient_reservations($patient_id) {
        $this->db->select('r.*, l.jenis_layanan');
        $this->db->from($this->table . ' r');
        $this->db->join('layanan l', 'l.No = r.id_layanan');
        $this->db->where('r.id_pasien', $patient_id);
        $this->db->order_by('r.tgl_jam', 'DESC');
        return $this->db->get()->result();
    }
}