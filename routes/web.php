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
    return view('site.welcome');
});

Route::get('/quienes-somos', function() {
    return view('site.quienes-somos');
});

Route::get('/nuestros-servicios', function() {
    return view('site.nuestros-servicios');
});

Route::get('/contactenos', function() {
    return view('site.contactenos');
});

Route::get('/iniciar-sesion', function() {
    return view('site.iniciar-sesion');
});

Route::get('/app/inicio', function() {
    return view('application.welcome');
});