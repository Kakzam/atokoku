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
    }
}
