<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

class ProfileController extends BaseController
{
    private $title = 'IMS', $profileModel, $roleModel, $userModel, $userID;

    public function __construct()
    {
        $this->profileModel = new Profile();
        $this->roleModel = new Role();
        $this->userModel = new User();
        $this->userID = session()->get('user_id');
    }

    public function index()
    {
        //
        $data['title'] = $this->title . '|Profile';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['profile'] = $this->profileModel->where('user_id', $this->userID)->first();
        $data['role'] = $this->roleModel->find($data['user']['role_id']);

        echo view('home/profile', $data);
    }

    public function update()
    {
        //
        $id = $this->request->getPost('profile_id');
        $data_profile['full_name'] = $this->request->getPost('full_name');
        $data_profile['no_hp'] = $this->request->getPost('no_hp');
        $data_profile['email'] = $this->request->getPost('email');
        $data_profile['address_1'] = $this->request->getPost('address_1');
        $data_profile['address_2'] = $this->request->getPost('address_2');

        $this->profileModel->update($id, $data_profile);
        session()->setFlashdata('success', 'Data berhasil diperbarui');
        return redirect('profile');
    }
}
