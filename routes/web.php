<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Use App\Http\Controllers\ClientesController;
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

// App::Clientes

Route::get('/app/clientes', function() {
    return view('application.clientes.inicio');
});

Route::get('/app/clientes/registrar', function() {
    return view('application.clientes.registrar');
});

// App::Galeria

Route::get('/app/galeria', function() {
    return view('application.galeria.inicio');
});

Route::get('/app/galeria/registrar', function() {
    return view('application.galeria.registrar');
});