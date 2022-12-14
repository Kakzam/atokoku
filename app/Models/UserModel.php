<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $created_at = 'tanggal_buat';
    protected $allowedFields = [
        'username',
        'password',
        'nama_user',
        'jenis'
    ];
}
