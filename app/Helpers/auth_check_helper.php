<?php

if (!function_exists('auth_check')) {
  function auth_check()
  {
    if (!session()->get('user')) {
      session()->setFlashdata('error', 'Anda belum login');
      return redirect('auth/login');
    }
  }
}
