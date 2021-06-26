<?php

namespace App\Http\Controllers;

Use App\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        return Clientes::all();
    }
}
