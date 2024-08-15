<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function login()
    {
        header_remove('Set-Cookie');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Validasi pengguna
        if (!$this->User_model->validate_user($email, $password)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ]));
            return;
        }

        $user = $this->User_model->get_by_email($email);

        // Buat session pengguna
        $this->session->set_userdata('user_id', $user->id);
        $this->session->set_userdata('user_email', $user->email);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'user_id' => $user->id,
                'user_email' => $user->email,
                'user_name' => $user->name
                ]
            ]));
    }

    public function logout()
    {
        // Hapus session pengguna
        $this->session->sess_destroy();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'message' => 'Logout successful'
            ]));
    }
}
