<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// Dashboard.
$routes->get('/', 'HomeController::dashboard', ['filter' => 'auth']);
$routes->get('/dashboard', 'HomeController::dashboard', ['filter' => 'auth']);
$routes->get('/dashboard/getChartData', 'HomeController::getChartData', ['filter' => 'auth']);


// Master Data
function defineRoutes($routes, $namespace, $controllerName, $prefix)
{
    $routes->group($prefix, ['namespace' => $namespace, 'filter' => 'auth'], static function ($routes) use ($controllerName) {
        $routes->get('', "{$controllerName}::index");
        $routes->get('edit/(:any)', "{$controllerName}::edit/$1");
        $routes->post('add', "{$controllerName}::save");
        $routes->post('update/(:num)', "{$controllerName}::save/$1");
        $routes->delete('delete/(:num)', "{$controllerName}::delete/$1");
    });
};

// Data Siswa
defineRoutes($routes, 'App\Controllers', 'SiswaController', 'siswa');

// Data Jurusan
defineRoutes($routes, 'App\Controllers', 'JurusanController', 'jurusan');

// Data Guru
defineRoutes($routes, 'App\Controllers', 'GuruController', 'guru');

// Data Konselor
defineRoutes($routes, 'App\Controllers', 'KonselorController', 'konselor');

// Data Pelanggaran
defineRoutes($routes, 'App\Controllers', 'PelanggaranController', 'pelanggaran');
$routes->get('/riwayat-pelanggaran/cari', 'PelanggaranController::historySearch', ['filter' => 'auth']);
$routes->get('/riwayat-pelanggaran/detail', 'PelanggaranController::violationHistory', ['filter' => 'auth']);

// Jadwal Konseling
defineRoutes($routes, 'App\Controllers', 'JadwalKonselingController', 'jadwal');
$routes->get('jadwal/detail/(:any)', 'JadwalKonselingController::detail/$1', ['filter' => 'auth']);

// Data Konseling
defineRoutes($routes, 'App\Controllers', 'KonselingController', 'konseling');

// Data Industri
defineRoutes($routes, 'App\Controllers', 'IndustriController', 'industri');

// Data Admin
defineRoutes($routes, 'App\Controllers', 'AdminController', 'admin');

// Auth
$routes->get('/login', 'AuthController::showLoginForm', ['filter' => 'loggedInRedirect']);
$routes->post('/login', 'AuthController::login', ['filter' => 'loggedInRedirect']);
$routes->get('/daftar', 'AuthController::showdaftarForm', ['filter' => 'loggedInRedirect']);
$routes->post('/daftar', 'AuthController::daftar', ['filter' => 'loggedInRedirect']);
$routes->get('/logout', 'AuthController::logout');


$routes->set404Override(function () {
    return view('errors/html/error_404', ['message' => 'Halaman tidak ditemukan.']);
});
