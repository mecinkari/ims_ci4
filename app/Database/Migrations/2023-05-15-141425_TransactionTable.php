<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransactionTable extends Migration
{
    public function up()
    {
        //
        $tbl = new Fields('transactions');
        $db = db_connect();
        $db->disableForeignKeyChecks();

        $this->forge->addField([
            'transaction_id' => $tbl->field('VARCHAR', 128),
            'order_id' => $tbl->field('VARCHAR', 128),
            'user_id' => $tbl->field('VARCHAR', 128),
            'grand_total' => $tbl->field('INT', 12),
            'status' => $tbl->field('VARCHAR', 128),
            'created_at' => $tbl->field('TIMESTAMP'),
        ]);
        $this->forge->addPrimaryKey('transaction_id');
        $this->forge->addForeignKey('order_id', 'orders', 'order_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->createTable($tbl->get_tbl_name());
        $db->enableForeignKeyChecks();
    }

    public function down()
    {
        //
        $tbl = new Fields('transactions');
        $this->forge->dropTable($tbl->get_tbl_name(), true);
    }
}
