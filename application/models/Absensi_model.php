<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

    protected $table = 'presensis';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_absensi_data($month, $year) {
        $this->db->select('users.name, presensis.*');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = presensis.user_id');
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('YEAR(tanggal)', $year);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;
    }

    public function get_holidays($month, $year) {
        $this->db->select('tanggal, keterangan');
        $this->db->from('holidays');
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('YEAR(tanggal)', $year);
        $query = $this->db->get();
    
        $result = $query->result_array();
        return $result;
    }
    

}
