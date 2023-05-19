<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class HomeController extends BaseController
{
    private $title = 'IMS';

    private $userModel;
    private $userID;

    public function __construct()
    {
        $this->userModel = new User();
        $this->userID = session()->get('user')['user_id'];
    }

    public function index()
    {
        //
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $data['title'] = $this->title . '|Dashboard';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        echo view('home/index', $data);
    }

    public function user()
    {
        //
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $data['user'] = $this->userModel->find($this->userID);
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

        $data['user'] = $this->userModel->find($this->userID);
        $data['title'] = $this->title . '|Change Username';
        $data['appname'] = $this->title;

        echo view('home/change_username', $data);
    }

    public function update_username()
    {
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $data['user'] = $this->userModel->find($this->userID);
        $data['title'] = $this->title . '|Change Username';
        $data['appname'] = $this->title;

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[6]|max_length[24]|is_unique[users.user_name]'
            ]
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('home/change_username', $data);
        }

        date_default_timezone_set("Asia/Jakarta");

        $new_username = [
            'user_name' => $this->request->getPost('username'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $this->userModel->update($this->userID, $new_username);
        $data['user']['user_name'] = $this->request->getPost('username');

        session()->set('user', $data['user']);
        session()->setFlashdata('success', 'Username berhasil di-update!');
        return redirect('user');
    }
}
