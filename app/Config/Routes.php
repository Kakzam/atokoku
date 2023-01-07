<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('login', 'Home::index');
$routes->post('login', 'Api::validationUser');
$routes->get('logout', 'Api::logout');

$routes->get('dashboard', 'Home::dashboard');
$routes->post('tambah_notif', 'Api::addNotification');
$routes->get('notif', 'Home::notifikasi');

$routes->post('transaksi_barang', 'Home::transaksi_barang');
$routes->get('transaksi_barang', 'Home::transaksi_barang');
$routes->post('delete_transaksi_barang', 'Api::deleteTransactionBarang');
$routes->post('updateTransactionBarang', 'Api::updateTransactionBarang');

$routes->get('transaksi', 'Home::transaksi');
$routes->post('tambah_transaksi', 'Api::addTransaction');
$routes->post('update_transaksi', 'Api::updateTransaction');


$routes->get('barang', 'Home::barang');
$routes->post('barang', 'Home::barang');
$routes->post('tambah_barang', 'Api::addItem');
$routes->post('delete_barang/(:numb)', 'Api::deleteItem/$1');


$routes->get('user', 'Home::user');
$routes->post('user', 'Home::user');
$routes->post('delete', 'Api::deleteUser');
$routes->get('update/(:numb)', 'Api::updateUser/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
