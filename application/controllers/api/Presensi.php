<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi extends CI_Controller {

//     public function __construct()
//     {
//         parent::__construct();
//         date_default_timezone_set('Asia/Jakarta');
//         $this->load->database();
//         $this->load->model('User_model');
//         $this->load->model('Presensi_model');
//         $this->load->library('upload');
//         $this->load->library('session');
//         $this->load->helper('url');
//         // Verifikasi basic auth
//         $this->authenticate();
//     }

//     private function authenticate()
//     {
//         header_remove('Set-Cookie');
//         $headers = $this->input->request_headers();
//         if (!isset($headers['Authorization'])) {
//             $this->output
//                 ->set_content_type('application/json')
//                 ->set_output(json_encode([
//                     'success' => false,
//                     'message' => 'Authorization header not provided'
//                 ]));
//             exit;
//         }

//         $auth = $headers['Authorization'];
//         list($username, $password) = explode(':', base64_decode(str_replace('Basic ', '', $auth)));

//         if (!$this->User_model->validate_user($username, $password)) {
//             $this->output
//                 ->set_content_type('application/json')
//                 ->set_output(json_encode([
//                     'success' => false,
//                     'message' => 'Invalid credentials'
//                 ]));
//             exit;
//         }
//     }

//     public function get_presensis()
// {
//     header_remove('Set-Cookie');
//     // Ambil user_id dari header Authorization
//     $authorization = $this->input->request_headers()['Authorization'];
//     $user_id = $this->User_model->get_user_id_by_email($authorization);

//     // Ambil data presensi berdasarkan user_id
//     $presensis = $this->Presensi_model->get_by_user_id($user_id);
    
//     // Cek jika presensis adalah objek tunggal
//     if (!is_array($presensis)) {
//         $presensis = [$presensis];
//     }

//     // Format tanggal dan waktu
//     foreach ($presensis as &$item) {
//         // Tentukan apakah ini hari ini
//         $item->is_hari_ini = ($item->tanggal == date('Y-m-d')) ? true : false;

//         // Format waktu pulang jika ada
//         if ($item->pulang !== null) {
//             $item->pulang = date('H:i', strtotime($item->pulang));
//         }
//     }

//     // Kirim response JSON
//     $response = [
//         'success' => true,
//         'message' => 'Sukses menampilkan data',
//         'data' => $presensis
//     ];
    
//     // Log response untuk debugging
//     log_message('debug', 'Response: ' . print_r($response, true));

//     $this->output
    
//         ->set_content_type('application/json')
//         ->set_output(json_encode($response));
// }

//     public function save_presensi()
//     {
//         $email = $this->input->post('email');
//         $password = $this->input->post('password');

//         // Validate user credentials
//         if (!$this->User_model->validate_user($email, $password)) {
//             $this->output
//                 ->set_content_type('application/json')
//                 ->set_output(json_encode([
//                     'success' => false,
//                     'message' => 'Invalid credentials'
//                 ]));
//             return;
//         }

//         $user = $this->User_model->get_by_email($email);
//         $date_today = date('Y-m-d');
        
//         // Check if there is an existing entry for today
//         $existing_presensi = $this->Presensi_model->get_by_user_and_date($user->id, $date_today);

//         if (!$existing_presensi) {
//             // No entry for today, create a new one
//             $data = [
//                 'user_id' => $user->id,
//                 'latitude' => $this->input->post('latitude'),
//                 'longitude' => $this->input->post('longitude'),
//                 'tanggal' => $date_today,
//                 'status' => date('H:i:s'),
//                 'pulang' => null,
//                 'status' => $this->input->post('status'),
//                 'keterangan' => $this->input->post('keterangan'),
//                 'foto' => $this->upload_image()
//             ];
//             $presensi = $this->Presensi_model->insert($data);

//             $this->output
//                 ->set_content_type('application/json')
//                 ->set_output(json_encode([
//                     'success' => true,
//                     'message' => 'Sukses absen untuk status',
//                     'data' => $this->Presensi_model->get_by_user_and_date($user->id, $date_today)
//                 ]));
//         } else {
//             if ($existing_presensi->pulang !== null) {
//                 // Already marked 'pulang', return a message
//                 $this->output
//                     ->set_content_type('application/json')
//                     ->set_output(json_encode([
//                         'success' => false,
//                         'message' => 'Anda sudah melakukan presensi',
//                         'data' => null
//                     ]));
//             } else {
//                 // Update 'pulang'
//                 $data = [
//                     'pulang' => date('H:i:s'),
//                     'foto' => $this->upload_image(),
//                 ];
//                 $this->Presensi_model->update($existing_presensi->id, $data);

//                 $this->output
//                     ->set_content_type('application/json')
//                     ->set_output(json_encode([
//                         'success' => true,
//                         'message' => 'Sukses Absen untuk Pulang',
//                         'data' => $this->Presensi_model->get_by_user_and_date($user->id, $date_today)
//                     ]));
//             }
//         }
//     }

// private function upload_image()
// {
//     if (!empty($_FILES['image']['name'])) {
//         $config['upload_path'] = './uploads/';
//         $config['allowed_types'] = 'jpg|jpeg|png';
//         $config['file_name'] = time() . '-' . $_FILES['image']['name'];
        
//         $this->load->library('upload', $config);

//         if ($this->upload->do_upload('image')) {
//             return $this->upload->data('file_name');
//         } else {
//             // Menampilkan pesan error upload jika gagal
//             $this->output
//                 ->set_content_type('application/json')
//                 ->set_output(json_encode([
//                     'success' => false,
//                     'message' => $this->upload->display_errors()
//                 ]));
//             return null;
//         }
//     }
//     return null;
// }

public function __construct()
{
      parent::__construct();
      $this->load->helper('form');
      $this->load->model('User_model'); 
      $this->load->model('Presensi_model');
      header('Content-Type: application/json; charset=utf-8');
  }

  public function list()
  {
    
    $user_id = $this->input->post('user_id');

    // Query untuk mendapatkan data absensi
    $query = $this->db->query("SELECT * FROM presensis WHERE user_id = ?", array($user_id));
    $datauser = $query->result_array();

    // Mendapatkan tanggal hari ini
    $today = date('Y-m-d');

    $response = [];
    foreach ($datauser as $index => $item) {
        $item['is_hari_ini'] = ($item['tanggal'] == $today);
        $response[] = $item;
    }

    if (count($response) > 0) {
        $data = array(
            'status' => "00",
            'msg' => "User Authenticated",
            'data' => $response
        );
    } else {
        $data = array(
            'status' => "03",
            'msg' => "Not Authenticate",
        );
    }

    echo json_encode($data);
    }

    public function insert() {
        $config['upload_path'] = './application/uploads/'; // Path untuk menyimpan file upload
        $config['allowed_types'] = 'jpg|jpeg|png'; // Jenis file yang diperbolehkan
        $config['max_size'] = 2048; // Maksimal ukuran file dalam KB
    
        $this->load->library('upload', $config);
    
        $foto = null;
    
        // Coba upload foto jika ada
        if ($this->upload->do_upload('foto')) {
            $uploadData = $this->upload->data();
            $foto = $uploadData['file_name'];
        }
    
        $user_id = $this->input->post('user_id');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $tanggal = $this->input->post('tanggal');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        $date_today = date('Y-m-d'); // Tanggal hari ini
    
        // Cek apakah sudah ada presensi untuk user_id pada tanggal hari ini
        $existing_presensi = $this->Presensi_model->get_by_user_and_date($user_id, $date_today);
    
        if (empty($tanggal)) {
            $tanggal = date('Y-m-d');
        }
    
        if (!$existing_presensi) {
            // Jika tidak ada presensi, buat entri baru
            $data = [
                'user_id' => $user_id,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'tanggal' => $tanggal,
                'status' => $status,
                'keterangan' => $keterangan,
                'foto' => $foto,
                'masuk' => date('H:i:s') // Menambahkan waktu masuk
            ];
    
            $this->Presensi_model->insert($data);
    
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'message' => 'Sukses absen untuk masuk',
                    'data' => $this->Presensi_model->get_by_user_and_date($user_id, $date_today)
                ]));
        } else {
            // Jika sudah ada presensi, periksa apakah sudah ada waktu pulang
            if ($existing_presensi->pulang !== null) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => false,
                        'message' => 'Anda sudah melakukan presensi',
                        'data' => null
                    ]));
            } else {
                // Jika belum ada waktu pulang, update waktu pulang
                $data = [
                    'pulang' => date('H:i:s')
                ];
    
                $this->Presensi_model->update($existing_presensi->id, $data);
    
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => true,
                        'message' => 'Sukses absen untuk pulang',
                        'data' => $this->Presensi_model->get_by_user_and_date($user_id, $date_today)
                    ]));
            }
        }
    }
    
}



