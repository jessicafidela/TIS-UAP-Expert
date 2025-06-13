<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');

// route yang butuh token JWT
$router->group(['middleware' => 'auth'], function () use ($router) {
    // Mahasiswa
    $router->get('/mahasiswa', 'MahasiswaController@index'); // Semua mahasiswa
    $router->get('/mahasiswa/prodi/{id}', 'MahasiswaController@filterByProdi'); // Filter berdasarkan prodi
     // Prodi
     $router->get('/prodi', 'ProdiController@index'); // Semua prodi
     // mata kuliah
    $router->get('/matkul', 'MatkulController@index');          // Lihat semua matkul
    $router->post('/matkul/tambah', 'MatkulController@tambah'); // Tambah matkul ke mahasiswa yang sedang login
    $router->get('/matkul/{nim}', 'MatkulController@getByNim'); // Lihat daftar matkul milik mahasiswa yang sedang login
    // $router->get('/matkul/{id}', 'MatkulController@show');     
});