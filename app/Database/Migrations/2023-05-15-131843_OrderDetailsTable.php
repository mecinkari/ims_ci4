<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderDetailsTable extends Migration
{
    public function up()
    {
        //
        $tbl = new Fields('order_details');
        $db = db_connect();
        $db->disableForeignKeyChecks();
        $this->forge->addField([
            'order_detail_id' => $tbl->field('VARCHAR', 128),
            'qty' => $tbl->field('INT', 12),
            'discount' => $tbl->field('INT', 12),
            'total' => $tbl->field('INT', 12),
            'order_id' => $tbl->field('VARCHAR', 128),
            'product_id' => $tbl->field('VARCHAR', 128),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP'),
        ]);
        $this->forge->addPrimaryKey('order_detail_id');
        $this->forge->addForeignKey('order_id', 'orders', 'order_id');
        $this->forge->addForeignKey('product_id', 'products', 'product_id');
        $this->forge->createTable($tbl->get_tbl_name());
        $db->enableForeignKeyChecks();
    }

    public function down()
    {
        //
        $tbl = new Fields('order_details');
        $this->forge->dropTable($tbl->get_tbl_name(), true);
    }
}
