<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Use App\Http\Controllers\CustomersController;
Use App\Http\Controllers\ServicesController;
Use App\Http\Controllers\UtilsController;


Route::get('/', function () {
    return view('site.welcome');
});

Route::get('/quienes-somos', function() {
    $data = json_decode(file_get_contents('assets/page_data/quienes-somos.json'));
    return view('site.quienes-somos', ["data" => $data]);
});

Route::get('/nuestros-servicios', function() {
    $servicios = ServicesController::getAllServices('ACTIVO');
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

Route::get('/app/administrator', function() {
    return view('application.admin-home');
});

Route::get('/app/customer', function() {
    return view('application.customer-home');
});

Route::get('/app/clientes', function() {
    return view('application.clientes.inicio');
});

Route::get('/app/clientes/registrar', function() {
    $documentTypesList  = UtilsController::getAllDocumentTypes();
    $departmentsList    = UtilsController::getAllDepartments();
    return view('application.clientes.registrar', [
        "documents"     => $documentTypesList,
        "departments"   => $departmentsList
    ]);
});

Route::get('/app/servicios', function() {
    $servicios = ServicesController::getAllServices('ALL');
    return view('application.servicios.inicio', ["servicios" => $servicios]);
});

Route::get('/app/servicios/registrar', function() {
    return view('application.servicios.registrar');
});

Route::get('/app/servicios/editar/{productLineId}', function($productLineId) {
    $servicio = ServicesController::getServiceById($productLineId);
    return view('application.servicios.editar', ["servicio" => $servicio]);
});