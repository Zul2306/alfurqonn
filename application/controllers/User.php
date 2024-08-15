<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('user/user_list', $data);
    }
    

    public function list() {
        $this->load->model('User_model');
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('user/user_list', $data);
    }

    public function edit($id) {
        $data['user'] = $this->User_model->get_user_by_id($id);
        if (!$data['user']) {
            show_404(); // Tampilkan halaman 404 jika user tidak ditemukan
        }

        if (empty($data['user'])) {
            show_404();
        }
        // Tambahkan log untuk debugging
        log_message('debug', 'User data: ' . print_r($data['user'], true));
        $this->load->view('user/user_edit', $data);
    }
    

    public function update() {
        $id = $this->input->post('id');
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email')
        ];

        if (!empty($this->input->post('password'))) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->User_model->update_user($id, $data);
        redirect('user/list');

    }

    public function import_users() {
        // Path to your uploaded CSV file
        $file_path = 'http://103.240.110.4/alfurqon/application/uploads/data_user.csv';

        // Parse the CSV file
        $csvData = $this->parse_csv($file_path);

        // Insert each user into the database
        foreach ($csvData as $row) {
            $data = [
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => $row['password'] // Password will be hashed by the model
            ];
            $this->User_model->insert_user($data);
        }

        echo "Users imported successfully!";
    }

    private function parse_csv($file_path) {
        $csvData = [];
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            $header = fgetcsv($handle, 1000, ",");
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $csvData[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $csvData;
    }

    public function upload_csv() {
        $config['upload_path'] = 'http://103.240.110.4/alfurqon/application/uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 1000;
    
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('csv_file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_csv', $error);
        } else {
            $data = $this->upload->data();
            $file_path = 'http://103.240.110.4/alfurqon/application/uploads/' . $data['file_name'];
            $this->import_users_from_file($file_path);
        }
    }
    
    private function import_users_from_file($file_path) {
        // Parse the CSV file
        $csvData = $this->parse_csv($file_path);
    
        // Insert each user into the database
        foreach ($csvData as $row) {
            $data = [
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => $row['password'] // Password will be hashed by the model
            ];
            $this->User_model->insert_user($data);
        }
    
        echo "Users imported successfully!";
    }
    
    public function delete($id) {
        if($this->User_model->delete_user($id)) {
            // Jika berhasil dihapus
            $this->session->set_flashdata('pesan', 'User berhasil dihapus.');
        }
        redirect('user/list');
    }
    
}
?>
