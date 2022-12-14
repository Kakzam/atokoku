<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = "tbl_transaksi";
    protected $primaryKey = 'id_transaksi';
    protected $created_at = 'tanggal_transaksi';
    protected $allowedFields = [
        "judul_transaksi",
        "total_transaksi",
        "id_created"
    ];
}
