<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PurchasedProducts extends Migration
{
    public function up()
    {
        //
        $tbl = new Fields('purchased_products');
        $db = db_connect();
        $db->disableForeignKeyChecks();
        $this->forge->addField([
            'purchased_product_id' => $tbl->field('VARCHAR', 128),
            'product_id' => $tbl->field('VARCHAR', 128),
            'qty' => $tbl->field('INT', 11),
            'supplier_id' => $tbl->field('VARCHAR', 12),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP'),
        ]);
        $this->forge->addPrimaryKey('purchased_product_id', 'pk_purchased_product');
        $this->forge->addForeignKey('product_id', 'products', 'product_id');
        $this->forge->addForeignKey('supplier_id', 'suppliers', 'supplier_id');
        $this->forge->createTable($tbl->get_tbl_name());
    }

    public function down()
    {
        //
        $this->forge->dropTable('purchased_products');
    }
}
