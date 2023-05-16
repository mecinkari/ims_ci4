<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

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
            $user = new User();

            $data['username'] = (string)$this->request->getPost('username');
            $data['password'] = (string)$this->request->getPost('password');

            $data['user'] = $user->select()->where('user_name', $data['username'])->first();

            if ($data['user']) {
                if (password_verify($data['password'], $data['user']['user_pass'])) {
                    session()->set('user', $data['user']);
                    session()->setFlashdata('success', 'Selamat Datang!');
                    return redirect('dashboard');
                } else {
                    session()->setFlashdata('error', 'Password Salah!');
                    return redirect('auth/login');
                }
            } else {
                session()->setFlashdata('error', 'User tidak ditemukan!');
                return redirect('auth/login');
            }
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/login', $data);
        }
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'Berhasil logout!');
        return redirect('auth/login');
    }
}
