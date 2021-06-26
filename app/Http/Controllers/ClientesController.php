<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        return Clientes::all();
    }
}
