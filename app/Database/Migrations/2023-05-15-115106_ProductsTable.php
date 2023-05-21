<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsTable extends Migration
{
    private $tbl_name = 'products';

    public function up()
    {
        //
        $tbl = new Fields($this->tbl_name);
        $db = \Config\Database::connect();
        $db->disableForeignKeyChecks();

        $this->forge->addField([
            'product_id' => $tbl->field('VARCHAR', 128),
            'product_name' => $tbl->field('VARCHAR', 128),
            'product_desc' => $tbl->field('VARCHAR', 255),
            'product_price' => $tbl->field('BIGINT', 12),
            'product_qty' => $tbl->field('INT', 1),
            'product_price' => $tbl->field('INT', 11),
            'supplier_id' => $tbl->field('VARCHAR', 12),
            'category_id' => $tbl->field('INT', 11, true),
            'created_at' => $tbl->field('TIMESTAMP'),
            'updated_at' => $tbl->field('TIMESTAMP'),
        ]);
        $this->forge->addPrimaryKey('product_id', 'pk_product');
        $this->forge->addForeignKey('supplier_id', 'suppliers', 'supplier_id');
        $this->forge->addForeignKey('category_id', 'categories', 'category_id');
        $this->forge->createTable($tbl->get_tbl_name());

        $db->enableForeignKeyChecks();
    }

    public function down()
    {
        //
        $tbl = new Fields($this->tbl_name);
        $this->forge->dropTable($tbl->get_tbl_name(), true);
    }
}
