<?php

namespace App\Controllers;

class Api extends BaseController
{
    public function test()
    {
        $requests = $this->barangModel->findAll();
        // dd($requests);

        $data = array();
        foreach ($requests as $request) {
            array_push($data, $request);
        }

        dd($data);
    }

    public function index()
    {
        $data = $this->userModel->findAll();
        foreach ($data as $a) {
            echo $a['id_user'], " <br>";
        }
    }

    /* Menu Barang ------------------------------------------------------------------------------------------- */

    public function addItem()
    {
        $nilai = $this->barangModel->save([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'id_created' => session()->getTempdata('id_login'),
            'harga' => $this->request->getPost('harga'),
            'stock' => $this->request->getPost('stock'),
            'warning' => $this->request->getPost('warning')
            // 'tanggal_buat' => date('y-m-d H:i:s')
        ]);

        if ($nilai == 1) {
            session()->setFlashdata('pesan', 'Data Barang Berhasil Ditambah');
            session()->setFlashdata('icon', 'success');
            session()->setFlashdata('title', 'Berhasil');
        } else {
            session()->setFlashdata('pesan', 'Data Barang Gagal Ditambah');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }

        return redirect()->to(base_url() . "/barang");
    }

    public function deleteItem()
    {
        $id = $this->request->getVar('id');
        $nilai = $this->barangModel->delete($id);

        if ($nilai == 1) {
            session()->setFlashdata('pesan', 'Data Barang Berhasil Dihapus');
            session()->setFlashdata('icon', 'success');
            session()->setFlashdata('title', 'Berhasil');
        } else {
            session()->setFlashdata('pesan', 'Data Barang Gagal Dihapus');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }

        return redirect()->to(base_url() . "/barang");
    }

    public function updateItem()
    {
        if (session()->getTempdata('id_login')) {
            $id = $this->request->getVar('id_barang');
            $nilai = $this->barangModel->save([
                'id_barang' => $id,
                'nama_barang' => $this->request->getPost('nama_barang'),
                'id_created' => session()->getTempdata('id_login'),
                'harga' => $this->request->getPost('harga'),
                'stock' => $this->request->getPost('stock'),
                'warning' => $this->request->getPost('warning')
            ]);

            if ($nilai == 1) {
                session()->setFlashdata('pesan', 'Data Barang Berhasil Diupdate');
                session()->setFlashdata('icon', 'success');
                session()->setFlashdata('title', 'Berhasil');
            } else {
                session()->setFlashdata('pesan', 'Data Barang Gagal Diupdate');
                session()->setFlashdata('icon', 'error');
                session()->setFlashdata('title', 'Gagal');
            }
        } else {
            session()->setFlashdata('pesan', 'Data Barang Gagal Diupdate');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }


        return redirect()->to(base_url() . "/barang");
    }

    /* Menu Notification ------------------------------------------------------------------------------------- */

    public function addNotification()
    {
        $id = session()->getTempdata('id_login');

        if ($id) {
            $nilai = $this->notifModel->save([
                'judul' => $this->request->getVar('judul'),
                'isi' => $this->request->getVar('isi'),
                'tujuan' => $this->request->getVar('tujuan'),
                'status' => 0,
                'created' => session()->getTempdata('id_login'),
                'jenis_created' => session()->getTempdata('jenis'),
                'approve' => 0
            ]);

            if ($nilai == 1) {
                session()->setFlashdata('pesan', 'Notifikasi Berhasil Ditambah');
                session()->setFlashdata('icon', 'success');
                session()->setFlashdata('title', 'Berhasil');
            } else {
                session()->setFlashdata('pesan', 'Notifikasi Gagal Ditambah');
                session()->setFlashdata('icon', 'error');
                session()->setFlashdata('title', 'Gagal');
            }
        } else {
            session()->setFlashdata('pesan', 'Notifikasi Gagal Ditambah');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }

        return redirect()->to(base_url() . "/notif");
    }

