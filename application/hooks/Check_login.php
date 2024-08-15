<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Check_login
{

	public function check_login()
	{
		$CI = &get_instance();

		// Daftar controller yang tidak memerlukan login
		$excluded_controllers = array('auth', 'home'); // Ganti dengan controller yang tidak memerlukan login

		// Ambil nama controller yang sedang aktif
		$current_controller = $CI->router->fetch_class();

		// Jika controller saat ini memerlukan login dan pengguna tidak memiliki session
		if (!in_array($current_controller, $excluded_controllers) && !$CI->session->userdata('user_id')) {
			// Redirect ke halaman login
			redirect('auth/login');
		}
	}
}
