<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\CustomersController;
Use App\Http\Controllers\SessionController;
Use App\Http\Controllers\MenuController;

Route::get('clients', [CustomersController::class, 'getAllCustomers']);
Route::post('client-update', [CustomersController::class, 'updateClient']);
Route::post('client-insert', [CustomersController::class, 'insertClient']);

Route::post('login', [SessionController::class, 'login']);

Route::post('render-menu', [MenuController::class, 'getMenuByProfileId']);