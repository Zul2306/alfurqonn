<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->model('User_model');
    }

    public function register()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        // Validasi form
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, tampilkan form registrasi
            $this->load->view('auth/register');
        } else {
            // Jika validasi berhasil, simpan data pengguna baru
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

            // Debugging: Log data yang akan disimpan
            log_message('debug', 'Name: ' . $name);
            log_message('debug', 'Email: ' . $email);

            if ($this->User_model->register($name, $email, $password)) {
                // Set flashdata untuk menunjukkan pesan sukses
                $this->session->set_flashdata('message', 'Registration successful. You can now log in.');
                redirect('auth/login'); // Arahkan ke halaman login setelah registrasi
            } else {
                // Jika penyimpanan data gagal, tampilkan pesan kesalahan
                $this->session->set_flashdata('message', 'Registration failed. Please try again.');
                $this->load->view('auth/register');
            }
        }
    }

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
    {
        $this->load->view('auth/login');
    }

    public function login_process()
    {
        $this->load->model('User_model');

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->validate_user($email, $password);

        if ($user) {
            // Set session data
            $this->session->set_userdata('user_id', $user->id);
            log_message('debug', 'User ID set in session: ' . $user->id);
            redirect('home'); // Pastikan 'home' adalah route yang valid
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        // Hapus data sesi pengguna
        $this->session->sess_destroy();

        // Redirect ke halaman login atau halaman utama
        redirect('auth/login');
    }
}
