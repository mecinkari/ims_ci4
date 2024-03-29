<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

class AdminController extends BaseController
{
    private $title = 'IMS';

    private $userModel, $roleModel, $profileModel, $userID, $orderModel, $orderDetailModel, $productModel, $staticData;

    public function __construct()
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
        $this->orderModel = new Order();
        $this->orderDetailModel = new OrderDetail();
        $this->profileModel = new Profile();
        $this->productModel = new Product();
        $this->staticData = new StaticData();
        if (session()->has('user_id')) {
            $this->userID = session()->get('user_id');
        }
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->staticData->get_static_data('Dashboard');
        $data['total_pemasukkan'] = $this->orderDetailModel
            ->selectSum('order_details.total', 'total')
            ->join('orders', 'order_details.order_id = orders.order_id')
            ->where('orders.order_status > 1')
            ->like('orders.created_at', date("Y-m"), 'left')
            ->first();

        $data['total_barang_keluar'] = $this->orderDetailModel
            ->selectSum('order_details.qty', 'total')
            ->join('orders', 'order_details.order_id = orders.order_id')
            ->where('orders.order_status > 1')
            ->like('orders.created_at', date("Y-m"), 'left')
            ->first();

        $data['jumlah_produk'] = $this->productModel
            ->selectCount('product_id', 'total')
            ->first();

        $data['jumlah_customer'] = $this->userModel
            ->selectCount('user_id', 'total')
            ->where('role_id', '3')
            ->first();

        return view('admin/dashboard', $data);
    }

    public function master_user()
    {
        $db = \Config\Database::connect();
        $data = $this->staticData->get_static_data('Master User');
        $user = $this->userModel->where('user_id', session('user_id'))->first();

        $builder = $db->table('users');
        $builder->select('users.user_id, users.user_name, roles.role_name');
        $builder->join('roles', 'users.role_id = roles.role_id');
        $builder->where('users.user_id !=', $this->userID);
        if ($user['role_id'] == '1' || $user['role_id'] == '2') {
            $builder->where('users.role_id !=', 1);
        }
        $data['allUsers'] = $builder->get()->getResult();
        echo view('admin/master_user', $data);
    }

    public function create_user()
    {

        $data = $this->staticData->get_static_data('Create User');
        $data['roles'] = $this->roleModel->findAll();
        echo view("admin/create_user", $data);
    }

    public function save_user()
    {
        $data = $this->staticData->get_static_data('Create User');
        $data['roles'] = $this->roleModel->findAll();

        $validation_rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[6]|max_length[12]|is_unique[users.user_name]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
            ]
        ];

        if (!$this->validate($validation_rules)) {
            $data['validation'] = $this->validator;
            return view('admin/create_user', $data);
        }

        $new_userID = string_generator();

        $new_data_user = [
            'user_id' => $new_userID,
            'user_name' => $this->request->getPost('username'),
            'user_pass' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id' => $this->request->getPost('role_id'),
        ];

        $new_user_profile = [
            'user_id' => $new_userID,
            'full_name' => 'New User',
            'no_hp' => '',
            'email' => '',
            'address_1' => '',
            'address_2' => '',
        ];

        $this->userModel->insert($new_data_user);
        $this->profileModel->insert($new_user_profile);

        return redirect('admin/master_user')->with('success', 'Data user baru berhasil ditambahkan!');
    }

    public function edit_user($id = null)
    {
        role_check($this->userID, [1, 2, 3]);
        $user = $this->userModel->find($id);
        $data = $this->staticData->get_static_data('Edit User ' . $user['user_name']);
        $data['roles'] = $this->roleModel->findAll();
        $data['data_user'] = $user;
        echo view("admin/edit_user", $data);
    }

    public function update_user($id = null)
    {
        role_check($this->userID, [1, 2, 3]);
        $user = $this->userModel->find($id);
        $data = [
            'role_id' => $this->request->getPost('role_id')
        ];

        $this->userModel->update($id, $data);
        return redirect('admin/master_user')->with('success', 'User "' . $user['user_name'] . '" telah berhasil di-update!');
    }

    public function delete_user($id = null)
    {
        role_check($this->userID, [1, 2, 3]);
        $this->roleModel->where('user_id', $id)->delete();
        $this->userModel->delete($id);
        return redirect('admin/master_user')->with('success', 'User berhasil dihapus dari database!');
    }

    public function master_orders()
    {
        $data = $this->staticData->get_static_data('Master Orders');
        $data['all_orders'] = $this->orderModel
            ->select('orders.*, profiles.*')
            ->selectSum('order_details.total', 'total')
            ->join('profiles', 'profiles.user_id = orders.user_id')
            ->join('order_details', 'order_details.order_id = orders.order_id')
            ->groupBy('order_details.order_id')
            ->orderBy('orders.created_at', 'asc')
            ->findAll();
        $data['grand_total'] = $this->orderDetailModel
            ->selectSum('total', 'total')->first()['total'];
        return view('admin/master_orders', $data);
    }

    public function edit_status_order($order_id)
    {
        $data = $this->staticData->get_static_data('Update Status Order');
        $data['order'] = $this->orderModel->where('order_id', $order_id)->first();
        return view('admin/update_status_order', $data);
    }

    public function update_status_order($order_id)
    {
        $new_update_data = array(
            'order_status' => $this->request->getPost('order_status')
        );

        $this->orderModel->update($order_id, $new_update_data);

        return redirect('admin/master_orders')->with('success', 'Status Order "' . $order_id . '" telah berhasil di-update!');
    }
}
