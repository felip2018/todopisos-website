<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public static function updateAboutData(Request $request) {

        $params = $request->all();
        $pathToUpload   = 'assets/img/';
        $target_dir = public_path($pathToUpload);

        $data = json_decode(file_get_contents('assets/page_data/quienes-somos.json'));
        $data->description = $params['description'];
        
        if ($_FILES['image']['name']) {
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                 // Archivo cargado
                $img = $pathToUpload.'/'.$_FILES["image"]["name"];
                $data->image = $img;
            }
        }

        $idx = 0;
        foreach($_POST['ourTeam'] as $key => $value) {
            $data->ourTeam[$idx]->name = $value["name"];
            $data->ourTeam[$idx]->job  = $value["job"];
            $idx++;
        }

        $idx = 0;
        foreach($_FILES['ourTeam']['name'] as $ket => $value) {
            if ($value["img"]) {
                $target_file = $target_dir . basename($_FILES['ourTeam']['name'][$idx]["img"]);
                if(move_uploaded_file($_FILES["ourTeam"]["tmp_name"][$idx]["img"], $target_file)) {
                    // Archivo cargado
                    $img = $pathToUpload.'/'.$_FILES['ourTeam']['name'][$idx]["img"];
                    $data->ourTeam[$idx]->img = $img;
                }
            }
            $idx++;
        }

        $newJsonString = json_encode($data);
        $update = file_put_contents('assets/page_data/quienes-somos.json', $newJsonString);
        
        if ($update) {
            $response = [
                "status" => 200,
                "message" => "La información ha sido actualizada."
            ];
        } else {
            $response = [
                "status" => 409,
                "message" => "No ha sido posible actualizar la información."
            ];
        }

        return json_encode($response);
    }

    public static function insertCollborator(Request $request) {
        $params = $request->all();

        $name = $_POST["name"];
        $job  = $_POST["job"];

        $pathToUpload   = 'assets/img/';
        $target_dir = public_path($pathToUpload);

        $data = json_decode(file_get_contents('assets/page_data/quienes-somos.json'));

        $collaborators = $data->ourTeam;
        $img = $pathToUpload.'/dummy-user.png';
        if ($_FILES['img']['name']) {
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                 // Archivo cargado
                $img = $pathToUpload.'/'.$_FILES["img"]["name"];
            }
        }

        array_push($collaborators, [ "name" => $name, "job" => $job, "img" => $img ]);
        $data->ourTeam = $collaborators;

        $newJsonString = json_encode($data);
        $update = file_put_contents('assets/page_data/quienes-somos.json', $newJsonString);
        
        if ($update) {
            $response = [
                "status" => 200,
                "message" => "El colaborador ha sido agregado correctamente."
            ];
        } else {
            $response = [
                "status" => 409,
                "message" => "No ha sido posible registrar al colaborador."
            ];
        }

        return json_encode($response);
    }

    public static function deleteCollborator(Request $request) {
        $params = $request->all();

        $idx = $params["idx"];

        $data = json_decode(file_get_contents('assets/page_data/quienes-somos.json'));
        $collaborators = $data->ourTeam;
        array_splice($collaborators, $idx);
        $data->ourTeam = $collaborators;

        $newJsonString = json_encode($data);
        $update = file_put_contents('assets/page_data/quienes-somos.json', $newJsonString);
        
        if ($update) {
            $response = [
                "status" => 200,
                "message" => "El colaborador ha sido eliminado correctamente."
            ];
        } else {
            $response = [
                "status" => 409,
                "message" => "No ha sido posible eliminar al colaborador."
            ];
        }

        return json_encode($response);
    }
}

