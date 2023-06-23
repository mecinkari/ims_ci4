<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends BaseController
{
    private $title = 'IMS';

    private $userModel, $orderModel, $orderDetailModel, $transactionModel, $productModel;
    private $userID;

    public function __construct()
    {
        $this->userModel = new User();
        $this->orderModel = new Order();
        $this->orderDetailModel = new OrderDetail();
        $this->productModel = new Product();
        $this->transactionModel = new Transaction();
        if (session()->has('user_id')) {
            $this->userID = session()->get('user_id');
        }
    }

    public function index()
    {
        //
        $data['title'] = $this->title . '|My Transaction';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);

        $data['orders'] = $this->orderModel
            ->select('orders.order_id')
            ->selectSum('total', 'grand_total')
            ->join('order_details', 'orders.order_id = order_details.order_id')
            ->where('order_status', 0)
            ->groupBy('orders.order_id')
            ->findAll();

        // $data['orders'] = $this->orderModel
        //     ->findAll();
        // dd($data['orders']);

        return view('transaction/index', $data);
    }

    public function check_out($id)
    {
        $data['title'] = $this->title . '|Check Out';
        $data['appname'] = $this->title;
        $data['user'] = $this->userModel->find($this->userID);
        $data['transaction_id'] = $id;
        $data['order_details'] = $this->orderDetailModel->join('products', 'products.product_id = order_details.product_id')->where('order_id', $id)->findAll();
        $data['total'] = $this->orderDetailModel->selectSum('total', 'total')->where('order_id', $id)->first()['total'];
        // echo $id;
        return view('transaction/check_out', $data);
    }

    public function check_out_now($id)
    {
        $data['dump'] = $this->orderDetailModel->where('order_id', $id)->findAll();
        foreach ($data['dump'] as $d) {
            $product_id = $d['product_id'];
            $product = $this->productModel->where('product_id', $product_id)->find();
            foreach ($product as $p) {
                print_r($p['product_qty'] . "-" . $d['qty'] . "=" . ((int)$p['product_qty'] - (int)$d['qty']));
                // $this->productModel->update($product_id, [
                //     'product_qty' => ((int) $p['product_qty'] - (int)$d['qty'])
                // ]);
            }
        }
    }
}
