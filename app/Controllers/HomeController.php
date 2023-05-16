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
}
