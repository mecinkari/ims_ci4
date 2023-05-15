<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    private $title = 'IMS';

    public function login()
    {
        //
        $data = [
            'title' => $this->title . '-Login',
            'appname' => $this->title,
        ];

        echo view('auth/login', $data);
    }

    public function register()
    {
        //
        $data = [
            'title' => $this->title . '-Register',
            'appname' => $this->title,
        ];

        echo view('auth/register', $data);
    }
}
