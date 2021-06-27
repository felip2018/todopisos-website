<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public static function index() {
        $sql = "
            SELECT 
            tipo_identi, 
            num_identi,
            nombre,
            nombre2,
            apellido,
            apellido2, 
            concat(nombre, ' ', nombre2, ' ', apellido, ' ', apellido2) as nombre_completo,
            email,
            telefono,
            direccion,
            fecha,
            estado 
            FROM clientes 
            WHERE estado = ? 
            ORDER BY nombre_completo ASC";
        $clientes = DB::select($sql, ['Activo']);
        return json_encode($clientes);
    }

    public static function customerValidation($data) {

        $tipo_identi    = $data[0];
        $num_identi     = $data[1];
        $email          = $data[2];

        $validation_1 = DB::select("SELECT COUNT(*) cant 
                FROM clientes 
                WHERE tipo_identi = ?
                AND num_identi = ? ", [$tipo_identi, $num_identi]);

        if($validation_1[0]->cant == 0){

            $validation_2 = DB::select("SELECT COUNT(*) cant 
                FROM clientes 
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

    public function insertClient(Request $request) {

        $params = $request->all();

        $tipo_identi= $params['tipo_identi'];
        $num_identi = $params['num_identi'];
        $tipo_empre = "NIT";
        $num_empre  = 522566781;
        $id_perfil  = 6;
        $razon_social = "--";
        $nombre     = $params['nombre'];
        $nombre2    = ($params['nombre2']) ? $params['nombre2'] : "--";
        $apellido   = $params['apellido'];
        $apellido2  = ($params['apellido2']) ? $params['apellido2'] : "--";
        $email      = $params['email'];
        $telefono   = $params['telefono'];
        $direccion  = $params['direccion'];
        $foto       = "";
        $asignado   = 0;
        $utilizado  = 0;
        $cupo       = 0;
        $remanente  = 0;
        $id_dpto    = 11;
        $id_ciudad  = 1;
        $estado     = "Activo";

        $sql = "INSERT INTO clientes(tipo_identi, num_identi, tipo_empre, num_empre, id_perfil, razon_social, nombre, nombre2, apellido, apellido2, email, telefono, direccion, foto, asignado, utilizado, cupo, remanente, id_departamento, id_ciudad, fecha, estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,?)";

        $customerValidation = ClientesController::customerValidation([$tipo_identi,$num_identi,$email]);

        if($customerValidation['canContinue']){
        
            $insert = DB::insert($sql, [
                $tipo_identi,
                $num_identi,
                $tipo_empre,
                $num_empre,
                $id_perfil,
                $razon_social,
                $nombre,
                $nombre2,
                $apellido,
                $apellido2,
                $email,
                $telefono,
                $direccion,
                $foto,
                $asignado,
                $utilizado,
                $cupo,
                $remanente,
                $id_dpto,
                $id_ciudad,
                $estado
            ]);

            if($insert){
                $response = [
                    "status" => 200,
                    "message" => "El cliente ha sido registrado exitosamente"
                ];
            }else{
                $response = [
                    "status" => 201,
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

        $nombre     = $params['nombre'];
        $nombre2    = $params['nombre2'];
        $apellido   = $params['apellido'];
        $apellido2  = $params['apellido2'];
        $email      = $params['email'];
        $telefono   = $params['telefono'];
        $direccion  = $params['direccion'];
        $tipo_identi= $params['tipo_identi'];
        $num_identi = $params['num_identi'];

        $sql = "UPDATE clientes 
                    SET nombre = ?, 
                        nombre2 = ?,
                        apellido = ?,
                        apellido2 = ?,
                        email = ?,
                        telefono = ?,
                        direccion = ? 
                    WHERE tipo_identi = ? 
                    AND num_identi = ? 
                    AND tipo_empre = 'NIT' 
                    AND num_empre = 522566781";

        $update = DB::update($sql, [
            $nombre,
            $nombre2,
            $apellido,
            $apellido2,
            $email,
            $telefono,
            $direccion,
            $tipo_identi,
            $num_identi
        ]);

        if($update){
            $response = [
                "status" => 200,
                "message" => "El cliente ha sido actualizado exitosamente"
            ];
        }else{
            $response = [
                "status" => 201,
                "message" => "No se ha realizado ningúna actualización"
            ];
        }

        return json_encode($response);
    }
}
