<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_model extends CI_Model {
    
    public function get_all() {
        return $this->db->get('pasien')->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where('pasien', ['id_pasien' => $id])->row();
    }
    
    public function insert($data) {
        return $this->db->insert('pasien', $data);
    }
    
    public function update($id, $data) {
        return $this->db->update('pasien', $data, ['id_pasien' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('pasien', ['id_pasien' => $id]);
    }
    
    public function count_all() {
        return $this->db->count_all('pasien');
    }
    
    public function generate_unique_id() {
        do {
            $id = 'D' . rand(100000000, 999999999);
            $exists = $this->db->get_where('pasien', ['id_pasien' => $id])->num_rows();
        } while ($exists > 0);
        
        return $id;
    }
    
    public function get_last_id()
    {
        $this->db->select('id_pasien');
        $this->db->from('pasien');
        $this->db->order_by('RAND()');
        $this->db->limit(1);
        $query = $this->db->get();
        
        // Generate random number between 1-9999
        $number = rand(1, 9999);
        return 'D' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}