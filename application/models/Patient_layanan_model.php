<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_layanan_model extends CI_Model {
    
    private $table = 'layanan';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_layanan_by_id($id) {
        return $this->db->where('No', $id)->get($this->table)->row();
    }

    public function get_all_layanan() {
        return $this->db->get($this->table)->result();
    }

    public function get_layanan_details($id) {
        return $this->db->select('jenis_layanan, harga, waktu_pengerjaan')
                       ->where('No', $id)
                       ->get($this->table)
                       ->row();
    }

    public function check_layanan_availability($id) {
        return $this->db->where('No', $id)
                       ->where('status', 'active')
                       ->get($this->table)
                       ->num_rows() > 0;
    }

    public function get_layanan_duration($id) {
        $result = $this->db->select('waktu_pengerjaan')
                          ->where('No', $id)
                          ->get($this->table)
                          ->row();
        return $result ? $result->waktu_pengerjaan : 0;
    }
}