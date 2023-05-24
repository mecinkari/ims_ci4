<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    private $title = 'IMS';
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        //
        $data = [
            'title' => $this->title . '-Login',
            'appname' => $this->title,
            'string' => string_generator()
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

            $data['username'] = (string)$this->request->getPost('username');
            $data['password'] = (string)$this->request->getPost('password');

            $data['user'] = $this->userModel->select()->where('user_name', $data['username'])->first();

            if ($data['user']) {
                if (password_verify($data['password'], $data['user']['user_pass'])) {
                    session()->set('user_id', $data['user']['user_id']);
                    session()->setFlashdata('success', 'Selamat Datang ' . $data['user']['user_name'] . '!');
                    if (in_array($data['user']['role_id'], [1, 2, 3, 4])) {
                        return redirect()->to('dashboard');
                    } else {
                        return redirect()->to('home');
                    }
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
        session()->remove('user_id');
        session()->setFlashdata('success', 'Berhasil logout!');
        return redirect('auth/login');
    }

    public function forbidden()
    {
        return view('auth/error_403');
    }
}
