<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');

$routes->group('auth', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::attemptLogin');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::attemptRegister');
});

$routes->get('auth/logout', 'Auth::logout');

$routes->get('books', 'Books::index');
$routes->get('books/(:num)', 'Books::show/$1');

$routes->group('books', ['filter' => 'auth'], function ($routes) {
    $routes->get('borrow/(:num)', 'Books::borrow/$1');
    $routes->get('purchase/(:num)', 'Books::purchase/$1');
    $routes->get('my-borrows', 'Books::myBorrows');
    $routes->get('my-purchases', 'Books::myPurchases');
});

$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    
    $routes->get('books', 'Admin::books');
    $routes->get('books/add', 'Admin::addBook');
    $routes->post('books/store', 'Admin::storeBook');
    $routes->get('books/edit/(:num)', 'Admin::editBook/$1');
    $routes->post('books/update/(:num)', 'Admin::updateBook/$1');
    $routes->get('books/delete/(:num)', 'Admin::deleteBook/$1');
    
    $routes->get('borrow-requests', 'Admin::borrowRequests');
    $routes->post('borrow-requests/update/(:num)', 'Admin::updateBorrowStatus/$1');
    
    $routes->get('purchases', 'Admin::purchases');
    $routes->post('purchases/update/(:num)', 'Admin::updatePurchaseStatus/$1');
    
    $routes->get('users', 'Admin::users');
});
