<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolesTable extends Migration
{
    public function up()
    {
        //
        $tbl = new Fields('roles');
        $this->forge->addField([
            'role_id' => $tbl->field('INT', 3, true, true),
            'role_name' => $tbl->field('VARCHAR', 128),
            'role_desc' => $tbl->field('VARCHAR', 255),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP')
        ]);
        $this->forge->addPrimaryKey('role_id');
        $this->forge->createTable($tbl->get_tbl_name());
    }

    public function down()
    {
        //
        $tbl = new Fields('roles');
        $this->forge->dropTable($tbl->get_tbl_name());
    }
}