    public function deleteNotification()
    {
        $id = $this->request->getVar('id');
        $nilai = $this->notifModel->delete($id);

        if ($nilai == 1) {
            session()->setFlashdata('pesan', 'Notifikasi Berhasil Dihapus');
            session()->setFlashdata('icon', 'success');
            session()->setFlashdata('title', 'Berhasil');
        } else {
            session()->setFlashdata('pesan', 'Notifikasi Gagal Dihapus');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }

        return redirect()->to(base_url() . "/notif");
    }

    public function approveNotification()
    {
        $nilai = $this->notifModel->save([
            'judul' => $this->request->getVar('judul'),
            'isi' => $this->request->getVar('isi'),
            'tujuan' => $this->request->getVar('tujuan'),
            'status' => 0,
            'created' => session()->getTempdata('id_login'),
            'jenis_created' => session()->getTempdata('jenis'),
            'approve' => 0
        ]);

        if ($nilai == 1) {
            session()->setFlashdata('pesan', 'Data Barang Berhasil Ditambah');
            session()->setFlashdata('icon', 'success');
            session()->setFlashdata('title', 'Berhasil');
        } else {
            session()->setFlashdata('pesan', 'Data Barang Gagal Ditambah');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }

        return redirect()->to(base_url() . "/barang");
    }

    /* Menu Transaction -------------------------------------------------------------------------------------- */

    public function addTransaction()
    {
        $id_login = session()->getTempdata('id_login');

        if ($id_login) {
            $nilai = $this->transaksiModel->save([
                'judul_transaksi' => $this->request->getPost('judul_transaksi'),
                'total_transaksi' => 0,
                'id_created' => $id_login
            ]);

            if ($nilai == 1) {
                session()->setFlashdata('pesan', 'Data Transaksi Berhasil Ditambah');
                session()->setFlashdata('icon', 'success');
                session()->setFlashdata('title', 'Berhasil');
            } else {
                session()->setFlashdata('pesan', 'Data Transaksi Gagal Ditambah');
                session()->setFlashdata('icon', 'error');
                session()->setFlashdata('title', 'Gagal');
            }
        }

        return redirect()->to(base_url() . "/transaksi");
    }

    public function deleteTransaction()
    {
        $id = $this->request->getVar('id');
        $nilai = $this->transaksiModel->delete($id);

        if ($nilai == 1) {
            session()->setFlashdata('pesan', 'Data Transaksi Berhasil Dihapus');
            session()->setFlashdata('icon', 'success');
            session()->setFlashdata('title', 'Berhasil');
        } else {
            session()->setFlashdata('pesan', 'Data Transaksi Gagal Dihapus');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }

        return redirect()->to(base_url() . "/transaksi");
    }

    public function updateTransaction()
    {
        $id_login = session()->getTempdata('id_login');

        if ($id_login) {
            $id = $this->request->getVar('id');
            $db = db_connect();
            $id_user = session()->getTempdata('id_login');

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

            if ($id_user) {
                $nilai = $this->transaksiModel->save([
                    'id_transaksi' => $id,
                    'judul_transaksi' => $this->request->getVar('judul_transaksi'),
                    'tanggal_transaksi' => date('y-m-d H:i:s'),
                    'total_transaksi' => $total,
                    'id_created' => $id_login
                ]);
            }

            if ($nilai == 1) {
                session()->setFlashdata('pesan', 'Data Transaksi Berhasil Diupdate');
                session()->setFlashdata('icon', 'success');
                session()->setFlashdata('title', 'Berhasil');
            } else {
                session()->setFlashdata('pesan', 'Data Transaksi Gagal Diupdate');
                session()->setFlashdata('icon', 'error');
                session()->setFlashdata('title', 'Gagal');
            }
        }

        return redirect()->to(base_url() . "/transaksi");
    }

    /* Menu Transaction Barang ------------------------------------------------------------------------------- */

    public function addTransactionBarang()
    {
        $id_transaksi = session()->getFlashdata('id_transaksi');
        session()->setFlashdata('id', $id_transaksi);

        $nilai = $this->transaksiBarangModel->save([
            'id_transaksi' => $id_transaksi,
            'id_barang' => $this->request->getVar('id'),
            'id_created' => session()->getTempdata('id_login'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga_barang' => $this->request->getVar('harga'),
            'qty' => $this->request->getVar('qty'),
            'total' => $this->request->getVar('total')
        ]);

        if ($nilai == 1) {
            session()->setFlashdata('pesan', 'Data Barang Berhasil Ditambah');
            session()->setFlashdata('icon', 'success');
            session()->setFlashdata('title', 'Berhasil');

            /* Update Menu Transaksi */
            $db = db_connect();
            $id_user = session()->getTempdata('id_login');

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
                    'id_created' => session()->getTempdata('id_login')
                ]);
            }

