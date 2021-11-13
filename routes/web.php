<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/login', function () {
//         return view('index');
//     });


Auth::routes();

Route::get('/account', function () {
    return view('account');
});



    Route::get('/warga', 'Admin\WargaController@index');
    Route::get('/warga/{warga}', 'Admin\WargaController@show');
    Route::get('/warga/{warga}/edit', 'Admin\WargaController@edit');
    Route::put('/warga/{warga}', 'Admin\WargaController@update');


    Route::get('/rt', 'Admin\KetuaRtController@index');
    Route::get('/rt/{rt}', 'Admin\KetuaRtController@show');
    Route::get('/rt/{rt}/edit', 'Admin\KetuaRtController@edit');
    Route::put('/rt/{rt}', 'Admin\KetuaRtController@update');
    // Route::get('/tambah', 'Admin\KetuaRtController@create');
    Route::post('/rt/tambah', 'Admin\KetuaRtController@register');


    Route::get('/rw', 'Admin\KetuaRwController@index');
    Route::put('/rw/edit', 'Admin\KetuaRwController@edit');
    Route::delete('/rw/delete', 'Admin\KetuaRwController@delete');
    Route::get('/rw/{rw}', 'Admin\KetuaRwController@show');
    Route::get('/rw/{rw}/edit', 'Admin\KetuaRwController@edit');
    Route::put('/rw/{rw}', 'Admin\KetuaRwController@update');
    Route::post('/rw/tambah', 'Admin\KetuaRwController@register');

    Route::get('/kades', 'Admin\KadesController@index');
    Route::post('/kades/tambah', 'Admin\KadesController@register');
    Route::put('/kades/edit', 'Admin\KadesController@edit');
    Route::delete('/kades/delete', 'Admin\KadesController@delete');

    Route::get('/kades', 'Admin\KadesController@index');


    Route::get('/surat', 'Admin\SuratController@index');
    Route::put('/data_surat/edit', 'Admin\SuratController@edit');

    Route::get('/', function(){
    return view('dashboard');
});

