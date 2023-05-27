<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdersTable extends Migration
{
    public function up()
    {
        //
        $tbl = new Fields('orders');
        $db = db_connect();
        $db->disableForeignKeyChecks();

        $this->forge->addField([
            'order_id' => $tbl->field('VARCHAR', 128),
            'user_id' => $tbl->field('VARCHAR', 128),
            'order_status' => $tbl->field('INT', 1),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP'),
        ]);
        $this->forge->addPrimaryKey('order_id', 'pk_order');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->createTable($tbl->get_tbl_name());

        $db->enableForeignKeyChecks();
    }

    public function down()
    {
        //
        $tbl = new Fields('orders');
        $this->forge->dropTable($tbl->get_tbl_name(), true);
    }
}
