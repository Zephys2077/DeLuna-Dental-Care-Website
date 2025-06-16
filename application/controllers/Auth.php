<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
    }

    public function index() {
        if($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        if($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $user = $this->User_model->check_login($username, $password);
            
            if($user) {
                $this->session->set_userdata([
                    'logged_in' => true,
                    'user_id' => $user->id,
                    'username' => $user->username
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah');
                redirect('auth');
            }
        }
        
        $this->load->view('auth/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
}