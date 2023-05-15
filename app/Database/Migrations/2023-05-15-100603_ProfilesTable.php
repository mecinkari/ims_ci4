<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfilesTable extends Migration
{
    public function up()
    {
        //
        $tbl = new Fields('profiles');
        $db = db_connect();
        $db->disableForeignKeyChecks();

        $this->forge->addField([
            'profile_id' => $tbl->field('BIGINT', 12, true, true),
            'user_id' => $tbl->field('VARCHAR', 128),
            'full_name' => $tbl->field('VARCHAR', '255'),
            'no_hp' => $tbl->field('VARCHAR', 128),
            'email' => $tbl->field('VARCHAR', 128),
            'address_1' => $tbl->field('VARCHAR', 255),
            'address_2' => $tbl->field('VARCHAR', 255),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP'),
        ]);
        $this->forge->addPrimaryKey('profile_id', 'pk_profile');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', '', '', 'fk_user');
        $this->forge->createTable($tbl->get_tbl_name());

        $db->enableForeignKeyChecks();
    }

    public function down()
    {
        //
        $tbl = new Fields('profiles');
        $this->forge->dropTable($tbl->get_tbl_name(), true);
    }
}
