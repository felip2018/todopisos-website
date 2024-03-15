<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Http\Controllers\ImageUploadController;

class ServicesController extends Controller
{
    public static function getAllServices($status) {
        if ($status == "ALL") {
            $sql = "SELECT `productLineId`,`name`,`description`,`img`,`status` FROM productline";
        } else {
            $sql = "SELECT `productLineId`,`name`,`description`,`img` FROM productline WHERE `status` = 'ACTIVO'";
        }

        $servicios = DB::select($sql);
        return $servicios;
    }

    public static function getServiceById($productLineId) {
        $service = DB::select('SELECT
        `productLineId`,
        `name`,
        `description`,
        `img`
        FROM productline
        WHERE productLineId = ?', [$productLineId]);

        return $service[0];
    }

    public static function updateServiceStatus(Request $request) {
        $params = $request->all();

        $productLineId  = $params['productLineId'];
        $status         = $params['status'];

        $update = DB::update('UPDATE productline
                                    SET `status` = ?
                              WHERE productLineId = ?', [$status, $productLineId]);

        if($update){
            $response = [
                "status" => 200,
                "message" => "Se ha realizado la actualización exitosamente"
            ];
        }else{
            $response = [
                "status" => 409,
                "message" => "No se ha realizado ninguna actualización"
            ];
        }

        return json_encode($response);
    }

    public static function insertService(Request $request) {

        $params = $request->all();

        $name           = $params['name'];
        $description    = $params['description'];
        $type           = $params['type'];
        $pathToUpload   = 'assets/img/';

        $target_dir = public_path($pathToUpload);

        $target_file = $target_dir . basename($_FILES["img"]["name"]);

        if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {

            // Archivo cargado
            $img = $pathToUpload.'/'.$_FILES["img"]["name"];

            $sql = "INSERT INTO productline(`name`,`description`,`img`,`date`,`status`) VALUES (?,?,?,NOW(),'ACTIVO')";


            $insert = DB::insert($sql, [
                $name,
                $description,
                $img
            ]);

            if($insert){
                $response = [
                    "status" => 201,
                    "message" => "Se ha realizado el registro exitosamente"
                ];
            }else{
                $response = [
                    "status" => 409,
                    "message" => "No se ha realizado ningún registro"
                ];
            }
        } else {
            $response = [
                "status" => 409,
                "message" => "No fue posible cargar el archivo!"
            ];
        }


        return json_encode($response);
    }

    public static function updateService(Request $request) {

        $params = $request->all();

        $name           = $params['name'];
        $description    = $params['description'];
        $productLineId  = $params['productLineId'];

        $pathToUpload   = 'assets/img/';

        if ($_FILES["img"]["name"]) {
            $target_dir = public_path($pathToUpload);
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            $upload = move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
            // Archivo cargado
            $img = $pathToUpload.'/'.$_FILES["img"]["name"];
            $sql = "UPDATE productline
                    SET `name` = ?,
                        `description` = ?,
                        `img`= ?
                    WHERE productLineId = ?";
            $update = DB::update($sql, [
                $name,
                $description,
                $img,
                $productLineId
            ]);
        } else {
            $sql = "UPDATE productline
                SET `name` = ?,
                    `description` = ?
                WHERE productLineId = ?";

            $update = DB::update($sql, [
                $name,
                $description,
                $productLineId
            ]);
        }

        if($update){
            $response = [
                "status" => 201,
                "message" => "Se ha realizado la actualización exitosamente"
            ];
        }else{
            $response = [
                "status" => 409,
                "message" => "No se ha realizado ninguna actualización"
            ];
        }

        return json_encode($response);
    }
}
