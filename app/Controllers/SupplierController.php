<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile;
use App\Models\Role;
use App\Models\SupplierModel;
use App\Models\User;

class SupplierController extends BaseController
{
    private $title = 'IMS', $profileModel, $roleModel, $userModel, $supplierModel, $userID;

    public function __construct()
    {
        $this->profileModel = new Profile();
        $this->roleModel = new Role();
        $this->userModel = new User();
        $this->supplierModel = new SupplierModel();
        if (session()->get('user_id')) {
            $this->userID = session()->get('user_id');
        }
    }

    public function index()
    {
        $data['title'] = $this->title . '|Master Suppliers';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['suppliers'] = $this->supplierModel->findAll();

        return view('supplier/index', $data);
    }

    public function create()
    {
        $data['title'] = $this->title . '|Create Suppliers';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        return view('supplier/create', $data);
    }

    public function save()
    {
        $data['title'] = $this->title . '|Create Suppliers';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        $validation_rules = [
            'supplier_name' => [
                'label' => 'Nama Supplier',
                'rules' => 'required'
            ],
            'supplier_address' => [
                'label' => 'Alamat Supplier',
                'rules' => 'required'
            ],
            'supplier_phone' => [
                'label' => 'No Telp.',
                'rules' => 'required|min_length[9]'
            ],
            'supplier_email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[suppliers.supplier_email]'
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('supplier/create', $data);
        }

        $supplier_id = string_generator(15);
        $supplier_name = $this->request->getPost('supplier_name');
        $supplier_address = $this->request->getPost('supplier_address');
        $supplier_phone = $this->request->getPost('supplier_phone');
        $supplier_email = $this->request->getPost('supplier_email');

        $new_data = [
            'supplier_id' => $supplier_id,
            'supplier_name' => $supplier_name,
            'supplier_address' => $supplier_address,
            'supplier_phone' => $supplier_phone,
            'supplier_email' => $supplier_email,
        ];

        $this->supplierModel->insert($new_data);
        return redirect()->to('admin/master_supplier')->with('success', 'Data Supplier berhasil ditambahkan');
    }

    public function edit($id = null)
    {
        $data['title'] = $this->title . '|Edit Suppliers';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['supplier'] = $this->supplierModel->find($id);

        return view('supplier/edit', $data);
    }

    public function update($id = null)
    {
        $data['title'] = $this->title . '|Edit Suppliers';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        $validation_rules = [
            'supplier_name' => [
                'label' => 'Nama Supplier',
                'rules' => 'required'
            ],
            'supplier_address' => [
                'label' => 'Alamat Supplier',
                'rules' => 'required'
            ],
            'supplier_phone' => [
                'label' => 'No Telp.',
                'rules' => 'required|min_length[9]'
            ],
            'supplier_email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('supplier/edit', $data);
        }

        $supplier_name = $this->request->getPost('supplier_name');
        $supplier_address = $this->request->getPost('supplier_address');
        $supplier_phone = $this->request->getPost('supplier_phone');
        $supplier_email = $this->request->getPost('supplier_email');

        $new_data = [
            'supplier_name' => $supplier_name,
            'supplier_address' => $supplier_address,
            'supplier_phone' => $supplier_phone,
            'supplier_email' => $supplier_email,
        ];

        $this->supplierModel->update($id, $new_data);
        return redirect()->to('admin/master_supplier')->with('success', 'Data Supplier berhasil di-update');
    }

    public function export()
    {
        $staticData = new StaticData();
        $data = $staticData->get_static_data('Export Data Supplier');
        $data['suppliers'] = $this->supplierModel->findAll();
        return view('supplier/export', $data);
    }
}
