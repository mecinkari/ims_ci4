<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    private $title = 'IMS';

    public function index()
    {
        //
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $data['title'] = $this->title . '|Dashboard';
        $data['appname'] = $this->title;
        $data['user'] = session()->get('user');

        echo view('home/index', $data);
    }

    public function user()
    {
        //
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $data['user'] = session()->get('user');
        $data['title'] = $this->title . '|' . $data['user']['user_name'] . '\'s account';
        $data['appname'] = $this->title;

        echo view('home/user', $data);
    }

    public function change_username()
    {
        //
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $data['user'] = session()->get('user');
        $data['title'] = $this->title . '|Change Username';
        $data['appname'] = $this->title;

        echo view('home/change_username', $data);
    }
}
