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
}
