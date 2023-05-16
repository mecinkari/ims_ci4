<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile;
use App\Models\Role;

class ProfileController extends BaseController
{
    private $title = 'IMS';

    public function index()
    {
        //
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $profile = new Profile();
        $role = new Role();

        $data['title'] = $this->title . '|Profile';
        $data['appname'] = $this->title;
        $data['user'] = session()->get('user');
        $data['profile'] = $profile->where('user_id', $data['user']['user_id'])->first();
        $data['role'] = $role->where('role_id', $data['user']['role_id'])->first();

        echo view('home/profile', $data);
    }

    public function update()
    {
        //
        if (!session()->get('user')) {
            session()->setFlashdata('error', 'Anda belum login');
            return redirect('auth/login');
        }

        $profile = new Profile();

        $id = $this->request->getPost('profile_id');
        $data_profile['full_name'] = $this->request->getPost('full_name');
        $data_profile['no_hp'] = $this->request->getPost('no_hp');
        $data_profile['email'] = $this->request->getPost('email');
        $data_profile['address_1'] = $this->request->getPost('address_1');
        $data_profile['address_2'] = $this->request->getPost('address_2');

        // echo $id;
        // print_r($data_profile);
        $profile->update($id, $data_profile);
        session()->setFlashdata('success', 'Data berhasil diperbarui');
        return redirect('profile');
    }
}
