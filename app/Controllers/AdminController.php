<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

class AdminController extends BaseController
{
    private $title = 'IMS';

    private $userModel, $roleModel, $profileModel, $userID;

    public function __construct()
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
        $this->profileModel = new Profile();
        $this->userID = session()->get('user_id');
    }

    public function index()
    {
        $data['title'] = $this->title . '|Dashboard';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        return view('home/index', $data);
    }

    public function master_user()
    {
        //
        $db = \Config\Database::connect();

        $data['title'] = $this->title . '|Master User';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        $builder = $db->table('users');
        $builder->select('users.user_id, users.user_name, roles.role_name');
        $builder->join('roles', 'users.role_id = roles.role_id');
        $builder->where('users.user_id !=', $this->userID);
        $data['allUsers'] = $builder->get()->getResult();
        echo view('admin/master_user', $data);
    }

    public function create_user()
    {

        $data['title'] = $this->title . '|Create User';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['roles'] = $this->roleModel->findAll();
        echo view("admin/create_user", $data);
    }

    public function save_user()
    {
        $data['title'] = $this->title . '|Create User';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['roles'] = $this->roleModel->findAll();

        $validation_rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[6]|max_length[12]|is_unique[users.user_name]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('admin/create_user', $data);
        }

        $new_userID = string_generator();

        $new_data_user = [
            'user_id' => $new_userID,
            'user_name' => $this->request->getPost('username'),
            'user_pass' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id' => $this->request->getPost('role_id'),
        ];

        $new_user_profile = [
            'user_id' => $new_userID,
            'full_name' => 'New User',
            'no_hp' => '',
            'email' => '',
            'address_1' => '',
            'address_2' => '',
        ];

        $this->userModel->insert($new_data_user);
        $this->profileModel->insert($new_user_profile);

        return redirect('admin/master_user')->with('success', 'Data user baru berhasil ditambahkan!');
    }

    public function edit_user($id = null)
    {
        role_check($this->userID, [1, 2, 3]);

        $user = $this->userModel->find($id);

        $data['title'] = $this->title . '|Edit User ' . $user['user_name'];
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['roles'] = $this->roleModel->findAll();
        $data['data_user'] = $user;
        echo view("admin/edit_user", $data);
    }

    public function update_user($id = null)
    {
        role_check($this->userID, [1, 2, 3]);

        $user = $this->userModel->find($id);

        $data = [
            'role_id' => $this->request->getPost('role_id')
        ];

        $this->userModel->update($id, $data);
        return redirect('admin/master_user')->with('success', 'User "' . $user['user_name'] . '" telah berhasil di-update!');
    }

    public function delete_user($id = null)
    {
        role_check($this->userID, [1, 2, 3]);

        $this->roleModel->where('user_id', $id)->delete();
        $this->userModel->delete($id);
        return redirect('admin/master_user')->with('success', 'User berhasil dihapus dari database!');
    }
}
