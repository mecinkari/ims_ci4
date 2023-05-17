<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class AdminController extends BaseController
{
    private $title = 'IMS';

    public function master_user()
    {
        //
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $session = session()->get('user');

        if (!in_array($session['role_id'], array(1, 2, 3))) {
            return redirect()->back();
        }

        $db = \Config\Database::connect();

        $data['title'] = $this->title . '|Master User';
        $data['appname'] = $this->title;
        $data['user'] = session()->get('user');


        $builder = $db->table('users');
        $builder->select('users.user_id, users.user_name, roles.role_name');
        $builder->join('roles', 'users.role_id = roles.role_id');
        $builder->where('users.user_id !=', $data['user']['user_id']);
        $data['allUsers'] = $builder->get()->getResult();
        echo view('admin/master_user', $data);
    }

    public function create_user()
    {
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $session = session()->get('user');

        if (!in_array($session['role_id'], array(1, 2, 3))) {
            return redirect()->back();
        }

        $db = \Config\Database::connect();

        $data['title'] = $this->title . '|Create User';
        $data['appname'] = $this->title;
        $data['user'] = session()->get('user');
        echo view("admin/create_user", $data);
    }
}
