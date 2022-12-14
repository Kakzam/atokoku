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
    }
}
