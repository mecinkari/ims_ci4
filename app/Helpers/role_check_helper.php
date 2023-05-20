<?php

use App\Models\User;

function role_check($user_id = null, $given_role = [])
{
  $user = new User();
  $user_role = $user->find($user_id);
  if (in_array($user_role['role_id'], $given_role)) {
    return redirect()->to('forbidden');
  }
}
