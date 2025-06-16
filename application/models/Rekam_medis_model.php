<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medis_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all() {
        $this->db->select('rekam_medis.*, pasien.nama_pasien, layanan.jenis_layanan');
        $this->db->from('rekam_medis');
        $this->db->join('pasien', 'pasien.id_pasien = rekam_medis.id_pasien');
        $this->db->join('layanan', 'layanan.No = rekam_medis.id_layanan');
        $this->db->order_by('pasien.nama_pasien', 'ASC');
        $this->db->order_by('rekam_medis.tanggal', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_by_id($id) {
        $this->db->select('rekam_medis.*, pasien.nama_pasien, layanan.jenis_layanan');
        $this->db->from('rekam_medis');
        $this->db->join('pasien', 'pasien.id_pasien = rekam_medis.id_pasien');
        $this->db->join('layanan', 'layanan.No = rekam_medis.id_layanan');
        $this->db->where('rekam_medis.id', $id);
        return $this->db->get()->row();
    }
    
    public function insert($data) {
        return $this->db->insert('rekam_medis', $data);
    }
    
    public function update($id, $data) {
        $this->db->trans_start();
        
        // Get previous medicine data
        $old_record = $this->get_by_id($id);
        
        // Update rekam medis
        $this->db->update('rekam_medis', $data, ['id' => $id]);
        
        // Load Obat model
        $this->load->model('Obat_model');
        
        // If medicine changed, update stocks
        if ($old_record->obat != $data['obat']) {
            // Return old medicine stock if exists
            if ($old_record->obat) {
                $old_obat = $this->db->get_where('obat', ['nama_obat' => $old_record->obat])->row();
                if ($old_obat) {
                    $this->db->update('obat', ['stok' => $old_obat->stok + 1], ['id' => $old_obat->id]);
                }
            }
            
            // Reduce new medicine stock
            if ($data['obat']) {
                $new_obat = $this->db->get_where('obat', ['nama_obat' => $data['obat']])->row();
                if ($new_obat && $new_obat->stok > 0) {
                    $this->db->update('obat', ['stok' => $new_obat->stok - 1], ['id' => $new_obat->id]);
                }
            }
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    public function delete($id) {
        return $this->db->delete('rekam_medis', ['id' => $id]);
    }
}