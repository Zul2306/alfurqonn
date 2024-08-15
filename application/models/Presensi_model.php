<?php
class Presensi_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->database();
    }

    public function insert($data)
    {
        $this->db->insert('presensis', $data);
        return $this->db->insert_id();
    }

    public function insert_presensi($data) {
        return $this->db->insert('presensis', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('presensis', $data);
    }

    public function get_by_user_and_date($user_id, $date)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('tanggal', $date);
        $query = $this->db->get('presensis');
        return $query->row();
    }
    
    public function get_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('presensis');
        return $query->result();
    }

    public function calculate_distance($lat1, $lon1, $lat2, $lon2) {
        $earth_radius = 6371; // Radius bumi dalam kilometer
    
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
    
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        $distance = $earth_radius * $c; // Distance in km
    
        return $distance;
    }
    
    
}
