<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Use App\Http\Controllers\CustomersController;
Use App\Http\Controllers\ServicesController;
Use App\Http\Controllers\UtilsController;
Use App\Http\Controllers\ProductsController;


Route::get('/', function () {
    $destacados = ProductsController::getProducts([
        "productLineId" => 0,
        "type" => "OUTSTANDING",
        "status" => "ACTIVO"
    ]);
    return view('site.welcome', [
        "destacados" => $destacados
    ]);
});

Route::get('/quienes-somos', function() {
    $data = json_decode(file_get_contents('assets/page_data/quienes-somos.json'));
    return view('site.quienes-somos', ["data" => $data]);
});

Route::get('/nuestros-servicios', function() {
    $servicios = ServicesController::getAllServices('ACTIVO');
    return view('site.nuestros-servicios', ["servicios" => $servicios]);
});

Route::get('/carrito', function() {
    return view('site.carrito');
});

Route::get('/servicio/{productLineId}', function($productLineId) {
    $servicio = ServicesController::getServiceById($productLineId);
    $productos = ProductsController::getProducts([
        "productLineId" => $productLineId,
        "type" => "BY_SERVICE_STATUS",
        "status" => "ACTIVO"
    ]);
    return view('site.servicio', [
        "servicio"  => $servicio,
        "productos" => $productos
    ]);
});

Route::get('/contactenos', function() {
    return view('site.contactenos');
});

Route::get('/iniciar-sesion', function() {
    return view('site.iniciar-sesion');
});

Route::get('/registrarse', function() {
    $documentTypesList  = UtilsController::getAllDocumentTypes();
    $departmentsList    = UtilsController::getAllDepartments();
    return view('site.registrarse-como-cliente', [
        "documents"     => $documentTypesList,
        "departments"   => $departmentsList
    ]);
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

Route::get('/app/servicios/productos/editar/{productId}', function($productId) {
    $producto = ProductsController::getProductById($productId);
    return view('application.servicios.editar-producto', [
        "producto" => $producto
    ]);
});

Route::get('/app/servicios/productos/{productLineId}', function($productLineId) {
    $servicio = ServicesController::getServiceById($productLineId);
    $productos = ProductsController::getProducts([
        "productLineId" => $productLineId,
        "type" => "BY_SERVICE",
        "status" => ""
    ]);
    return view('application.servicios.productos', [
        "servicio"  => $servicio,
        "productos" => $productos
    ]);
});

Route::get('/app/quienes-somos', function() {
    $data = json_decode(file_get_contents('assets/page_data/quienes-somos.json'));
    return view('application.quienes-somos', ["data" => $data]);
});

Route::get('/app/cotizaciones', function() {
    return view('application.cotizacion.inicio');
});


Route::get('/app/mis-cotizaciones', function() {
    return view('application.cotizacion.mis-cotizaciones');
});

Route::get('/app/mis-facturas', function() {
    return view('application.cotizacion.mis-facturas');
});

Route::get('/quotation-email', function () {
    $details = [
        'title' => 'Todopisos & Cortinas',
        'body' => 'Tu solicitud de cotización se ha enviado correctamente. En breve estaremos en contacto.',
        'products' => [
            [
                'productId' => 1,
                'name' => 'Producto 1',
                'comment' => 'Comentario del producto 1'
            ],
            [
                'productId' => 2,
                'name' => 'Producto 2',
                'comment' => 'Comentario del producto 2'
            ]
        ]
    ];
    return view('emails.quotationMailView', $details);
    //\Mail::to('felipegarxon@hotmail.com')->send(new App\Mail\QuotationMail());   
});