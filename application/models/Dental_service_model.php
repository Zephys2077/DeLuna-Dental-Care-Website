<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dental_service_model extends CI_Model {
    
    private $table = 'layanan';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_services() {
        return $this->db->get($this->table)->result();
    }
    
    public function get_service_by_id($id) {
        return $this->db->where('No', $id)->get($this->table)->row();
    }
}