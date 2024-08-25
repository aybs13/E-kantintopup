<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes untuk login dan otentikasi
$routes->get('/', 'Auth::login'); // Halaman login
$routes->post('/login', 'Auth::attemptLogin'); // Proses login
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'authGuard']); // Dashboard hanya dapat diakses jika user terotentikasi
$routes->get('/logout', 'Auth::logout'); // Logout

// Routes untuk admin menambah, mengedit, dan menghapus menu produk
$routes->get('/add-product', 'AdminController::addProduct'); // Halaman tambah produk
$routes->post('/save-product', 'AdminController::saveProduct'); // Simpan produk baru
$routes->get('/edit-product/(:num)', 'AdminController::editProduct/$1'); // Halaman edit produk
$routes->post('/update-product/(:num)', 'AdminController::updateProduct/$1'); // Simpan perubahan produk
$routes->get('/delete-product/(:num)', 'AdminController::deleteProduct/$1'); // Hapus produk

// Routes untuk admin menambah, mengedit, dan menghapus user
$routes->get('/add-user', 'AdminController::addUser'); // Halaman tambah user
$routes->post('/save-user', 'AdminController::saveUser'); // Simpan user baru
$routes->get('/edit-user/(:num)', 'AdminController::editUser/$1'); // Halaman edit user
$routes->post('/update-user/(:num)', 'AdminController::updateUser/$1'); // Simpan perubahan user
$routes->get('/delete-user/(:num)', 'AdminController::deleteUser/$1'); // Hapus user

// Routes untuk mahasiswa mengakses dashboard dan membeli produk
$routes->get('/dashboard-mahasiswa', 'MahasiswaController::index', ['filter' => 'authGuard']); // Dashboard mahasiswa hanya dapat diakses jika user terotentikasi
$routes->post('/buy-product/(:num)', 'MahasiswaController::buyProduct/$1'); // Proses pembelian produk
$routes->get('/receipt/(:num)', 'MahasiswaController::receipt/$1'); // Rute untuk melihat struk pembelian


// Routes untuk top-up saldo menggunakan Midtrans
$routes->get('/topup', 'TopupController::index'); // Halaman top-up saldo
$routes->post('/topup', 'TopupController::createTransaction'); // Proses transaksi top-up
$routes->get('/topup/status/(:any)', 'TopupController::checkTransactionStatus/$1'); // Cek status transaksi top-up
