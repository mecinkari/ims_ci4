<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestController extends BaseController
{
    public function index()
    {
        //
        return view('test/index');
    }

    public function new()
    {
        //
        $db = \Config\Database::connect();
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');

        for ($i = 0; $i < count($firstname); $i++) {
            $data = [
                'firstname' => $firstname[$i],
                'lastname' => $lastname[$i],
            ];

            $db->table('test')->insert($data);
        }

        print_r($data);
    }
}
