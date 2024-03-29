<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(false);
$routes->set404Override();

$routes->get('/', 'Home::index');

$routes->group('auth', function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::check_login');
    $routes->get('register', 'AuthController::register');
    $routes->get('logout', 'AuthController::logout');
});

$routes->group('profile', ['filter' => 'auth-checker'], function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->post('update', 'ProfileController::update');
});

$routes->group('admin', ['filter' => ['auth-checker', 'role-checker:1,2']], function ($routes) {
    // Create, Read, Update, Delete done
    $routes->get('master_user', 'AdminController::master_user');
    $routes->get('create_user', 'AdminController::create_user');
    $routes->post('create_user', 'AdminController::save_user');
    $routes->get('edit_user/(:any)', 'AdminController::edit_user/$1');
    $routes->post('edit_user/(:any)', 'AdminController::update_user/$1');
    $routes->get('delete_user/(:any)', 'AdminController::delete_user/$1');

    // Create, Read, Update, Delete done
    $routes->get('master_category', 'CategoryController::index');
    $routes->get('create_category', 'CategoryController::create');
    $routes->post('create_category', 'CategoryController::save');
    $routes->get('edit_category/(:any)', 'CategoryController::edit/$1');
    $routes->post('edit_category/(:any)', 'CategoryController::update/$1');
    $routes->get('delete_category/(:any)', 'CategoryController::delete/$1');
    $routes->get('export_category', 'CategoryController::export');

    // Create, Read Update, Delete done
    $routes->get('master_supplier', 'SupplierController::index');
    $routes->get('create_supplier', 'SupplierController::create');
    $routes->post('create_supplier', 'SupplierController::save');
    $routes->get('edit_supplier/(:any)', 'SupplierController::edit/$1');
    $routes->post('edit_supplier/(:any)', 'SupplierController::update/$1');
    $routes->get('delete_supplier/(:any)', 'SupplierController::delete/$1');
    $routes->get('export_supplier', 'SupplierController::export');

    // Create, Read Update, Delete done
    $routes->get('master_product', 'ProductController::index');
    $routes->get('create_product', 'ProductController::create');
    $routes->post('create_product', 'ProductController::save');
    $routes->get('edit_product/(:any)', 'ProductController::edit/$1');
    $routes->post('edit_product/(:any)', 'ProductController::update/$1');
    $routes->get('delete_product/(:any)', 'ProductController::delete/$1');
    $routes->get('export_product', 'ProductController::export');

    //master orders
    $routes->get('master_orders', 'AdminController::master_orders');
    $routes->get('update_status_order/(:any)', 'AdminController::edit_status_order/$1');
    $routes->post('update_status_order/(:any)', 'AdminController::update_status_order/$1');

    // produk dibeli
    $routes->get('purchased_product', 'ProductController::purchased_product', ['filter' => ['auth-checker', 'role-checker:1,2']]);
    $routes->get('add_purchased_product', 'ProductController::add_purchased_product', ['filter' => ['auth-checker', 'role-checker:1,2']]);
    $routes->post('add_purchased_product', 'ProductController::save_purchased_product', ['filter' => ['auth-checker', 'role-checker:1,2']]);
    $routes->get('export_purchased_product', 'ProductController::export_purchased_product', ['filter' => ['auth-checker', 'role-checker:1,2']]);
});

$routes->group('user', ['filter' => 'auth-checker'], function ($routes) {
    $routes->get('/', 'HomeController::user');
    $routes->get('change_username', 'HomeController::change_username');
    $routes->get('change_password', 'HomeController::change_password');
    $routes->post('change_username', 'HomeController::update_username');
    $routes->post('change_password', 'HomeController::update_password');
});

$routes->get('/dashboard', 'AdminController::index', ['filter' => ['auth-checker', 'role-checker:1,2']]);
$routes->get('/home', 'HomeController::index', ['filter' => ['auth-checker', 'role-checker:3']]);
$routes->get('/forbidden', 'AuthController::forbidden');

$routes->group('api', ['filter' => 'auth-checker'], function ($routes) {
    $routes->get('get_all_products', 'ApiController::get_all_products');
    $routes->get('get_product_detail/(:any)', 'ApiController::get_product_detail/$1');
});

$routes->group('order', ['filter' => ['auth-checker', 'role-checker:1,2,3']], function ($routes) {
    $routes->get('', 'OrderController::index');
    $routes->get('create', 'OrderController::create');
    $routes->get('make', 'OrderController::make');
    $routes->post('save', 'OrderController::save');
    $routes->get('save_order', 'OrderController::save_order');
    $routes->get('cancel_order/(:any)', 'OrderController::cancel_order/$1');
    $routes->get('view_details/(:any)', 'OrderController::view_details/$1');
    $routes->get('invoice/(:any)', 'OrderController::invoice/$1');
});

$routes->group('transaction', ['filter' => ['auth-checker', 'role-checker:3']], function ($routes) {
    $routes->get('', 'TransactionController::index');
    $routes->get('check_out/(:any)', 'TransactionController::check_out/$1');
    $routes->get('check_out_now/(:any)', 'TransactionController::check_out_now/$1');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
