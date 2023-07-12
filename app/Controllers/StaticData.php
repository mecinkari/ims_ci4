<?php

namespace App\Controllers;

use App\Models\User;

class StaticData
{
  private $title = 'IMS';

  private $userModel, $userID;

  public function __construct()
  {
    $this->userModel = new User();
    if (session()->has('user_id')) {
      $this->userID = session()->get('user_id');
    }
  }

  public function get_static_data($title)
  {
    return array(
      'title' => $this->title . '|' . $title,
      'appname' => $this->title,
      'user' => $this->userModel->find($this->userID)
    );
  }
}
