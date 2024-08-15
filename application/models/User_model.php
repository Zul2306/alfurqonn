<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function validate_user($email, $password)
	{
		$email = $this->db->escape_str($email);  // Escape special characters
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

	public function get_user_id_by_email($auth_header)
	{
		$auth = str_replace('Basic ', '', $auth_header);
		list($username, $password) = explode(':', base64_decode($auth));
		$username = $this->db->escape_str($username);  // Escape special characters

		$this->db->where('email', $username);
		$query = $this->db->get('users');

		if ($query->num_rows() == 1) {
			return $query->row()->id;
		}
		return false;
	}


	public function get_by_email($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		return $query->row();
	}

	public function getpaketuser()
	{
		$data = $this->db->query("select * from presensis where user_id = '1'")->result();

		return $data;
	}

	public function check_user($email, $password)
	{
		$query = $this->db->query("SELECT * FROM users WHERE email = ? AND password = SHA1(?)", array($email, $password));
		return $query->result();
	}

	public function insert_user($data)
	{
		// Encrypt the password
		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

		return $this->db->insert('users', $data);
	}
	public function get_all_users()
	{
		$query = $this->db->get('users');
		return $query->result();
	}

	public function get_user_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->row();
	}

	public function update_user($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('users', $data);
	}
	public function get_user($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->row();
	}

	public function delete_user($id)
	{
		if (!empty($id)) {
			$this->db->where('id', $id);
			return $this->db->delete('users');
		}
		return false;
	}
}