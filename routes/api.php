<?php

use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\CustomersController;
Use App\Http\Controllers\SessionController;
Use App\Http\Controllers\MenuController;
Use App\Http\Controllers\UtilsController;
Use App\Http\Controllers\ImageUploadController;
Use App\Http\Controllers\ServicesController;
Use App\Http\Controllers\AboutUsController;
Use App\Http\Controllers\ProductsController;
Use App\Http\Controllers\QuotationController;
Use App\Http\Controllers\DocumentsController;

// Clients
Route::get('clients',           [CustomersController::class, 'getAllCustomers']);
Route::post('client-update',    [CustomersController::class, 'updateClient']);
Route::post('client-insert',    [CustomersController::class, 'insertClient']);

// Services
Route::post('service-insert', [ServicesController::class, 'insertService']);
Route::post('service-update', [ServicesController::class, 'updateService']);
Route::post('service-status', [ServicesController::class, 'updateServiceStatus']);

// Product
Route::post('product-insert',   [ProductsController::class, 'insertProduct']);
Route::post('product-update',   [ProductsController::class, 'updateProduct']);
Route::post('product-status',   [ProductsController::class, 'updateProductStatus']);
Route::post('get-product-by-id',[ProductsController::class, 'getProductById']);
Route::get('get-product-by-product-line-id/{productLineId}', function(string $productLineId) {
    $productos = ProductsController::getProducts([
        "productLineId" => $productLineId,
        "type" => "BY_SERVICE_STATUS",
        "status" => "ACTIVO"
    ]);
    return json_encode($productos);
});
Route::get('get-product-lines', [ProductsController::class, 'getProductLines']);

// Quotation
Route::post('quotation-insert',     [QuotationController::class, 'saveQuotation']);
Route::post('get-quotation-by-id',  [QuotationController::class, 'getQuotationById']);

// Authentication
Route::post('login',            [SessionController::class, 'login']);
Route::post('initial-route',    [SessionController::class, 'initialRoute']);
Route::post('render-menu',      [MenuController::class, 'getMenuByProfileId']);

// Utils
Route::post('get-cities-by-deparment-id',   [UtilsController::class, 'getCitiesByDepartmentId']);
Route::post('image-upload',                 [ImageUploadController::class, 'imageUploadPost']);

Route::post('upload-image-to-gallery',  [ImageUploadController::class, 'uploadImage']);
Route::post('delete-image',             [ImageUploadController::class, 'deleteImage']);

// AboutUs
Route::post('update-about-data',    [AboutUsController::class, 'updateAboutData']);
Route::post('collaborator-insert',  [AboutUsController::class, 'insertCollborator']);
Route::post('collaborator-delete',  [AboutUsController::class, 'deleteCollborator']);

// Documents
Route::post('save-document', [DocumentsController::class, 'saveDocument']);
Route::get('get-document-info/{id}', [DocumentsController::class, 'getDocumentInfo']);
Route::post('send-document-by-email', [DocumentsController::class, 'sendDocumentByEmail']);
