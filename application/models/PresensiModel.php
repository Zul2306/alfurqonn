<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table = 'presensis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'tanggal', 'masuk', 'pulang', 'status', 'keterangan'];

    public function getUserPresensis($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
