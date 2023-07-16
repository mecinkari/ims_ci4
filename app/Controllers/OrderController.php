<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;

class OrderController extends BaseController
{
    private $title = 'IMS';

    private $userModel, $orderModel, $productModel, $categoryModel, $orderDetailModel, $profileModel;
    private $userID;

    public function __construct()
    {
        $this->userModel = new User();
        $this->orderModel = new Order();
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->orderDetailModel = new OrderDetail();
        $this->profileModel = new Profile();

        if (session()->has('user_id')) {
            $this->userID = session()->get('user_id');
        }
    }

    public function index()
    {
        $staticData = new StaticData();
        $data = $staticData->get_static_data('My Orders');
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

        $staticData = new StaticData();
        $data = $staticData->get_static_data('Create Order');
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
        $staticData = new StaticData();
        $data = $staticData->get_static_data('View Order Details');
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
        $order = $this->orderModel->where('order_id', $id)->first();
        $user = $this->profileModel->where('user_id', $order['user_id'])->first();
        $title = 'Invoice ' . $id . ' - ' . $user['full_name'];
        $data = $staticData->get_static_data($title);
        $data['order_details'] = $this->orderDetailModel->join('products', 'products.product_id = order_details.product_id')->where('order_id', $id)->findAll();
        $data['total'] = $this->orderDetailModel->selectSum('total', 'total')->where('order_id', $id)->first()['total'];
        $data['order_id'] = $id;
        return view('new_order/export', $data);
    }
}
