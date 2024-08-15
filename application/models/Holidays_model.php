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

	public function get_holidays()
    {
        $query = $this->db->get('holidays');
        return $query->result();
    }

    public function get_holidays_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('holidays');
        return $query->row();
    }

    public function get_holiday_id_by_tanggal()
    {
        $tanggal = $this->input->post('tanggal'); // Mendapatkan tanggal dari input pengguna

        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get('holidays');

        // Jika ditemukan, kembalikan ID dari baris yang cocok
        if ($query->num_rows() == 1) {
            return $query->row()->id;
        }
        return false;
    }

    public function get_by_tanggal($tanggal)
    {
        // Cari berdasarkan tanggal di tabel holidays
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get('holidays');

        // Kembalikan satu baris yang cocok sebagai objek
        return $query->row();
    }

    public function get_by_keterangan($keterangan)
    {
        $this->db->where('keterangan', $keterangan);
        $query = $this->db->get('holidays');
        return $query->row();
    }


    public function update_holidays($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('holidays', $data); // Mengembalikan true jika berhasil
    }

	// Fungsi untuk menghapus hari libur berdasarkan ID
	public function delete_holidays($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('holidays');
	}
}
