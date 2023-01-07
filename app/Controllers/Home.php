<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }

    public function barang()
    {
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $paginate = 5;

        $search = $this->request->getVar('search');
        if ($search) {
            $barang = $this->barangModel->like('nama_barang', $search)->orLike('id_barang', $search);
        } else {
            $barang = $this->barangModel;
        }

        $data = [
            'title' => 'Barang',
            'barang' => $this->barangModel->findAll(),
            // 'barang' => $barang->paginate($paginate),
            'pager' => $this->barangModel->pager,
            'page' => $page,
            'paginate' => $paginate
        ];
        return session()->getTempdata('is_login') ? view('tambah_barang', $data) : redirect()->to(base_url());
    }

    public function transaksi()
    {
        $data = [
            'title' => 'Transaksi',
            'transaksi' => $this->transaksiModel->findAll()
        ];
        return session()->getTempdata('is_login') ? view('tambah_transaksi', $data) : redirect()->to(base_url());
    }

    public function transaksi_barang()
    {
        if ($this->request->getVar('id')) $id = $this->request->getVar('id');
        else $id = session()->getFlashdata('id');

        $db = db_connect();
        session()->setFlashdata('id', $id);

        $items = $this->barangModel->findAll();
        $itemTransactions = $db->query("SELECT * FROM `tbl_transaksi_barang` WHERE id_transaksi='$id'")->getResultArray();
        $Fitems = array();

        foreach ($items as $item) {
            $check = true;
            foreach ($itemTransactions as $itemTransaction) {
                if ($item['id_barang'] == $itemTransaction['id_barang']) {
                    $check = false;
                }
            }
            if ($check) {
                array_push($Fitems, $item);
            }
        }

        $data = [
            'title' => 'Barang Belanja',
            'keterangan' => $db->query("SELECT * FROM `tbl_transaksi` WHERE id_transaksi='$id'")->getResultArray(),
            'barang' => $itemTransactions,
            'list' => $Fitems
            // 'list' => $db->query("SELECT * FROM `tbl_barang`")->getResultArray()
        ];

        return session()->getTempdata('is_login') ? view('tambah_transaksi_barang', $data) : redirect()->to(base_url());
    }

    public function user()
    {
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $paginate = 5;

        $search = $this->request->getVar('search');
        if ($search) {
            $user = $this->userModel->like('username', $search)->orLike('name_user', $search);
        } else {
            $user = $this->userModel;
        }

        $data = [
            'title' => 'Users',
            'user' => $this->userModel->findAll(),
            // 'user' => $user->paginate($paginate),
            'pager' => $this->userModel->pager,
            'page' => $page,
            'paginate' => $paginate
        ];

        return session()->getTempdata('is_login') ? view('tambah_user', $data) : redirect()->to(base_url());
    }

    public function notifikasi()
    {
        $data = [
            'title' => 'Notifikasi',
            'notif' => $this->notifModel->findAll()
        ];

        return session()->getTempdata('is_login') ? view('notifikasi', $data) : redirect()->to(base_url());
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'user' => $this->userModel->countAll(),
            'transaksi' => $this->transaksiModel->countAll(),
            'barang' => $this->barangModel->countAll()
        ];

        return session()->getTempdata('is_login') ? view('dashboard', $data) : redirect()->to(base_url());
    }
}
