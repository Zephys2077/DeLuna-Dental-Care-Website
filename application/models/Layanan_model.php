<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan_model extends CI_Model {
    
    private $table = 'layanan';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_layanan_by_id($id) {
        return $this->db->where('No', $id)
                       ->get($this->table)
                       ->row();
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_all_layanan() {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        if(is_array($id)) {
            $this->db->where_in('No', array_map('intval', $id));
            return $this->db->get('layanan')->result();
        }
        $this->db->where('No', intval($id));
        return $this->db->get('layanan')->row();
    }

    public function update($id, $data) {
        return $this->db->where('No', $id)
                       ->update($this->table, $data);
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_popular_services() {
        return $this->db->select('l.jenis_layanan, COUNT(r.id_layanan) as total')
                        ->from('layanan l')
                        ->join('reservasi r', 'r.id_layanan = l.No', 'left')
                        ->group_by('l.No')
                        ->order_by('total', 'DESC')
                        ->get()
                        ->result();
    }

    public function delete($id)
    {
        try {
            return $this->db->delete('layanan', ['No' => $id]);
        } catch (Exception $e) {
            return false;
        }
    }
}