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

function textToSlug($text = '')
{
  $text = trim($text);
  if (empty($text)) return '';
  $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
  $text = strtolower(trim($text));
  $text = str_replace(' ', '-', $text);
  $text = $text_ori = preg_replace('/\-{2,}/', '-', $text);
  return $text;
}

function number_generator($length = 12)
{
  $characters = '0123456789';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[random_int(0, $charactersLength - 1)];
  }
  return $randomString;
}
