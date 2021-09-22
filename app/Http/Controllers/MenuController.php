<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public static function getMenuByProfileId(Request $request) {

        $params = $request->all();
        $profileId = $params['profileId'];

        $sql = "SELECT 
                pm.profileMenuId,
                pm.profileId,
                pm.menuId,
                m.name,
                m.link,
                m.i_class
                FROM `profile_menu` pm
                INNER JOIN `menu` m ON m.menuId = pm.menuId
                INNER JOIN `profile` p ON p.profileId = pm.profileId
                WHERE pm.profileId = ?
                AND pm.status = 'ACTIVO'
                ORDER BY pm.order_by ASC";

        $servicios = DB::select($sql, [$profileId]);
        return json_encode($servicios);
    }
}