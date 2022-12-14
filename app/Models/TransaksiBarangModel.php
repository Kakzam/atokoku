<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiBarangModel extends Model
{
    protected $table = "tbl_transaksi_barang";
    protected $primaryKey = 'id_transaksi_barang';
    protected $created_at = 'tanggal_transaksi_barang';
    protected $allowedFields = [
        "id_transaksi",
        "id_barang",
        "id_created",
        "nama_barang",
        "harga_barang",
        "qty",
        "total"
    ];

    public function cari($cari)
    {
        return $this->table('tbl_transaksi_barang')->like('id_transaksi', $cari);
    }
}
