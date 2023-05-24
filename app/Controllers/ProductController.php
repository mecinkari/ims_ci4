<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SupplierModel;
use App\Models\User;
use CodeIgniter\RESTful\ResourceController;

class ProductController extends BaseController
{
    private $userModel, $productModel, $categoryModel, $supplierModel, $userID;
    private $title = 'IMS', $page = 'Product';
    public function __construct()
    {
        if (session()->get('user_id')) {
            $this->userID = session()->get('user_id');
        }

        $this->userModel = new User();
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->supplierModel = new SupplierModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $data['title'] = $this->title . ' | Create ' . $this->page;
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['products'] = $this->productModel->join('categories', 'products.category_id = categories.category_id')->join('suppliers', 'products.supplier_id = suppliers.supplier_id')->findAll();
        // dd($data['products']);
        // dd(string_generator());
        return view('product/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function create()
    {
        $data['title'] = $this->title . ' | Create ' . $this->page;
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['categories'] = $this->categoryModel->findAll();
        $data['suppliers'] = $this->supplierModel->findAll();
        return view('product/create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function save()
    {
        //
        $data['title'] = $this->title . ' | Create ' . $this->page;
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['categories'] = $this->categoryModel->findAll();
        $data['suppliers'] = $this->supplierModel->findAll();

        $validation_rules = [
            'product_name' => [
                'label' => 'Nama Produk',
                'rules' => 'required',
            ],
            'product_desc' => [
                'label' => 'Deskripsi Produk',
                'rules' => 'required',
            ],
            'product_price' => [
                'label' => 'Harga Produk',
                'rules' => 'required',
            ],
            'product_qty' => [
                'label' => 'Stok',
                'rules' => 'required',
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('product/create', $data);
        }

        $product_id = string_generator();
        $product_name = $this->request->getPost('product_name');
        $product_desc = $this->request->getPost('product_desc');
        $product_price = $this->request->getPost('product_price');
        $product_qty = $this->request->getPost('product_qty');
        $supplier_id = $this->request->getPost('supplier_id');
        $category_id = $this->request->getPost('category_id');

        $new_data = [
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_desc' => $product_desc,
            'product_price' => $product_price,
            'product_qty' => $product_qty,
            'supplier_id' => $supplier_id,
            'category_id' => $category_id,
        ];

        $this->productModel->insert($new_data);
        return redirect('admin/master_product')->with('success', 'Produk "' . $product_name . '" berhasil ditambahkan ke database!');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data['title'] = $this->title . ' | Edit ' . $this->page;
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['product'] = $this->productModel->find($id);
        $data['categories'] = $this->categoryModel->findAll();
        $data['suppliers'] = $this->supplierModel->findAll();
        // dd($data['product']);
        return view('product/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
        $data['title'] = $this->title . ' | Create ' . $this->page;
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['categories'] = $this->categoryModel->findAll();
        $data['suppliers'] = $this->supplierModel->findAll();

        $validation_rules = [
            'product_name' => [
                'label' => 'Nama Produk',
                'rules' => 'required',
            ],
            'product_desc' => [
                'label' => 'Deskripsi Produk',
                'rules' => 'required',
            ],
            'product_price' => [
                'label' => 'Harga Produk',
                'rules' => 'required',
            ],
            'product_qty' => [
                'label' => 'Stok',
                'rules' => 'required',
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('product/edit/' . $id, $data);
        }

        $product_name = $this->request->getPost('product_name');
        $product_desc = $this->request->getPost('product_desc');
        $product_price = $this->request->getPost('product_price');
        $product_qty = $this->request->getPost('product_qty');
        $supplier_id = $this->request->getPost('supplier_id');
        $category_id = $this->request->getPost('category_id');

        $new_data = [
            'product_name' => $product_name,
            'product_desc' => $product_desc,
            'product_price' => $product_price,
            'product_qty' => $product_qty,
            'supplier_id' => $supplier_id,
            'category_id' => $category_id,
        ];

        $this->productModel->update($id, $new_data);
        return redirect('admin/master_product')->with('success', 'Produk "' . $product_name . '" berhasil di-update!');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
        $this->productModel->delete($id);
        return redirect('admin/master_product')->with('success', 'Produk berhasil dihapus!');
    }
}
