<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = "tbl_notifikasi";
    protected $primaryKey = 'id';
    protected $created_at = 'tanggal';
    protected $allowedFields = [
        "judul",
        "isi",
        "tujuan",
        "status",
        "created",
        "jenis_created",
        "approve"
    ];
}
