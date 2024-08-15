<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthMiddleware {

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('User_model'); // Pastikan model dimuat
    }

    public function verifyToken() {
        $headers = $this->CI->input->request_headers();
        $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : null;

        if (!$authHeader) {
            return $this->unauthorized();
        }

        $token = str_replace('Bearer ', '', $authHeader);

        // Verifikasi token di sini (misalnya dengan memeriksa token di database atau cache)
        // Untuk tujuan demonstrasi, kita asumsikan token valid jika tidak kosong
        $user = $this->CI->User_model->get_user_by_token($token);

        if (!$user) {
            return $this->unauthorized();
        }

        // Set user data di session atau variabel global jika perlu
        $this->CI->session->set_userdata('user_id', $user->id);

        return true;
    }

    private function unauthorized() {
        $this->CI->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => false,
                'message' => 'User not authenticated'
            ]))
            ->_display();
        exit;
    }
}
