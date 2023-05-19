<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('auth', function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::check_login');
    $routes->get('register', 'AuthController::register');
    $routes->get('logout', 'AuthController::logout');
});

$routes->group('profile', function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->post('update', 'ProfileController::update');
});

$routes->group('admin', function ($routes) {
    $routes->get('master_user', 'AdminController::master_user');
    $routes->get('create_user', 'AdminController::create_user');
    $routes->get('edit_user/(:any)', 'AdminController::edit_user/$1');
    $routes->get('delete_user/(:any)', 'AdminController::delete_user/$1');
    $routes->post('create_user', 'AdminController::save_user');
});

$routes->get('/dashboard', 'HomeController::index');
$routes->group('user', function ($routes) {
    $routes->get('/', 'HomeController::user');
    $routes->get('change_username', 'HomeController::change_username');
    $routes->get('change_password', 'HomeController::change_password');
    $routes->post('change_username', 'HomeController::update_username');
    $routes->post('change_password', 'HomeController::update_password');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
