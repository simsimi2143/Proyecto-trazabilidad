<?php

use App\Http\Controllers\RutPasaporteController;
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

Route::post('/', 'App\Http\Controllers\RutPasaporteController@index')->name('inicio');

Route::get('registro', function () {
    return view('registro');
});

Route::get('qr', function () {
    return view('qr');
});

Route::get('confirma', function () {
    return view('confirm');
});