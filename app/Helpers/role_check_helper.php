<?php

if (!function_exists('role_check')) {
  function role_check($user_role = null, $given_role = [])
  {
    if (!in_array($user_role, $given_role)) {
      return redirect()->back();
    }
  }
}
