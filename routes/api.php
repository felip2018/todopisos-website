<?php

use Illuminate\Http\Request;
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

// Clients
Route::get('clients', [CustomersController::class, 'getAllCustomers']);
Route::post('client-update', [CustomersController::class, 'updateClient']);
Route::post('client-insert', [CustomersController::class, 'insertClient']);

// Services
Route::post('service-insert', [ServicesController::class, 'insertService']);
Route::post('service-update', [ServicesController::class, 'updateService']);
Route::post('service-status', [ServicesController::class, 'updateServiceStatus']);

// Products
Route::post('product-insert', [ProductsController::class, 'insertProduct']);
Route::post('product-update', [ProductsController::class, 'updateProduct']);
Route::post('product-status', [ProductsController::class, 'updateProductStatus']);
Route::post('get-product-by-id', [ProductsController::class, 'getProductById']);

// Quotation
Route::post('quotation-insert', [QuotationController::class, 'saveQuotation']);

// Authentication
Route::post('login', [SessionController::class, 'login']);
Route::post('initial-route', [SessionController::class, 'initialRoute']);
Route::post('render-menu', [MenuController::class, 'getMenuByProfileId']);

// Utils
Route::post('get-cities-by-deparment-id', [UtilsController::class, 'getCitiesByDepartmentId']);
Route::post('image-upload', [ImageUploadController::class, 'imageUploadPost']);

// AboutUs
Route::post('update-about-data', [AboutUsController::class, 'updateAboutData']);
Route::post('collaborator-insert', [AboutUsController::class, 'insertCollborator']);
Route::post('collaborator-delete', [AboutUsController::class, 'deleteCollborator']);
