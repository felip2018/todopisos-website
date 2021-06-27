<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\ClientesController;
Use App\Http\Controllers\SessionController;

Route::get('clients', [ClientesController::class, 'index']);
Route::post('client-update', [ClientesController::class, 'updateClient']);
Route::post('client-insert', [ClientesController::class, 'insertClient']);

Route::post('login', [SessionController::class, 'login']);