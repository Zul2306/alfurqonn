<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Holidays extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Holidays_model');
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	public function create()
	{
		$this->load->view('holidays/holidays');
	}

	public function store()
	{
		$this->load->helper(array('form', 'url'));

		$this->form_validation->set_rules('tanggal', 'Tanggal');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[255]');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('holidays/holidays');
		} else {
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
			];
			$this->Holidays_model->insert($data);
			$this->session->set_flashdata('success', 'Hari libur berhasil ditambahkan.');
			redirect('holidays/index');
		}
	}
	public function index()
	{
		// Load model
		$this->load->model('Holidays_model');

		// Ambil data dari model
		$data['holidays'] = $this->Holidays_model->get_all_data();

		// Load view dengan data
		$this->load->view('holidays/index', $data);
	}

	// Callback untuk validasi tanggal
	public function date_check($date)
	{
		if ($this->Holidays_model->exists($date)) {
			$this->form_validation->set_message('date_check', 'Tanggal sudah ada di database.');
			return FALSE;
		}
		return TRUE;
	}

	public function edit($id)
    {
        $data['holidays'] = $this->Holidays_model->get_holidays_by_id($id);
        if (!$data['holidays']) {
            show_404(); // Tampilkan halaman 404 jika user tidak ditemukan
        }

        if (empty($data['holidays'])) {
            show_404();
        }
        // Tambahkan log untuk debugging
        log_message('debug', 'Holidays data: ' . print_r($data['holidays'], true));
        $this->load->view('holidays/holidays_edit', $data);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $data = [
            'tanggal' => $this->input->post('tanggal'),
            'keterangan' => $this->input->post('keterangan')
        ];
    
        $success = $this->Holidays_model->update_holidays($id, $data);
       
            redirect('holidays/index');
    }

	public function delete($id)
	{
		if ($this->Holidays_model->delete_holidays($id)) {
			// Jika berhasil dihapus
			$this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
		}
		redirect('holidays/index');
	}
}
