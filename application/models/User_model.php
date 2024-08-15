<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($email, $password)
    {
        $email = $this->db->escape_str($email); // Escape special characters
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            return password_verify($password, $user->password) ? $user : false;
        }
        return false;
    }

    public function register($name, $email, $password)
    {
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password
        );

        return $this->db->insert('users', $data);
    }

    // Other methods remain unchanged
}
