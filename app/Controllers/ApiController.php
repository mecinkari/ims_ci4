<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class ApiController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function get_all_products()
    {
        $data['products'] = $this->productModel->where('product_qty !=', '0')->findAll();
        return json_encode($data['products']);
    }

    public function get_product_detail($id = null)
    {
        $data['product'] = $this->productModel->find($id);
        if ($id != 0) {
            return json_encode($data['product']);
        }
    }
}
