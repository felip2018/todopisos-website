<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public static function getProducts($params) {

        $productLineId  = $params['productLineId'];
        $type           = $params['type'];
        $status         = $params['status'];

        switch ($type) {

            case 'BY_SERVICE':
                // Consulta para la aplicación como administrador
                $sql = "SELECT 
                    `productId`,
                    `productLineId`,
                    `name`,
                    `description`,
                    `img`,
                    `outstanding`,
                    `status`
                    FROM product 
                    WHERE productLineId = ?";
                $select = DB::select($sql, [$productLineId]);
                break;

            case 'BY_SERVICE_STATUS':
                // Consulta para la pagina web
                $sql = "SELECT 
                    `productId`,
                    `productLineId`,
                    `name`,
                    `description`,
                    `img`,
                    `outstanding`,
                    `status`
                    FROM product 
                    WHERE productLineId = ? 
                    AND `status` = ? ";
                $select = DB::select($sql, [$productLineId, $status]);
                break;
            
            case 'OUTSTANDING':
                // Consulta de destacados para la pagina web 
                $sql = "SELECT 
                    `productId`,
                    `productLineId`,
                    `name`,
                    `description`,
                    `img`,
                    `outstanding`,
                    `status`
                    FROM product 
                    WHERE outstanding = 'SI' 
                    AND `status` = ?";
                $select = DB::select($sql, [$params['status']]);
                break;
        }

        return $select;
    }

    public static function getProductById($productId) {

        $product = DB::select("SELECT 
                                `productId`,
                                `productLineId`,
                                `name`,
                                `description`,
                                `img`,
                                `outstanding`,
                                `status` 
                                FROM product 
                                WHERE productId = ?", [$productId]);
        return $product[0];
    }

    public static function insertProduct(Request $request) {
        $params = $request->all();
        
        $productLineId  = $params['productLineId'];
        $name           = $params['name'];
        $description    = $params['description'];
        $outstanding    = $params['outstanding'];

        $pathToUpload   = 'assets/img/products/';
        $target_dir = public_path($pathToUpload);
        $target_file = $target_dir . basename($_FILES["img"]["name"]);

        if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            
            // Archivo cargado
            $img = $pathToUpload.'/'.$_FILES["img"]["name"];
            
            $sql = "INSERT INTO product(`productLineId`,`name`,`description`,`img`,`outstanding`,`date`,`status`)VALUES(?,?,?,?,?,NOW(),'ACTIVO')";


            $insert = DB::insert($sql, [
                $productLineId,
                $name,
                $description,
                $img,
                $outstanding
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

    public static function updateProductStatus(Request $request) {
        $params = $request->all();
        
        $productId  = $params['productId'];
        $status         = $params['status'];

        $update = DB::update('UPDATE product
                                     SET `status` = ? 
                              WHERE productId = ?', [$status, $productId]);
        
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

    public static function updateProduct(Request $request) {
        
        $params = $request->all();
        
        $productId      = $params['productId'];
        $name           = $params['name'];
        $description    = $params['description'];
        $outstanding    = $params['outstanding'];

        $pathToUpload   = 'assets/img/products/';

        if ($_FILES["img"]["name"]) {
            $target_dir = public_path($pathToUpload);
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            $upload = move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
            // Archivo cargado
            $img = $pathToUpload.'/'.$_FILES["img"]["name"];
            $sql = "UPDATE product
                    SET `name` = ?,
                        `description` = ?,
                        `img`= ?,
                        `outstanding` = ?
                    WHERE productId = ?";
            $update = DB::update($sql, [
                $name,
                $description,
                $img,
                $outstanding,
                $productId
            ]);
        } else {
            $sql = "UPDATE product
                    SET `name` = ?,
                        `description` = ?,
                        `outstanding` = ?
                    WHERE productId = ?";

            $update = DB::update($sql, [
                $name,
                $description,
                $outstanding,
                $productId
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