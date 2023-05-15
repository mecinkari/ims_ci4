<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        //
        $db = db_connect();
        $data = [
            [
                'role_id' => 1,
                'role_name' => 'programmer',
                'role_desc' => 'programmer'
            ],
            [
                'role_id' => 2,
                'role_name' => 'owner',
                'role_desc' => 'owner'
            ],
            [
                'role_id' => 3,
                'role_name' => 'admin',
                'role_desc' => 'admin'
            ],
            [
                'role_id' => 4,
                'role_name' => 'employee',
                'role_desc' => 'employee'
            ],
            [
                'role_id' => 5,
                'role_name' => 'customer',
                'role_desc' => 'customer'

            ]
        ];
        $db->table('roles')->insertBatch($data);
    }
}
