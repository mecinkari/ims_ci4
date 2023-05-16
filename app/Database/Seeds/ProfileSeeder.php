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
            [
                'profile_id' => 'UhxlR3MxRYWe',
                'user_id' => 'UhxlR3MxRYWe',
                'full_name' => 'Karyawan Karyawan',
                'no_hp' => '087166745162',
                'email' => 'employee@gmail.com',
                'address_1' => 'Depok',
                'address_2' => 'Jakarta',
            ],
            [
                'profile_id' => 'qzOiIw0leykF',
                'user_id' => 'qzOiIw0leykF',
                'full_name' => 'Admin Admin',
                'no_hp' => '087166712267',
                'email' => 'admin@gmail.com',
                'address_1' => 'Depok',
                'address_2' => 'Bogor',
            ],
            [
                'profile_id' => 'AmILJmtViTPW',
                'user_id' => 'AmILJmtViTPW',
                'full_name' => 'Customer Customer',
                'no_hp' => '087166741267',
                'email' => 'customer@gmail.com',
                'address_1' => 'Depok',
                'address_2' => 'Bogor',
            ]
        ];
        $this->db->table('profiles')->insertBatch($data);
    }
}
