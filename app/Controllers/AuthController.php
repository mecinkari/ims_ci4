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

    public function check_login()
    {
        $data['title'] = $this->title . '-Register';
        $data['appname'] = $this->title;
        helper(['form']);

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
            ]
        ];

        if ($this->validate($rules)) {
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];
            print_r($data);
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/login', $data);
        }
    }
}
