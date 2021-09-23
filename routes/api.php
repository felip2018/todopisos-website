<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\CustomersController;
Use App\Http\Controllers\SessionController;
Use App\Http\Controllers\MenuController;
Use App\Http\Controllers\UtilsController;
Use App\Http\Controllers\ImageUploadController;
Use App\Http\Controllers\ServicesController;

// Clients
Route::get('clients', [CustomersController::class, 'getAllCustomers']);
Route::post('client-update', [CustomersController::class, 'updateClient']);
Route::post('client-insert', [CustomersController::class, 'insertClient']);

// Services
Route::post('service-insert', [ServicesController::class, 'insertService']);
Route::post('service-update', [ServicesController::class, 'updateService']);
Route::post('service-status', [ServicesController::class, 'updateServiceStatus']);

// Authentication
Route::post('login', [SessionController::class, 'login']);
Route::post('initial-route', [SessionController::class, 'initialRoute']);
Route::post('render-menu', [MenuController::class, 'getMenuByProfileId']);

// Utils
Route::post('get-cities-by-deparment-id', [UtilsController::class, 'getCitiesByDepartmentId']);
Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost']);
