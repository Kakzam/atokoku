<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = "tbl_barang";
    protected $primaryKey = 'id_barang';
    protected $created_at = 'tanggal_buat';
    protected $allowedFields = [
        "nama_barang",
        "id_created",
        "harga",
        "stock",
        "warning"
    ];
}
