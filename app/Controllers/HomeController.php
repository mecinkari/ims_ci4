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
        if (session()->has('user_id')) {
            $this->userID = session()->get('user_id');
        }
    }

    public function index()
    {
        $this->isLoggedIn();
        $data['title'] = $this->title . '|Dashboard';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        return view('home/index', $data);
    }

    public function user()
    {
        $data['user'] = $this->userModel->find($this->userID);
        $data['title'] = $this->title . '|' . $data['user']['user_name'] . '\'s account';
        $data['appname'] = $this->title;

        echo view('home/user', $data);
    }

    public function change_username()
    {
        $data['user'] = $this->userModel->find($this->userID);
        $data['title'] = $this->title . '|Change Username';
        $data['appname'] = $this->title;

        echo view('home/change_username', $data);
    }

    public function update_username()
    {
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

    public function change_password()
    {
        $data['user'] = $this->userModel->find($this->userID);
        $data['title'] = $this->title . '|Change Username';
        $data['appname'] = $this->title;

        echo view('home/change_password', $data);
    }

    public function update_password()
    {
        $data['user'] = $this->userModel->find($this->userID);
        $data['title'] = $this->title . '|Change Username';
        $data['appname'] = $this->title;

        $validation_rules = [
            'old_password' => [
                'label' => 'Password Lama',
                'rules' => 'required'
            ],
            'new_password' => [
                'label' => 'Password Baru',
                'rules' => 'required|min_length[6]'
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('user/change_password', $data);
        }

        $old_password = (string) $this->request->getPost('old_password');
        $new_password = (string) $this->request->getPost('new_password');
        $user = $this->userModel->find($this->userID);

        if (!password_verify($old_password, $user['user_pass'])) {
            return redirect('user/change_password')->with('error', 'Password lama tidak sesuai!');
        }

        $new_data = [
            'user_pass' => $new_password
        ];

        $this->userModel->update($this->userID, $new_data);
        return redirect('user')->with('success', 'Password berhasil di-update!');
    }
}
