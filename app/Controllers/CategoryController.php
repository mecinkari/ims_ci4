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
        $this->userID = session()->get('user')['user_id'];
    }

    public function index()
    {
        //
        auth_check();
        role_check();

        $data['title'] = $this->title . '|Master Category';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        echo view('category/index', $data);
    }
}
