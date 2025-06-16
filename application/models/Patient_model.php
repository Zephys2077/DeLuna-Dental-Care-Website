<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function generate_patient_id() {
        // Get the last ID from database
        $this->db->select('id_pasien');
        $this->db->from('pasien');
        $this->db->like('id_pasien', 'D', 'after');
        $this->db->order_by('id_pasien', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // If exists, increment the last number
            $last_id = $query->row()->id_pasien;
            $number = intval(substr($last_id, 1)) + 1;
        } else {
            // If no existing ID, start with 1
            $number = 1;
        }

        // Format: D[3 digit number]
        return 'D' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function register($data) {
        return $this->db->insert('pasien', $data);
    }

    public function check_login($id_pasien, $no_hp) {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->where('no_hp', $no_hp);
        $query = $this->db->get('pasien');
        
        return $query->row();
    }
}