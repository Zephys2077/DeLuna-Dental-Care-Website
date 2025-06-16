<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat_model extends CI_Model {
    
    public function get_all() {
        $this->db->order_by('nama_obat', 'ASC');
        return $this->db->get('obat')->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where('obat', ['id' => $id])->row();
    }
    
    public function insert($data) {
        return $this->db->insert('obat', $data);
    }
    
    public function update($id, $data) {
        return $this->db->update('obat', $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('obat', ['id' => $id]);
    }
    
    protected $fillable = ['nama_obat', 'deskripsi', 'stok', 'harga', 'expired'];  // Pastikan 'harga' ada di sini
}