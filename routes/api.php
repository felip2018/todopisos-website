<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Models\Clientes;

Route::get('clients', function(){
    return Clientes::all();
});