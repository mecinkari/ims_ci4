<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'profile_id' => 'dL4erzyyJbTy',
                'user_id' => 'dL4erzyyJbTy',
                'full_name' => 'Mecinkari Mecin',
                'no_hp' => '085781177061',
                'email' => 'mecinkari@gmail.com',
                'address_1' => 'Depok',
                'address_2' => 'Jakarta',
            ],
        ];
        $this->db->table('profiles')->insertBatch($data);
    }
}
