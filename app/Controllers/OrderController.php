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
        $data['title'] = $this->title . '|My Orders';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['orders'] = $this->orderModel->where('user_id', session()->get('user_id'))->findAll();

        return view('new_order/index', $data);
    }

    public function make()
    {
        $order_id = string_generator(20);
        session()->set('order_id', $order_id);
        return redirect()->to('order/create');
    }

    public function save_order()
    {
        session()->remove('order_id');
        return redirect()->to('order')->with('success', 'Data order telah disimpan!');
    }

    public function create()
    {
        if (!session()->has('order_id')) {
            return redirect()->to('order');
        }

        $data['title'] = $this->title . '|Create Order';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['categories'] = $this->categoryModel->findAll();

        return view('new_order/create', $data);
    }

    public function save()
    {
        $order_id = session()->get('order_id');
        $user_id = session()->get('user_id');

        if (empty($this->orderModel->find($order_id))) {
            $data['new_order'] = [
                'order_id' => $order_id,
                'user_id' => $user_id,
            ];

            $this->orderModel->insert($data['new_order']);
        }

        $product_id = $this->request->getPost('product_id');
        $product = $this->productModel->find($product_id);

        $data['new_order_details'] = [
            'order_detail_id' => string_generator(20),
            'qty' => $this->request->getPost('qty'),
            'discount' => 0,
            'total' => $this->request->getPost('total'),
            'order_id' => $order_id,
            'product_id' => $product_id,
        ];

        $this->orderDetailModel->insert($data['new_order_details']);
        $this->productModel->update($product_id, [
            'product_qty' => ((int) $product['product_qty'] - (int) $this->request->getPost('qty'))
        ]);
    }

    public function view_details($id = null)
    {
        $data['title'] = $this->title . '|View Order Details';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['order_id'] = $id;
        $data['order_details'] = $this->orderDetailModel->join('products', 'products.product_id = order_details.product_id')->where('order_id', $id)->findAll();
        $data['total'] = $this->orderDetailModel->selectSum('total', 'total')->where('order_id', $id)->first()['total'];

        return view('new_order/details', $data);
    }

    public function cancel_order($id = null)
    {
        $old_data = $this->orderDetailModel->where('order_id', $id)->find();
        foreach ($old_data as $key => $value) {
            $old_qty = (int) $value['qty'];
            $product = $this->productModel->where('product_id', $value['product_id'])->first();
            $return_qty = (int) $product['product_qty'] + $old_qty;

            $new_data = array(
                'product_qty' => $return_qty
            );

            $this->productModel->update($value['product_id'], $new_data);
        }

        $this->orderDetailModel->where('order_id', $id)->delete();
        $this->orderModel->delete($id);
        return redirect()->to('order')->with('success', 'Order dibatalkan!');
    }

    public function invoice($id)
    {
        $staticData = new StaticData();
        $data = $staticData->get_static_data('Invoice');
        $data['order_details'] = $this->orderDetailModel->join('products', 'products.product_id = order_details.product_id')->where('order_id', $id)->findAll();
        $data['total'] = $this->orderDetailModel->selectSum('total', 'total')->where('order_id', $id)->first()['total'];
        $data['order_id'] = $id;
        // dd($data['order_details']);
        return view('new_order/export', $data);
    }
}
