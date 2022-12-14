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
    }
}
