<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public static function index()
    {
        $sql = "
            select 
            tipo_identi, 
            num_identi, 
            concat(nombre, ' ', nombre2, ' ', apellido, ' ', apellido2) as nombre,
            email,
            telefono,
            direccion,
            fecha,
            estado 
            from clientes 
            where estado = ?
        ";
        $clientes = DB::select($sql, ['Activo']);
        return json_encode($clientes);
    }

    public function insertClient(Request $request){

    }
}
