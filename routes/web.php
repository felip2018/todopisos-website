<?php

use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\ServicesController;
Use App\Http\Controllers\UtilsController;
Use App\Http\Controllers\ProductsController;
Use App\Http\Controllers\QuotationController;
Use App\Http\Controllers\CustomersController;
Use App\Models\Gallery;
Use App\Models\Document;

// ------------------------------------------------ Routes Website

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

Route::get('/galeria', function() {
    $data = Gallery::where("status", "ACTIVO")->orderBy("galeryImageId", "desc")->get();
    return view('site.galeria', [
        "data" => $data
    ]);
});

// ------------------------------------------- Routes Internal App

Route::get('/app/administrator', function() {
    //return view('application.admin-home');
    return view('application.clientes.inicio');
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

Route::get('/app/clientes/registrar-documento/{type}/{userId}', function($type, $userId) {
    $required_types = array("1", "2");
    if (!in_array($type, $required_types)) {
        return view('application.error', [
           "error_message" => "Falta el parámetro de tipo para identificar el documento, vuelva a la sección de clientes!"
        ]);
    }
    if (!$userId) {
        return view('application.error', [
            "error_message" => "Falta el parámetro de usuario para identificar al cliente, vuelva a la sección de clientes!"
        ]);
    }
    $customerInfo = CustomersController::getCustomerById($userId);
    return view('application.clientes.registrar-factura', [
        "customerInfo" => $customerInfo,
        "type" => $type
    ]);
});

Route::get('/app/clientes/ver-documentos/{userId}', function($userId) {
    $customerInfo = CustomersController::getCustomerById($userId);
    $documents = Document::where("userId", $userId)->get();
    return view('application.clientes.ver-documentos', [
        "customerInfo" => $customerInfo,
        "documents" => $documents
    ]);
});

Route::get('/app/clientes/ver-detalle-documento-imprimir/{documentId}', function($documentId) {
    $data = Document::where("idDocument", $documentId)
        ->with("user")
        ->with("productsList", function($q) {
            $q->with("product");
        })->first();
    return view('application.clientes.ver-detalle-documento-imprimir', [
        "data" => $data
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

Route::get('/app/galeria', function() {
    $data = Gallery::whereIn("status", ["ACTIVO", "INACTIVO"])->get();
    return view('application.galeria.inicio', ["data" => $data]);
});

Route::get('/send-document-by-email/{documentId}', function ($documentId) {
    $data = Document::where("idDocument", $documentId)
        ->with("user")
        ->with("productsList", function($q) {
            $q->with("product");
        })->first();
    return view('emails.document', [
        "data" => $data
    ]);
    //\Mail::to('felipegarxon@hotmail.com')->send(new App\Mail\QuotationMail());
});
