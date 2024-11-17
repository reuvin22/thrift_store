<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/grantAccess', 'Home::grantAccess');
// $routes->get('/grantAccess', 'Home::grantAccess');
$routes->get('/', 'Home::index');
$routes->get('/items-view', 'Home::items');
$routes->get('/products-view', 'Home::products');
$routes->get('/about', 'Home::about');
$routes->get('/user-registration', 'Home::registration');
$routes->get('/orders', 'Orders::index');
// $routes->get('/items-view', 'Home::items');
// $routes->get('/buyers-view', 'Home::buyers');

$routes->post('/user-registration', 'userRegistration::store');
//Auth
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
//Users
$routes->post('/user', 'FormController::store');
$routes->get('/users-data', 'FormController::index');
$routes->get('/buyers-data/(:num)', 'BuyersController::show/$1');

//Employees
$routes->post('/employees/create', 'EmployeeController::store');
$routes->get('/employees', 'EmployeeController::index');
$routes->get('/employees/delete/(:num)', 'EmployeeController::delete/$1');
$routes->post('/employees/update/(:num)', 'EmployeeController::update/$1');


$routes->get('/buyers-data/(:num)', 'BuyersController::show/$1');
$routes->put('/buyers/(:num)', 'BuyersController::put/$1');
$routes->delete('/buyers/(:num)', 'BuyersController::delete/$1');

//Items
$routes->post('/items/store', 'ItemsController::store');
$routes->get('/items', 'ItemsController::index');
$routes->get('/items/delete/(:num)', 'ItemsController::delete/$1');
$routes->post('/items/update/(:num)', 'ItemsController::update/$1');

//Buyers
$routes->post('/buyers', 'BuyersController::store');
$routes->get('/buyers-data', 'BuyersController::index');
$routes->get('/buyers-data/(:num)', 'BuyersController::show/$1');

//product view
$routes->get('/products', 'ProductController::index');

//order
$routes->post('/user-items/create', 'UserItem::store');

$routes->get('/all-items', 'UserItem::index');
$routes->delete('/delete-item', 'UserItem::delete');

$routes->get('/orders/index', 'Orders::index');
$routes->post('/orders/update/(:num)', 'UserItem::update/$1');
$routes->delete('/orders/delete/(:num)', 'UserItem::delete/$1');