            /* Update Menu Barang */
            $stock = $this->request->getVar('stock');
            $warning = $this->request->getVar('warning');
            $qty = $this->request->getVar('qty');
            $id = $this->request->getVar('id');
            $id_created = $this->request->getVar('id_created');
            $nama_barang = $this->request->getVar('nama_barang');
            $harga = $this->request->getVar('harga');
            $total = $stock - $qty;

            // echo $stock, "<br>";
            // echo $warning, "<br>";
            // echo $qty, "<br>";
            // echo $id, "<br>";
            // echo $id_created, "<br>";
            // echo $nama_barang, "<br>";
            // echo $harga, "<br>";
            // echo $total, "<br>";

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
            session()->setFlashdata('pesan', 'Data Barang Gagal Ditambah');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }

        return redirect()->to(base_url() . "/transaksi_barang");
    }

    public function deleteTransactionBarang()
    {
        $id_user = session()->getTempdata('id_login');
        if ($id_user) {
            $id_transaksi = session()->getFlashdata('id_transaksi');
            session()->setFlashdata('id', $id_transaksi);

            $id_transaksi_barang = $this->request->getVar('id_transaksi_barang');
            $nilai = $this->transaksiBarangModel->delete($id_transaksi_barang);

            if ($nilai == 1) {
                session()->setFlashdata('pesan', 'Data Barang Berhasil Dihapus');
                session()->setFlashdata('icon', 'success');
                session()->setFlashdata('title', 'Berhasil');

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
                $id_barang = $this->request->getVar('id_barang');
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

                $qty_before = $this->request->getVar('qty_before');
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
                session()->setFlashdata('pesan', 'Data Barang Gagal Dihapus');
                session()->setFlashdata('icon', 'error');
                session()->setFlashdata('title', 'Gagal');
            }
        } else {
            session()->setFlashdata('pesan', 'Data Barang Gagal Dihapus');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }


        return redirect()->to(base_url() . "/transaksi_barang");
    }

    public function updateTransactionBarang()
    {
        $id_user = session()->getTempdata('id_login');
        if ($id_user) {
            $id_transaksi = session()->getFlashdata('id_transaksi');
            session()->setFlashdata('id', $id_transaksi);

            $nilai = $this->transaksiBarangModel->save([
                'id_transaksi_barang' => $this->request->getVar('id_transaksi_barang'),
                'id_transaksi' => $id_transaksi,
                'id_barang' => $this->request->getVar('id_barang'),
                'id_created' => $id_user,
                'nama_barang' => $this->request->getVar('nama_barang'),
                'harga_barang' => $this->request->getVar('harga'),
                'qty' => $this->request->getVar('qty'),
                'total' => $this->request->getVar('total')
            ]);

            if ($nilai == 1) {
                session()->setFlashdata('pesan', 'Data Barang Berhasil Diubah');
                session()->setFlashdata('icon', 'success');
                session()->setFlashdata('title', 'Berhasil');

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
                $qty_before = $this->request->getVar('qty_before');
                $qty = $this->request->getVar('qty');
                $id = $this->request->getVar('id_barang');
                $nama_barang = $this->request->getVar('nama_barang');
                $harga = $this->request->getVar('harga');
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
                session()->setFlashdata('pesan', 'Data Barang Gagal Diubah');
                session()->setFlashdata('icon', 'error');
                session()->setFlashdata('title', 'Gagal');
            }
        } else {
            session()->setFlashdata('pesan', 'Data Barang Gagal Diubah');
            session()->setFlashdata('icon', 'error');
            session()->setFlashdata('title', 'Gagal');
        }

        return redirect()->to(base_url() . "/transaksi_barang");
    }
    }
}
