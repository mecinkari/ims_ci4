<?php

namespace App\Database\Seeds;

use App\Database\Migrations\Fields;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        //
        $tbl = new Fields('users');
        $data = array(
            array(
                'user_id' => $tbl->generateString(12),
                'user_name' => 'mecinkari',
                'user_pass' => password_hash('12345678', PASSWORD_DEFAULT),
                'role_id' => 1,
            ),
            array(
                'user_id' => $tbl->generateString(12),
                'user_name' => 'admin',
                'user_pass' => password_hash('12345678', PASSWORD_DEFAULT),
                'role_id' => 3,
            ),
            array(
                'user_id' => $tbl->generateString(12),
                'user_name' => 'employee',
                'user_pass' => password_hash('12345678', PASSWORD_DEFAULT),
                'role_id' => 4,
            ),
            array(
                'user_id' => $tbl->generateString(12),
                'user_name' => 'customer1',
                'user_pass' => password_hash('12345678', PASSWORD_DEFAULT),
                'role_id' => 5,
            ),
        );

        $this->db->table($tbl->get_tbl_name())->insertBatch($data);
    }
}
