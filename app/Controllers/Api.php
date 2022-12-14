<?php

namespace App\Controllers;

class Api extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
}
