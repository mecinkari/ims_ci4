<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoriesTable extends Migration
{
    public function up()
    {
        //
        $tbl = new Fields('categories');
        $suffix = 'category';

        $this->forge->addField([
            $suffix . '_id' => $tbl->field('INT', 11, true, true),
            $suffix . '_name' => $tbl->field('VARCHAR', 128),
            $suffix . '_desc' => $tbl->field('VARCHAR', 255),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP'),
        ]);
        $this->forge->addPrimaryKey($suffix . '_id', 'pk_' . $suffix);
        $this->forge->createTable($tbl->get_tbl_name());
    }

    public function down()
    {
        //
        $tbl = new Fields('categories');
        $this->forge->dropTable($tbl->get_tbl_name(), true);
    }
}
