<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuppliersTable extends Migration
{
    public function up()
    {
        //
        $sup = 'supplier_';
        $tbl = new Fields('suppliers');

        $this->forge->addField([
            $sup . 'id' => $tbl->field('VARCHAR', 12),
            $sup . 'name' => $tbl->field('VARCHAR', 128),
            $sup . 'address' => $tbl->field('VARCHAR', 255),
            $sup . 'phone' => $tbl->field('VARCHAR', 128),
            $sup . 'email' => $tbl->field('VARCHAR', 128),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP'),
        ]);

        $this->forge->addPrimaryKey($sup . 'id', 'pk_supplier');
        $this->forge->createTable('suppliers');
    }

    public function down()
    {
        //
        $this->forge->dropTable('suppliers', true);
    }
}
