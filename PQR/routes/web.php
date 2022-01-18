<?php

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

Route::get('/', function () {
    return view('inicio');
});

Route::get('confirma', function () {
    return view('inicio');
});

Route::get('registro', function () {
    return view('inicio');
});

Route::get('qr', function () {
    return view('inicio');
});

Route::get('alerts', function () {
    return view('inicio');
});

Route::post('alerts', function () {
    return view('alerts');
});

Route::post('/', 'App\Http\Controllers\RutPasaporteController@index')->name('inicio');

Route::post('registro', 'App\Http\Controllers\RegistroController@index')->name('registro');

Route::post('confirma', 'App\Http\Controllers\ConfirmaController@index')->name('confirma');

Route::post('qr', 'App\Http\Controllers\EscanerController@index')->name('qr');