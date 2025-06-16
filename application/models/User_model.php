<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $user = $this->db->get('user')->row();
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        
        return false;
    }
    
    public function get_all() {
        return $this->db->get('user')->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where('user', ['id_user' => $id])->row();
    }
    
    public function insert($data) {
        return $this->db->insert('user', $data);
    }
    
    public function update($id, $data) {
        return $this->db->update('user', $data, ['id_user' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('user', ['id_user' => $id]);
    }
    
    public function generate_id() {
        $this->db->select('RIGHT(id_user, 3) as id', FALSE);
        $this->db->order_by('id_user', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('user');
        
        if($query->num_rows() > 0) {
            $data = $query->row();
            $id = intval($data->id) + 1;
        } else {
            $id = 1;
        }
        
        $padding = str_pad($id, 3, "0", STR_PAD_LEFT);
        return "USR" . $padding;
    }
    
    public function check_username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $query->num_rows() > 0;
    }
}