<?php

namespace App\Controllers;

class Mobile extends BaseController
{

    public function test()
    {
        $requests = $this->barangModel->findAll();
        // dd($requests);

        $data = array();
        foreach ($requests as $request) {
            array_push($data, $request);
        }

        $data = ['data' => $request];
        echo json_encode($data);
        // dd($data);
    }

    public function index()
    {
        $data = $this->userModel->findAll();
        foreach ($data as $a) {
            echo $a['id_user'], " <br>";
        }
    }

    /* Menu Dashboard ------------------------------------------------------------------------------------------- */

    public function getDashboard()
    {
        $response = [
            'user' => $this->userModel->countAll(),
            'transaksi' => $this->transaksiModel->countAll(),
            'barang' => $this->barangModel->countAll()
        ];

        $data = [
            'data' =>  true,
            'notifikasi' =>  "Berhasil mengunduh!",
            'response' =>  $response
        ];

        return json_encode($data);
    }

    /* Menu Barang ------------------------------------------------------------------------------------------- */

    public function getItem()
    {
        $data = [
            'data' =>  true,
            'notifikasi' =>  "Berhasil mengunduh!",
            'response' =>  $this->barangModel->findAll()
        ];

        return json_encode($data);
    }

    public function addItem()
    {
        $nilai = $this->barangModel->save([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_created' => $this->request->getPost('id_created'),
            'harga' => $this->request->getPost('harga'),
            'stock' => $this->request->getPost('stock'),
            'warning' => $this->request->getPost('warning')
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Barang Berhasil Ditambah",
                'response' =>  $this->barangModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Barang Gagal Ditambah",
                'response' =>  $this->barangModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function deleteItem()
    {
        $nilai = $this->barangModel->delete($this->request->getPost('id'));

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Barang Berhasil Dihapus",
                'response' =>  $this->barangModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Barang Gagal Dihapus",
                'response' =>  $this->barangModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function updateItem()
    {
        $nilai = $this->barangModel->save([
            'id_barang' => $this->request->getPost('id_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_created' => $this->request->getPost('id'),
            'harga' => $this->request->getPost('harga'),
            'stock' => $this->request->getPost('stock'),
            'warning' => $this->request->getPost('warning')
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Barang Berhasil Diupdate",
                'response' =>  $this->barangModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Barang Gagal Diupdate",
                'response' =>  $this->barangModel->findAll()
            ];
        }

        return json_encode($data);
    }

    /* Menu Notification ------------------------------------------------------------------------------------- */

    public function getNotifikasi()
    {
        $data = [
            'data' =>  true,
            'notifikasi' =>  "Berhasil mengunduh!",
            'response' =>  $this->notifModel->findAll()
        ];

        return json_encode($data);
    }

    public function addNotification()
    {
        $nilai = $this->notifModel->save([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'tujuan' => $this->request->getPost('tujuan'),
            'status' => 0,
            'created' => $this->request->getPost('id_created'),
            'jenis_created' => $this->request->getPost('id_jenis_created'),
            'approve' => 0
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Notifikasi berhasil di tambah",
                'response' =>  $this->notifModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Notifikasi gagal di tambah",
                'response' =>  $this->notifModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function deleteNotification()
    {
        $nilai = $this->notifModel->delete($this->request->getPost('id'));

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Notifikasi Berhasil Dihapus",
                'response' =>  $this->notifModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Notifikasi Gagal Dihapus",
                'response' =>  $this->notifModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function approveNotification()
    {
        $nilai = $this->notifModel->save([
            'id' => $this->request->getPost('id_notifikasi'),
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'tujuan' => $this->request->getPost('tujuan'),
            'status' => 1,
            'created' => $this->request->getPost('id_created'),
            'jenis_created' => $this->request->getPost('id_jenis_created'),
            'approve' => 0
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Notifikasi Berhasil Diselesaikan",
                'response' =>  $this->notifModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Notifikasi Gagal Diselesaikan",
                'response' =>  $this->notifModel->findAll()
            ];
        }

        return json_encode($data);
    }

    /* Menu Transaction -------------------------------------------------------------------------------------- */

    public function getTransaction()
    {
        $data = [
            'data' =>  true,
            'notifikasi' =>  "Data Berhasil diunduh!",
            'response' =>  $this->transaksiModel->findAll()
        ];

        return json_encode($data);
    }

    public function addTransaction()
    {
        $nilai = $this->transaksiModel->save([
            'judul_transaksi' => $this->request->getPost('judul_transaksi'),
            'total_transaksi' => 0,
            'id_created' => $this->request->getPost('id_created')
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Transaksi Berhasil Ditambah",
                'response' =>  $this->transaksiModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Transaksi Gagal Ditambah",
                'response' =>  $this->transaksiModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function deleteTransaction()
    {
        $nilai = $this->transaksiModel->delete($this->request->getPost('id'));

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Transaksi Berhasil Dihapus",
                'response' =>  $this->transaksiModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Transaksi Gagal Dihapus",
                'response' =>  $this->transaksiModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function updateTransaction()
    {
        $id = $this->request->getPost('id_transaction');
        $db = db_connect();
        $id_user = $this->request->getPost('id_user');

        $result = $db->query("SELECT COUNT(*) as Count FROM `tbl_transaksi_barang` WHERE id_transaksi = '$id'");
        $total = 0;
        if ($result->getRow()->Count > 0) {
            $tt = $this->transaksiBarangModel->findAll();
            foreach ($tt as $ambil) {
                if ($ambil['id_transaksi'] == $id) {
                    $total += $ambil['total'];
                }
            }
        }

        $nilai = $this->transaksiModel->save([
            'id_transaksi' => $id,
            'judul_transaksi' => $this->request->getVar('judul_transaksi'),
            'tanggal_transaksi' => date('y-m-d H:i:s'),
            'total_transaksi' => $total,
            'id_created' => $id_user
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Transaksi Berhasil Diupdate",
                'response' =>  $this->transaksiModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Transaksi Gagal Diupdate",
                'response' =>  $this->transaksiModel->findAll()
            ];
        }

        return json_encode($data);
    }

    /* Menu Transaction Barang ------------------------------------------------------------------------------- */

    public function getTransaksiBarang()
    {
        $id = $this->request->getPost('id');

        $db = db_connect();

        $itemTransactions = $db->query("SELECT * FROM `tbl_transaksi_barang` WHERE id_transaksi='$id'")->getResultArray();

        $data = [
            'data' =>  true,
            'notifikasi' =>  "Data Barang Berhasil Diambil",
            'response' =>  $itemTransactions
        ];

        return json_encode($data);
    }

    public function addTransactionBarang()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $id_user = $this->request->getPost('id_login');

        $nilai = $this->transaksiBarangModel->save([
            'id_transaksi' => $id_transaksi,
            'id_barang' => $this->request->getPost('id'),
            'id_created' => $id_user,
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_barang' => $this->request->getPost('harga'),
            'qty' => $this->request->getPost('qty'),
            'total' => $this->request->getPost('total')
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Barang Berhasil Ditambah",
                'response' =>  $this->transaksiBarangModel->findAll()
            ];

            /* Update Menu Transaksi */
            $db = db_connect();

            $result = $db->query("SELECT COUNT(*) as Count FROM `tbl_transaksi_barang` WHERE id_transaksi = '$id_transaksi'");
            $total = 0;
            if ($result->getResultArray() > 0) {
                $tt = $this->transaksiBarangModel->findAll();
                foreach ($tt as $ambil) {
                    if ($ambil['id_transaksi'] == $id_transaksi) {
                        $total += $ambil['total'];
                    }
                }
            }

            $result = $db->query("SELECT judul_transaksi FROM `tbl_transaksi` WHERE id_transaksi = '$id_transaksi'");
            $judul = "";
            if ($result->getResultArray() > 0) {
                foreach ($result->getResultArray() as $ambil) {
                    $judul = $ambil['judul_transaksi'];
                }
            }

            if ($id_user) {
                $this->transaksiModel->save([
                    'id_transaksi' => $id_transaksi,
                    'judul_transaksi' => $judul,
                    'tanggal_transaksi' => date('y-m-d H:i:s'),
                    'total_transaksi' => $total,
                    'id_created' => $id_user
                ]);
            }

            /* Update Menu Barang */
            $stock = $this->request->getPost('stock');
            $warning = $this->request->getPost('warning');
            $qty = $this->request->getPost('qty');
            $id = $this->request->getPost('id');
            $id_created = $this->request->getPost('id_created');
            $nama_barang = $this->request->getPost('nama_barang');
            $harga = $this->request->getPost('harga');
            $total = $stock - $qty;

            $this->barangModel->save([
                'id_barang' => $id,
                'nama_barang' => $nama_barang,
                'id_created' => $id_created,
                'harga' => $harga,
                'stock' => $total,
                'warning' => $warning
            ]);

            if ($total <= $warning) {
                $this->notifModel->save([
                    'judul' => "Barang $nama_barang Habis!",
                    'isi' => "Barang $nama_barang Tersisa $total silahkan menambah stock, membeli kembali atau merubah peringatan di Menu Barang",
                    'tujuan' => 2,
                    'status' => 0,
                    'created' => 0,
                    'jenis_created' => 1,
                    'approve' => 0
                ]);
            }
        } else {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Barang Gagal Ditambah",
                'response' =>  $this->transaksiBarangModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function deleteTransactionBarang()
    {
        $id_user = $this->request->getPost('id_login');
        $id_transaksi = $this->request->getPost('id_transaksi');
        $id_transaksi_barang = $this->request->getPost('id_transaksi_barang');

        /* Delete Barang */
        $nilai = $this->transaksiBarangModel->delete($id_transaksi_barang);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data Barang Berhasil Dihapus",
                'response' =>  $this->transaksiBarangModel->findAll()
            ];

            /* Update Transaction */
            $db = db_connect();

            $result = $db->query("SELECT COUNT(*) as Count FROM `tbl_transaksi_barang` WHERE id_transaksi = '$id_transaksi'");
            $count = $result->getRow()->Count;

            $total = 0;
            if ($count > 0) {
                $tt = $this->transaksiBarangModel->findAll();
                foreach ($tt as $ambil) {
                    if ($ambil['id_transaksi'] == $id_transaksi) {
                        $total += $ambil['total'];
                    }
                }
            } else $total = 0;

            $result = $db->query("SELECT * FROM `tbl_transaksi` WHERE id_transaksi = '$id_transaksi'");
            $judul_transaksi = "";
            if ($result->getResultArray() > 0) {
                foreach ($result->getResultArray() as $ambil) {
                    $judul_transaksi = $ambil['judul_transaksi'];
                }
            }

            if ($id_user) {
                $this->transaksiModel->save([
                    'id_transaksi' => $id_transaksi,
                    'judul_transaksi' => $judul_transaksi,
                    'tanggal_transaksi' => date('y-m-d H:i:s'),
                    'total_transaksi' => $total,
                    'id_created' => $id_user
                ]);
            }

            /* Update Barang */
            $id_barang = $this->request->getPost('id_barang');
            $result = $db->query("SELECT * FROM `tbl_barang` WHERE id_barang = '$id_barang'");
            if ($result->getResultArray() > 0) {
                foreach ($result->getResultArray() as $ambil) {
                    $stock = $ambil['stock'];
                    $warning = $ambil['warning'];
                    $id_created = $ambil['id_created'];
                    $nama_barang = $ambil['nama_barang'];
                    $harga = $ambil['harga'];
                }
            }

            $qty_before = $this->request->getPost('qty_before');
            $total = $stock + $qty_before;

            $this->barangModel->save([
                'id_barang' => $id_barang,
                'nama_barang' => $nama_barang,
                'id_created' => $id_created,
                'harga' => $harga,
                'stock' => $total,
                'warning' => $warning
            ]);

            if ($total <= $warning) {
                $this->notifModel->save([
                    'judul' => "Barang $nama_barang Habis!",
                    'isi' => "Barang $nama_barang Tersisa $total silahkan menambah stock, membeli kembali atau merubah peringatan di Menu Barang",
                    'tujuan' => 2,
                    'status' => 0,
                    'created' => 0,
                    'jenis_created' => 1,
                    'approve' => 0
                ]);
            }
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Barang Gagal Dihapus",
                'response' =>  $this->transaksiBarangModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function updateTransactionBarang()
    {
        $id_user = $this->request->getVar('id_login');
        $id_transaksi = $this->request->getVar('id_transaksi');

        $nilai = $this->transaksiBarangModel->save([
            'id_transaksi_barang' => $this->request->getPost('id_transaksi_barang'),
            'id_transaksi' => $id_transaksi,
            'id_barang' => $this->request->getPost('id_barang'),
            'id_created' => $id_user,
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_barang' => $this->request->getPost('harga'),
            'qty' => $this->request->getPost('qty'),
            'total' => $this->request->getPost('total')
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Barang Berhasil Diubah",
                'response' =>  $this->transaksiBarangModel->findAll()
            ];

            /* Update Transaksi */
            $db = db_connect();

            $result = $db->query("SELECT COUNT(*) as Count FROM `tbl_transaksi_barang` WHERE id_transaksi = '$id_transaksi'");
            $total = 0;
            if ($result->getResultArray() > 0) {
                $tt = $this->transaksiBarangModel->findAll();
                foreach ($tt as $ambil) {
                    if ($ambil['id_transaksi'] == $id_transaksi) {
                        $total += $ambil['total'];
                    }
                }
            }

            $result = $db->query("SELECT judul_transaksi FROM `tbl_transaksi` WHERE id_transaksi = '$id_transaksi'");
            $judul = "";
            if ($result->getResultArray() > 0) {
                foreach ($result->getResultArray() as $ambil) {
                    $judul = $ambil['judul_transaksi'];
                }
            }

            if ($id_user) {
                $this->transaksiModel->save([
                    'id_transaksi' => $id_transaksi,
                    'judul_transaksi' => $judul,
                    'tanggal_transaksi' => date('y-m-d H:i:s'),
                    'total_transaksi' => $total,
                    'id_created' => $id_user
                ]);
            }

            /* Update Menu Barang */
            $qty_before = $this->request->getPost('qty_before');
            $qty = $this->request->getPost('qty');
            $id = $this->request->getPost('id_barang');
            $nama_barang = $this->request->getPost('nama_barang');
            $harga = $this->request->getPost('harga');
            $stock = 0;
            $warning = 0;
            $id_created = 0;

            $result = $db->query("SELECT * FROM `tbl_barang` WHERE id_barang = '$id'");
            if ($result->getResultArray() > 0) {
                foreach ($result->getResultArray() as $ambil) {
                    $stock = $ambil['stock'];
                    $warning = $ambil['warning'];
                    $id_created = $ambil['id_created'];
                }
            }

            $total = ($stock + $qty_before) - $qty;

            $this->barangModel->save([
                'id_barang' => $id,
                'nama_barang' => $nama_barang,
                'id_created' => $id_created,
                'harga' => $harga,
                'stock' => $total,
                'warning' => $warning
            ]);

            if ($total <= $warning) {
                $this->notifModel->save([
                    'judul' => "Barang $nama_barang Habis!",
                    'isi' => "Barang $nama_barang Tersisa $total silahkan menambah stock, membeli kembali atau merubah peringatan di Menu Barang",
                    'tujuan' => 2,
                    'status' => 0,
                    'created' => 0,
                    'jenis_created' => 1,
                    'approve' => 0
                ]);
            }
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data Barang Gagal Diubah",
                'response' =>  $this->transaksiBarangModel->findAll()
            ];
        }

        return json_encode($data);
    }

    /* Menu Users -------------------------------------------------------------------------------------------- */

    public function getUser()
    {
        $data = [
            'data' =>  true,
            'notifikasi' =>  "Data User Berhasil Diunduh",
            'response' =>  $this->userModel->findAll()
        ];

        return json_encode($data);
    }

    public function addUser()
    {
        $nilai = $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'nama_user' => $this->request->getPost('nama_user'),
            'jenis' => $this->request->getPost('jenis')
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data User Berhasil Ditambah",
                'response' =>  $this->userModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data User Gagal Ditambah",
                'response' =>  $this->userModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function deleteUser()
    {
        $nilai = $this->userModel->delete($this->request->getPost('id'));

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data User Berhasil Dihapus",
                'response' =>  $this->userModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data User Gagal Dihapus",
                'response' =>  $this->userModel->findAll()
            ];
        }

        return json_encode($data);
    }

    public function updateUser()
    {
        $nilai = $this->userModel->save([
            'id_user' => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'nama_user' => $this->request->getPost('nama_user'),
            'tanggal_buat' => date('y-m-d H:i:s'),
            'jenis' => $this->request->getPost('jenis')
        ]);

        if ($nilai == 1) {
            $data = [
                'data' =>  true,
                'notifikasi' =>  "Data User Berhasil Diupdate",
                'response' =>  $this->userModel->findAll()
            ];
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Data User Gagal Diupdate",
                'response' =>  $this->userModel->findAll()
            ];
        }

        return json_encode($data);
    }

    /* Login Users ------------------------------------------------------------------------------------------- */

    public function validationUser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = db_connect();
        $result = $db->query("SELECT COUNT(*) as Count FROM `tbl_user` WHERE username = '$username' AND password = '$password'");

        if ($result->getRow()->Count == 1) {
            $user = $this->userModel->findAll();
            foreach ($user as $us) {
                if ($us['username'] == $username && $us['password'] == $password) {
                    $data = [
                        'data' =>  true,
                        'notifikasi' =>  "Selamat anda berhasil Login!",
                        'response' =>  $us
                    ];
                }
            }
        } else {
            $data = [
                'data' =>  false,
                'notifikasi' =>  "Silahkan periksa kembali username dan password anda."
            ];
        }

        return json_encode($data);
    }
}
