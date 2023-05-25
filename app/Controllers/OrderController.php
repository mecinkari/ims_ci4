<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;

class OrderController extends BaseController
{
    private $title = 'IMS';

    private $userModel, $orderModel, $productModel, $categoryModel, $orderDetailModel;
    private $userID;

    public function __construct()
    {
        $this->userModel = new User();
        $this->orderModel = new Order();
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->orderDetailModel = new OrderDetail();
        if (session()->has('user_id')) {
            $this->userID = session()->get('user_id');
        }
    }

    public function index()
    {
        //
        if (session()->get('order_id')) {
            return redirect()->to('order/create')->with('error', 'Silahkan selesaikan dulu order anda.');
        }
        $data['title'] = $this->title . '|Orders';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['allOrders'] = $this->orderModel->findAll();

        return view('order/index', $data);
    }

    public function make()
    {
        $order_id = string_generator(30);
        $user_id = $this->userID;

        $data = [
            'order_id' => $order_id,
            'user_id' => $user_id
        ];

        $this->orderModel->insert($data);
        session()->set('order_id', $order_id);
        return redirect()->to('order/create')->with('success', 'Berhasil membuat sebuah order');
    }

    public function create()
    {
        $data['title'] = $this->title . '|Buat Order';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['allProducts'] = $this->productModel->findAll();
        $data['allCategories'] = $this->categoryModel->findAll();

        return view('order/create', $data);
    }

    public function cancel()
    {
        $order_id = session()->get('order_id');
        session()->remove('order_id');
        $this->orderModel->delete($order_id);
        return redirect()->to('order')->with('success', 'Order berhasil dibatalkan');
    }

    public function cancel_temp()
    {
        session()->remove('order_id');
        return redirect()->to('order')->with('success', 'Order berhasil dibatalkan');
    }

    public function save()
    {
        $db = \Config\Database::connect();

        $product_id = $this->request->getPost('product_id');
        $qty = $this->request->getPost('qty');
        $total = $this->request->getPost('total');

        for ($i = 0; $i < count($product_id); $i++) {
            $data = [
                'order_detail_id' => string_generator(20),
                'qty' => $qty[$i],
                'total' => $total[$i],
                'order_id' => session()->get('order_id'),
                'product_id' => $product_id[$i],
            ];
            $db->table('order_details')->insert($data);
        }
        session()->remove('order_id');
        return redirect()->to('order')->with('success', 'Order berhasil ditambahkan');
    }

    public function view($id = null)
    {
        $data['title'] = $this->title . '|Lihat Order';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['order_details'] = $this->orderDetailModel->join('products', 'products.product_id = order_details.product_id')->findAll();
        // dd($data['order_detail']);

        return view('order/view', $data);
    }

    public function delete($id = null)
    {
        $this->orderModel->delete($id);
        return redirect()->to('order')->with('success', 'Order berhasil dibatalkan');
    }

    public function getAllStock()
    {
        // $id = $this->request->getPost('product_id');
        $stock = $this->productModel->findAll();
        return json_encode($stock);
    }

    public function get_stock()
    {
        $id = $this->request->getPost('product_id');
        $stock = $this->productModel->find($id);
        $data = [
            'stock' => $stock['product_qty'],
            'price' => $stock['product_price']
        ];
        return json_encode($data);
    }
}
