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
//...

$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);
// Super Admin routes
$routes->group("sadmin", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "SadminController::index");
});
// Admin routes
$routes->group("admin", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "AdminController::index");
});
// Siswa routes
$routes->group("siswa", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "SiswaController::index");
});
// Super Admin routes
$routes->get('logout', 'UserController::logout');
$routes->get("studenttables", "SadminController::studenttables");
$routes->get("create", "SadminController::create");
$routes->post("save", "SadminController::save");
$routes->post("upload", "SadminController::upload");
$routes->get("siswaModel/delete/(:num)", "SadminController::delete/$1");
$routes->get('siswaModel/edit/(:num)', 'SadminController::edit/$1');
$routes->post('update/(:num)', 'SadminController::update/$1');

$routes->get("admintables", "SadminController::admintables");
$routes->get("createadmin", "SadminController::createadmin");
$routes->post("saveadmin", "SadminController::saveadmin");
$routes->get("adminModel/deleteadmin/(:num)", "SadminController::deleteadmin/$1");
$routes->get('adminModel/editadmin/(:num)', 'SadminController::editadmin/$1');
$routes->post('updateadmin/(:num)', 'SadminController::updateadmin/$1');

$routes->get("transaction", "SadminController::transaction");
$routes->get("createtagihan", "SadminController::createtagihan");
$routes->post('savetagihan', 'SadminController::savetagihan', ['as' => 'savetagihan']);
$routes->get('payment/(:num)', 'SadminController::payment/$1');
$routes->get('bayar/(:num)', 'SadminController::bayar/$1');
$routes->get('batal/(:num)', 'SadminController::batal/$1');

$routes->get("transactionhistory", "SadminController::transactionhistory");
$routes->get('riwayattransaksi', 'SadminController::riwayattransaksi');
$routes->get('riwayattransaksi2', 'SadminController::riwayattransaksi2');


$routes->get("profile", "SadminController::profile");


// Admin routes
$routes->get('logout', 'UserController::logout');
$routes->get("studenttables2", "AdminController::astudenttables2");
$routes->get("create2", "AdminController::create2");
$routes->get('siswaModel/edit2/(:num)', 'AdminController::edit2/$1');
$routes->post("save2", "AdminController::save2");
$routes->get("siswaModel/delete2/(:num)", "AdminController::delete2/$1");
$routes->post('update2/(:num)', 'AdminController::update2/$1');

$routes->get("transaction2", "AdminController::transaction2");
$routes->get("createtagihan2", "AdminController::createtagihan2");
$routes->post('savetagihan2', 'AdminController::savetagihan2', ['as' => 'savetagihan2']);
$routes->get('payment2/(:num)', 'AdminController::payment2/$1');
$routes->get('bayar2/(:num)', 'AdminController::bayar2/$1');
$routes->get('batal2/(:num)', 'AdminController::batal2/$1');

$routes->get("transactionhistory2", "adminController::transactionhistory2");
$routes->get('riwayattransaksi2', 'adminController::riwayattransaksi2');

$routes->get("profile2", "adminController::profile2");


//siswa routes
$routes->get('bayarspp/(:num)', 'SiswaController::bayarspp/$1');
$routes->get('paymentsiswa/(:num)', 'SiswaController::paymentsiswa/$1');
$routes->get('bayarspp/(:any)', 'SiswaController::bayarspp/$1');
$routes->post('callback', 'SiswaController::callback');
$routes->get('generate-pdf/(:num)', 'SiswaController::generatePdf/$1');
//...


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
