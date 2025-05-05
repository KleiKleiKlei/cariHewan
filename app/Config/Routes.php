<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Auth::register');
$routes->post('/auth/saveRegister', 'Auth::saveRegister');
$routes->get('/login', 'Auth::login'); // Only one login route here
$routes->post('auth/processLogin', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('/laporan', 'Laporan::index');
$routes->get('/laporan/buat', 'Laporan::buat');
$routes->get('laporan/success', 'Laporan::success');
$routes->get('/laporan/ditemukan', 'Laporan::ditemukan');
$routes->post('/laporan/simpanDitemukan', 'Laporan::simpanDitemukan');
$routes->post('laporan/saveDitemukan', 'Laporan::saveDitemukan');
$routes->get('/daftar_hewan/hilang/(:num)?', 'DaftarHewan::hilang/$1');
$routes->get('/daftar_hewan/mencariPemilik/(:num)?', 'DaftarHewan::mencariPemilik/$1');
$routes->get('/daftar_hewan/ditemukan/(:num)?', 'DaftarHewan::ditemukan/$1');
$routes->get('/profil', 'User::profil');
$routes->get('/help', 'Help::index');
$routes->get('/dbtest', 'DbTest::index');

// Daftar Hewan routes
$routes->get('daftar_hewan/hilang', 'DaftarHewan::hilang');
$routes->get('daftar_hewan/mencariPemilik', 'DaftarHewan::mencariPemilik');  // Add this line
$routes->get('daftar_hewan/ditemukan', 'DaftarHewan::ditemukan');

$routes->get('/daftar_hewan/hilang', 'DaftarHewan::hilang');
$routes->get('/laporan/saveRegister', 'Laporan::saveRegister');
$routes->get('/laporan/lost', 'Laporan::lost');
$routes->post('/laporan/saveLost', 'Laporan::saveLost');
$routes->get('/map-test', 'MapTest::index');
$routes->get('/map-test', 'MapTest::index');
$routes->get('laporan/riwayat', 'Laporan::riwayat');
$routes->get('laporan/delete/(:num)', 'Laporan::delete/$1');
$routes->get('/help', 'Pages::help');

// Admin routes
$routes->get('supersecret', 'Admin::login');
$routes->post('supersecret/verify', 'Admin::verify');
$routes->get('supersecret/dashboard', 'Admin::dashboard');
$routes->get('supersecret/approve/(:num)', 'Admin::approve/$1');
$routes->get('supersecret/reject/(:num)', 'Admin::reject/$1');
$routes->get('supersecret/logout', 'Admin::logout');
$routes->post('admin/updateReportStatus/(:num)', 'Admin::updateReportStatus/$1');





