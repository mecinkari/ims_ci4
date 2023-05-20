<?php

use App\Models\User;

/**
 * This function supposed to be checking if the user is logged in or not
 */
function is_logged_in()
{
  if (!session()->get('user')) {
    return redirect()->to('auth/login');
    die;
  }
}

/**
 * This function supposed to be checking if the user have this permission 
 * to access the URI
 */
function role_check($user_id = null, $given_role = [])
{
  $user = new User();
  $user_role = $user->find($user_id);
  if (!in_array($user_role['role_id'], $given_role)) {
    return redirect()->to('forbidden');
  }
}
