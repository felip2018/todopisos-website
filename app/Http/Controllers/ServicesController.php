<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public static function getAllServices() {
        $sql = "SELECT 
                `productLineId`,
                `name`,
                `description`,
                `img`
                FROM product_line
                WHERE `status` = 'ACTIVO'";

        $servicios = DB::select($sql);
        return $servicios;
    }
}