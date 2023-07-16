<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use CodeIgniter\RESTful\ResourceController;

class ProductController extends BaseController
{
    private $userModel, $productModel, $categoryModel, $supplierModel, $userID, $staticData;
    private $page = 'Product';
    public function __construct()
    {
        if (session()->get('user_id')) {
            $this->userID = session()->get('user_id');
        }

        $this->userModel = new User();
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->supplierModel = new Supplier();
        $this->staticData = new StaticData();
    }

    public function index()
    {
        $data = $this->staticData->get_static_data(' | Create ' . $this->page);
        $data['products'] = $this->productModel->join('categories', 'products.category_id = categories.category_id')->findAll();
        return view('product/index', $data);
    }

    public function create()
    {
        $data = $this->staticData->get_static_data(' | Create ' . $this->page);
        $data['categories'] = $this->categoryModel->findAll();
        $data['suppliers'] = $this->supplierModel->findAll();
        return view('product/create', $data);
    }

    public function save()
    {
        $data = $this->staticData->get_static_data(' | Create ' . $this->page);
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
        $category_id = $this->request->getPost('category_id');

        $new_data = [
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_desc' => $product_desc,
            'product_price' => $product_price,
            'product_qty' => $product_qty,
            'category_id' => $category_id,
        ];

        $this->productModel->insert($new_data);
        return redirect('admin/master_product')->with('success', 'Produk "' . $product_name . '" berhasil ditambahkan ke database!');
    }

    public function edit($id = null)
    {
        $data = $this->staticData->get_static_data(' | Edit ' . $this->page);
        $data['product'] = $this->productModel->find($id);
        $data['categories'] = $this->categoryModel->findAll();
        $data['suppliers'] = $this->supplierModel->findAll();
        return view('product/edit', $data);
    }

    public function update($id = null)
    {
        $data = $this->staticData->get_static_data(' | Create ' . $this->page);
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
        $category_id = $this->request->getPost('category_id');

        $new_data = [
            'product_name' => $product_name,
            'product_desc' => $product_desc,
            'product_price' => $product_price,
            'product_qty' => $product_qty,
            'category_id' => $category_id,
        ];

        $this->productModel->update($id, $new_data);
        return redirect('admin/master_product')->with('success', 'Produk "' . $product_name . '" berhasil di-update!');
    }

    public function delete($id = null)
    {
        $this->productModel->delete($id);
        return redirect('admin/master_product')->with('success', 'Produk berhasil dihapus!');
    }

    public function purchased_product()
    {
        $db = \Config\Database::connect();
        $data = $this->staticData->get_static_data(' | Purchased Products');
        $data['purchased_products'] = $db->table('purchased_products')
            ->join('products', 'products.product_id = purchased_products.product_id')
            ->join('suppliers', 'suppliers.supplier_id = purchased_products.supplier_id')
            ->orderBy('purchased_products.created_at', 'desc')
            ->get()
            ->getResult('array');
        return view('purchased_product/purchased_product', $data);
    }

    public function add_purchased_product()
    {
        $data = $this->staticData->get_static_data(' | Add Purchased Products');
        $data['products'] = $this->productModel->findAll();
        $data['suppliers'] = $this->supplierModel->findAll();
        return view('purchased_product/add_purchased_product', $data);
    }

    public function save_purchased_product()
    {
        $new_data = array(
            'purchased_product_id' => string_generator(),
            'product_id' => $this->request->getPost('product_id'),
            'qty' => $this->request->getPost('qty'),
            'supplier_id' => $this->request->getPost('supplier_id')
        );
        $current_product_qty = (int) $this->productModel->where('product_id', $new_data['product_id'])->first()['product_qty'];

        $db = \Config\Database::connect();
        $builder = $db->table('purchased_products');

        $builder->insert($new_data);

        $this->productModel->update($new_data['product_id'], array(
            'product_qty' => $current_product_qty + (int) $new_data['qty']
        ));

        return redirect('admin/purchased_product')->with('success', 'Data berhasil ditambahkan ke database!');
    }

    public function export_purchased_product()
    {
        $data = $this->staticData->get_static_data('Export Purchased Products');
        $db = \Config\Database::connect()->table('purchased_products');
        $data['purchased_products'] = $db
            ->select('purchased_products.*, products.product_name, suppliers.supplier_name')
            ->join('products', 'products.product_id = purchased_products.product_id')
            ->join('suppliers', 'suppliers.supplier_id = purchased_products.supplier_id')
            ->get()
            ->getResultArray();
        return view('purchased_product/export', $data);
    }

    public function export()
    {
        $data = $this->staticData->get_static_data('Export Data Product');
        $data['products'] = $this->productModel->findAll();
        return view('product/export', $data);
    }
}
