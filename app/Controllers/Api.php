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
        return view('welcome_message');
    }
}
