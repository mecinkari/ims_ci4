<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

class CategoryController extends BaseController
{
    private $title = 'IMS', $profileModel, $roleModel, $userModel, $categoryModel, $userID, $staticData;

    public function __construct()
    {
        $this->profileModel = new Profile();
        $this->roleModel = new Role();
        $this->userModel = new User();
        $this->categoryModel = new Category();
        $this->staticData = new StaticData();
        if (session()->get('user_id')) {
            $this->userID = session()->get('user_id');
        }
    }

    public function index()
    {
        $data['title'] = $this->title . '|Master Category';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['categories'] = $this->categoryModel->findAll();

        return view('category/index', $data);
    }

    public function create()
    {
        $data['title'] = $this->title . '|Create Category';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        echo view('category/create', $data);
    }

    public function save()
    {
        $data['title'] = $this->title . '|Create Category';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        $validation_rules = [
            'category_name' => [
                'label' => 'Nama Kategori',
                'rules' => 'required'
            ],
            'category_desc' => [
                'label' => 'Deskripsi',
                'rules' => 'required'
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('category/create', $data);
        }

        $category_name = $this->request->getPost('category_name');
        $category_desc = $this->request->getPost('category_desc');

        $new_data = [
            'category_name' => $category_name,
            'category_desc' => $category_desc,
            'category_slug' => textToSlug($category_name)
        ];

        $this->categoryModel->insert($new_data);

        return redirect()->to('admin/master_category')->with('success', 'Data kategori "' . $category_name . '" telah ditambahkan ke database!');
    }

    public function edit($id = null)
    {
        $data['title'] = $this->title . '|Edit Category';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['category'] = $this->categoryModel->find($id);

        return view('category/edit', $data);
    }

    public function update($id = null)
    {
        $data['title'] = $this->title . '|Edit Category';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        $validation_rules = [
            'category_name' => [
                'label' => 'Nama Kategori',
                'rules' => 'required'
            ],
            'category_desc' => [
                'label' => 'Deskripsi',
                'rules' => 'required'
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('category/edit', $data);
        }

        $category_name = $this->request->getPost('category_name');
        $category_desc = $this->request->getPost('category_desc');

        $new_data = [
            'category_name' => $category_name,
            'category_desc' => $category_desc,
            'category_slug' => textToSlug($category_name)
        ];

        $this->categoryModel->update($id, $new_data);

        return redirect()->to('admin/master_category')->with('success', 'Data kategori "' . $category_name . '" berhasil di-update!!');
    }

    public function delete($id = null)
    {
        $this->categoryModel->delete($id);
        return redirect()->to('admin/master_category')->with('success', 'Data berhasil dihapus dari database!!');
    }

    public function export()
    {
        $data = $this->staticData->get_static_data('Category');
        $data['categories'] = $this->categoryModel->findAll();
        return view('category/export', $data);
    }
}
