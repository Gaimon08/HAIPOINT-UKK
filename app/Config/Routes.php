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

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::dashboard');

$routes->get('/settings', 'Settings::index');
$routes->get('/general-settings', 'Settings::generalSettings');
$routes->post('/general-save', 'Settings::simpanGeneralSettings');

// User
$routes->get('/list-user', 'UserController::index', ['filter' => 'role:Administrator']);
$routes->get('/register', 'UserController::tambah_user');
$routes->post('/user-save', 'UserController::simpanUser');
$routes->get('/profile/(:any)', 'UserController::profile/$1');
$routes->get('/user-edit/(:any)', 'UserController::editUser/$1');
$routes->post('/user-update', 'UserController::updateUser');
$routes->post('/users-update', 'UserController::updateUsers');
$routes->get('/user-delete/(:any)', 'UserController::hapusUser/$1');
// Dashboard
$routes->get('/dashboard', 'Home::dashboard');

// Produk
$routes->get('/list-produk', 'ProdukController::index');
$routes->post('/produk-save', 'ProdukController::simpanProduk');
$routes->post('/produk-update', 'ProdukController::updateProduk');
$routes->post('/produk-delete', 'ProdukController::hapusProduk');


// Jenis Produk
$routes->get('/list-jenis-produk', 'JenisProduk::index');
$routes->post('/jenis-produk-save', 'JenisProduk::simpanJenisProduk');
$routes->post('/jenis-produk-update', 'JenisProduk::updateJenisProduk');
$routes->post('/jenis-produk-delete', 'JenisProduk::hapusJenis');


// Satuan Produk
$routes->get('/list-satuan-produk', 'SatuanProduk::index');
$routes->get('/satuan-produk-add', 'SatuanProduk::tambahSatuanProduk');
$routes->post('/satuan-produk-save', 'SatuanProduk::simpanSatuanProduk');
$routes->get('/satuan-produk-delete/(:any)', 'SatuanProduk::hapusSatuan/$1');
$routes->get('/satuan-produk-edit/(:num)', 'SatuanProduk::editSatuanProduk/$1');
$routes->post('/satuan-produk-update', 'SatuanProduk::updateSatuanProduk');
$routes->post('/satuan-produk-delete', 'SatuanProduk::hapusSatuan');


$routes->get('/list-supplier', 'SupplierController::index');
$routes->get('/supplier-delete/(:any)', 'SupplierController::hapusSupplier/$1');
$routes->get('/supplier-add', 'SupplierController::tambahSupplier');
$routes->post('/supplier-save', 'SupplierController::simpanSupplier');
$routes->post('/supplier-update', 'SupplierController::updateSupplier');
$routes->get('/supplier-edit/(:num)', 'SupplierController::editSupplier/$1');
$routes->post('/supplier-delete', 'SupplierController::hapusSupplier');

$routes->get('/list-transaksi-pembelian', 'TransaksiController::transaksiPembelian');
$routes->get('/list-transaksi-penjualan', 'TransaksiController::ListPenjualan');
$routes->get('/detail-penjualan/(:any)', 'TransaksiController::listDetailPenjualan/$1');
$routes->get('/invoice-transaksi-pembelian/(:any)', 'TransaksiController::invoicePembelian/$1');
$routes->get('/transaksi-penjualan', 'TransaksiController::transaksiPenjualan');
$routes->post('/penjualan-bayar', 'TransaksiController::simpanPenjualan');
$routes->post('/pembelian-save', 'TransaksiController::simpanPembelian');
$routes->post('/pembelian-delete', 'TransaksiController::hapusPembelian');
$routes->post('/pembelian-update', 'TransaksiController::updatePembelian');
$routes->post('/CekProduk', 'TransaksiController::CekProduk');
$routes->get('/Cek', 'TransaksiController::cek');
$routes->post('/add-cart', 'TransaksiController::addCart');
$routes->get('/clear-cart', 'TransaksiController::clearCart');
$routes->get('/remove-items/(:any)', 'TransaksiController::removeitems/$1');



$routes->get('/laporan-produk', 'ProdukController::laporanProduk');
$routes->get('/cetak-struk', 'TransaksiController::cetakStruk');

$routes->post('/ajax-cetak-struk', 'TransaksiController::cetakStruk');
$routes->post('/ajax-laporan-harian', 'LaporanController::ViewLaporanHarian');
$routes->post('/ajax-laporan-bulanan', 'LaporanController::ViewLaporanBulanan');
$routes->post('/ajax-laporan-tahunan', 'LaporanController::ViewLaporanTahunan');

$routes->get('/barcode', 'ProdukController::barcodeGenerator');

$routes->get('/laporan-harian', 'LaporanController::LaporanHarian');
$routes->get('/laporan-bulanan', 'LaporanController::LaporanBulanan');
$routes->get('/laporan-tahunan', 'LaporanController::LaporanTahunan');

$routes->get('/print-laporan-harian/(:any)', 'LaporanController::PrintLaporanHarian/$1');
$routes->get('/print-laporan-bulanan/(:any)/(:any)', 'LaporanController::PrintLaporanBulanan/$1/$2');
$routes->get('/print-laporan-tahunan/(:any)', 'LaporanController::PrintLaporanTahunan/$1');

// <?php

// namespace Config;

// $routes = Services::routes();

// if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
//     require SYSTEMPATH . 'Config/Routes.php';
// }

// $routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home');
// $routes->setDefaultMethod('index');
// $routes->setTranslateURIDashes('false');
// $routes->set404Override();
// $routes->setAutoRoute(true);


// $routes->get('/', 'Home::dashboard ');