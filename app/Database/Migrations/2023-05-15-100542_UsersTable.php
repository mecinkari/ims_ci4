<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTable extends Migration
{
    public function up()
    {
        //
        $tbl = new Fields('users');
        $db = db_connect();
        $db->disableForeignKeyChecks();

        $this->forge->addField([
            'user_id' => $tbl->field('VARCHAR', 128),
            'user_name' => $tbl->field('VARCHAR', 128),
            'user_pass' => $tbl->field('VARCHAR', 128),
            'role_id' => $tbl->field('INT', 3, true),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP'),
        ]);
        $this->forge->addPrimaryKey('user_id', 'pk_user');
        $this->forge->addForeignKey('role_id', 'roles', 'role_id', '', '', 'fk_role');
        $this->forge->createTable($tbl->get_tbl_name());

        $db->enableForeignKeyChecks();
    }

    public function down()
    {
        //
        $tbl = new Fields('users');
        $this->forge->dropTable($tbl->get_tbl_name());
    }
}
