<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;

class Fields
{
  private $tbl_name = '';

  public function __construct($tbl_name = '')
  {
    $this->tbl_name = $tbl_name;
  }

  public function get_tbl_name()
  {
    return $this->tbl_name;
  }

  public function field($type, $constraint = 0, $unsigned = false, $auto_increment = false, $null = false)
  {
    if ($type == 'TIMESTAMP') {
      return [
        'type' => $type,
        'default' => new RawSql('CURRENT_TIMESTAMP')
      ];
    } else {
      return [
        'type' => $type,
        'constraint' => $constraint,
        'unsigned' => $unsigned,
        'auto_increment' => $auto_increment,
        'null' => $null
      ];
    }
  }

  public function generateString($n)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
    }

    return $randomString;
  }
}
