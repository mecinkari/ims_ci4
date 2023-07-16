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

    public function master_transaction()
    {
        $data['transactions'] = $this->transactionModel->join('profiles', 'profiles.user_id = transactions.user_id')->select(
            'transactions.transaction_id, transactions.order_id, transactions.user_id, transactions.grand_total, transactions.status, transactions.created_at, ' .
                'profiles.full_name, profiles.no_hp, profiles.email'
        )->findAll();
        dd($data['transactions']);
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
            ->where('user_id', session()->get('user_id'))
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
                $this->productModel->update($product_id, [
                    'product_qty' => ((int) $p['product_qty'] - (int)$d['qty'])
                ]);

                $new_data = array(
                    'transaction_id' => string_generator(),
                    'order_id' => $id,
                    'user_id' => session()->get('user_id'),
                    'grand_total' => $this->orderDetailModel->selectSum('total', 'total')->where('order_id', $id)->first()['total'],
                    'status' => 1
                );

                $this->orderModel->update($id, [
                    'order_status' => 1
                ]);

                $this->transactionModel->insert($new_data);

                return redirect()->to('home')->with('success', 'Berhasil melakukan transaksi!');
            }
        }
    }
}
