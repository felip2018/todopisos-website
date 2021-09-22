<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Use App\Http\Controllers\CustomersController;
Use App\Http\Controllers\ServicesController;


Route::get('/', function () {
    return view('site.welcome');
});

Route::get('/quienes-somos', function() {
    $data = json_decode(file_get_contents('assets/page_data/quienes-somos.json'));
    return view('site.quienes-somos', ["data" => $data]);
});

Route::get('/nuestros-servicios', function() {
    $servicios = ServicesController::getAllServices();
    return view('site.nuestros-servicios', ["servicios" => $servicios]);
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

// App

Route::get('/app/inicio', function() {
    return view('application.welcome');
});

Route::get('/app/clientes', function() {
    return view('application.clientes.inicio');
});

Route::get('/app/clientes/registrar', function() {
    return view('application.clientes.registrar');
});

Route::get('/app/galeria', function() {
    return view('application.galeria.inicio');
});

Route::get('/app/galeria/registrar', function() {
    return view('application.galeria.registrar');
});