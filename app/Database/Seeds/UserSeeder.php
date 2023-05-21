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
            'user_id' => 'dL4erzyyJbTy',
            'user_name' => 'mecinkari',
            'user_pass' => password_hash('12345678', PASSWORD_DEFAULT),
            'role_id' => 1,
        );

        $this->db->table($tbl->get_tbl_name())->insertBatch($data);
    }
}
