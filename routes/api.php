<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\ClientesController;

Route::get('clients', [ClientesController::class, 'index']);