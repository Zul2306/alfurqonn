<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Holidays_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Fungsi untuk mengambil data hari libur berdasarkan bulan dan tahun
	public function getHolidays($month, $year)
	{
		$this->db->select('tanggal');
		$this->db->from('holidays');
		$this->db->where('MONTH(tanggal)', $month);
		$this->db->where('YEAR(tanggal)', $year);
		$query = $this->db->get();
		return $query->result_array();
	}
	// fungsi untuk mengambil data dari database
	public function get_all_data()
	{
		// Mengambil semua data dari tabel
		$query = $this->db->get('holidays'); // ganti 'nama_tabel' dengan nama tabel kamu
		return $query->result();
	}

	// Fungsi untuk menambahkan hari libur baru
	public function insert($data)
	{
		return $this->db->insert('holidays', $data);
	}

	// Fungsi untuk menghapus hari libur berdasarkan ID
	public function delete_holidays($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('holidays');
	}
}
