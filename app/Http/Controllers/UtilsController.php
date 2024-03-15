<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilsController extends Controller
{

    public static function getAllDocumentTypes() {
        $sql = "SELECT * FROM documentType";
        $list = DB::select($sql);
        return $list;
    }

    public static function getAllDepartments() {
        $sql = "SELECT * FROM department ORDER BY `name` ASC";
        $list = DB::select($sql);
        return $list;
    }

    public static function getCitiesByDepartmentId(Request $request) {
        $params = $request->all();
        $dpmntId = $params['dpmntId'];

        $sql = "SELECT * FROM city WHERE dpmntId = ? ORDER BY `name` ASC";

        $list = DB::select($sql, [$dpmntId]);
        return json_encode($list);
    }

    public static function getProductLines() {
        $sql = "SELECT * FROM productline WHERE status = ? ORDER BY `name` ASC";
        $list = DB::select($sql, ["ACTIVO"]);
        return $list;
    }

}
