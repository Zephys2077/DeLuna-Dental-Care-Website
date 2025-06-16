<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Data User';
        $data['user'] = $this->User_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add() {
        $data['title'] = 'Tambah User';
        
        if($this->input->post()) {
            $data = array(
                'id_user' => $this->User_model->generate_id(),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );
            
            $this->User_model->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('user');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('user/form', $data);
        $this->load->view('templates/footer');
    }
    
    public function edit($id) {
        $data['title'] = 'Edit User';
        $data['user'] = $this->User_model->get_by_id($id);
        
        if($this->input->post()) {
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username')
            );
            
            if($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            
            $this->User_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
            redirect('user');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('user/form', $data);
        $this->load->view('templates/footer');
    }
    
    public function delete($id) {
        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('user');
    }
    
    public function check_username() {
        $username = $this->input->post('username');
        $exists = $this->User_model->check_username_exists($username);
        echo json_encode(['exists' => $exists]);
    }
}