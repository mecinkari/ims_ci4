<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

class CategoryController extends BaseController
{
    private $title = 'IMS', $profileModel, $roleModel, $userModel, $categoryModel, $userID;

    public function __construct()
    {
        $this->profileModel = new Profile();
        $this->roleModel = new Role();
        $this->userModel = new User();
        $this->categoryModel = new Category();
        if (session()->get('user')) {
            $this->userID = session()->get('user')['user_id'];
        }
    }

    public function index()
    {
        //
        helper('custom');
        is_logged_in();
        role_check('dL4erzyyJbTy', [2, 3]);

        $data['title'] = $this->title . '|Master Category';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        return view('category/index', $data);
    }

    public function create()
    {
        is_logged_in();
        role_check($this->userID, [3]);
        $data['title'] = $this->title . '|Master Category';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        echo view('category/create', $data);
    }
}
