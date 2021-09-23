<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public static function getAllCustomers() {
        $sql = "SELECT 
                u.userId,
                u.documentTypeId,
                u.docNum,
                u.profileId,
                u.name,
                u.surname,
                u.email,
                u.phone,
                concat(u.name,' ',u.surname) as fullname,
                u.address,
                u.status,
                dt.abbreviation as docType,
                p.name as profile
                FROM user u 
                INNER JOIN documentType dt ON dt.documentTypeId = u.documentTypeId
                INNER JOIN profile p ON p.profileId = u.profileId
                WHERE p.profileId = ?
                ORDER BY fullname ASC";

        $clientes = DB::select($sql, [2]);
        return json_encode($clientes);
    }

    public static function customerValidation($data) {

        $docType    = $data[0];
        $docNum     = $data[1];
        $email      = $data[2];

        $validation_1 = DB::select("SELECT COUNT(*) cant 
                FROM user 
                WHERE documentTypeId = ?
                AND docNum = ? ", [$docType, $docNum]);

        if($validation_1[0]->cant == 0){

            $validation_2 = DB::select("SELECT COUNT(*) cant 
                FROM user 
                WHERE email = ?", [$email]);

            if($validation_2[0]->cant == 0){
                $response = [
                    "canContinue" => true,
                    "message" => "Validación exitosa."
                ];
            }else{
                $response = [
                    "canContinue" => false,
                    "message" => "El correo electrónico ya se encuentra registrado en el sistema."
                ];    
            }         

        }else{
            $response = [
                "canContinue" => false,
                "message" => "El tipo y número de identificación ya se encuentran registrados en el sistema."
            ];
        }

        return $response;
    }

    public static function insertClient(Request $request) {

        $params = $request->all();

        $documentTypeId = $params['documentTypeId'];
        $docNum         = $params['docNum'];
        $profileId      = 2;
        $name           = $params['name'];
        $surname        = $params['surname'];
        $email          = $params['email'];
        $phone          = $params['phone'];
        $address        = $params['address'];
        $cityId         = $params['cityId'];

        $sql = "INSERT INTO user (`documentTypeId`, `docNum`, `profileId`, `name`, `surname`, `email`, `phone`, `address`, `password`, `cityId`, `date`, `status`) VALUES
        (?,?,?,?,?,?,?,?,?,?,NOW(),'ACTIVO')";

        $customerValidation = CustomersController::customerValidation([$documentTypeId, $docNum, $email]);

        if($customerValidation['canContinue']){
        
            $insert = DB::insert($sql, [
                $documentTypeId,
                $docNum,
                $profileId,
                $name,
                $surname,
                $email,
                $phone,
                $address,
                $docNum,
                $cityId
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
        }else{
            $response = [
                "status" => 409,
                "message" => $customerValidation["message"]
            ];
        }

        return json_encode($response);
    }

    public function updateClient(Request $request) {
        $params = $request->all();

        $name       = $params['name'];
        $surname    = $params['surname'];
        $email      = $params['email'];
        $phone      = $params['phone'];
        $address    = $params['address'];
        $userId     = $params['userId'];

        $sql = "UPDATE user 
                    SET `name`      = ?, 
                        `surname`   = ?,
                        `email`     = ?,
                        `phone`     = ?,
                        `address`   = ? 
                    WHERE userId    = ? ";

        $update = DB::update($sql, [$name,
            $surname,
            $email,
            $phone,
            $address,
            $userId
        ]);

        if($update){
            $response = [
                "status" => 200,
                "message" => "El cliente ha sido actualizado exitosamente"
            ];
        }else{
            $response = [
                "status" => 409,
                "message" => "No se ha realizado ningúna actualización"
            ];
        }

        return json_encode($response);
    }
}
