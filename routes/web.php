<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Use App\Http\Controllers\ClientesController;


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

Route::get('/registrarse', function() {
    return view('site.registrarse-como-cliente');
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