<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Holidays_model');
        $this->load->model('Absensi_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
    }

    public function index() {
    $month = $this->input->get('month') ?: date('n');
    $year = $this->input->get('year') ?: date('Y');

    $absensiData = $this->Absensi_model->get_absensi_data($month, $year);

    // Dapatkan hari libur dari database
    $holidays = $this->Absensi_model->get_holidays($month, $year);

    // Tambahkan semua hari Minggu sebagai libur
    $endOfMonth = date('t', strtotime("$year-$month-01"));
    for ($i = 1; $i <= $endOfMonth; $i++) {
        $date = sprintf('%04d-%02d-%02d', $year, $month, $i);
        if (date('w', strtotime($date)) == 0) { // 0 means Sunday
            $holidays[] = ['tanggal' => $date, 'keterangan' => 'Libur Minggu'];
        }
    }

    $data = [
        'absensiData' => $this->format_data($absensiData),
        'selectedMonth' => $month,
        'selectedYear' => $year,
        'endOfMonth' => date('t', strtotime("$year-$month-01")),
        'holidays' => $holidays,
    ];

    $this->load->view('dashboard/home', $data);
}


private function format_data($absensiData) {
    $formatted = [];
    foreach ($absensiData as $row) {
        $userId = $row['user_id'];
        $date = date('j', strtotime($row['tanggal']));

        if (!isset($formatted[$userId])) {
            $formatted[$userId] = [
                'name' => $row['name'],
                'dates' => []
            ];
        }

        $formatted[$userId]['dates'][$date] = [
            'masuk' => $row['masuk'],
            'pulang' => $row['pulang'],
            'status' => $row['status'],
            'keterangan' => $row['keterangan'],
            'foto' => $row['foto'], 
            'latitude' => $row['latitude'], 
            'longitude' => $row['longitude'], 
        ];
    }

    return $formatted;
}



}
