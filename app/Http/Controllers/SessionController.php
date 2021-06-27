<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
	public static function login(Request $request){
		$params = $request->all();

		$user = $params['user'];
		$pass = $params['pass'];

		$login = DB::select("SELECT COUNT(*) cant 
							 FROM usuarios  
							 WHERE email = ? AND clave = ?", [$user, $pass]);

		if($login[0]->cant > 0) {

			$data = DB::select("SELECT 
								tipo_identi,
								num_identi,
								nombre,
								nombre2,
								apellido,
								apellido2,
								concat(nombre,' ',nombre2,' ',apellido,' ',apellido2) as nombre_completo,
								email,
								direccion,
								telefono
								FROM usuarios 
								WHERE email = ? 
								AND clave = ?", [$user, $pass]);

			$response = [
				"status" 	=> 200,
				"message"	=> "Inicio de sesión exitoso",
				"data"		=> $data
			];
		}else{
			$response = [
				"status" 	=> 201,
				"message"	=> "Validar usuario y/o contraseña"
			];
		}

		return json_encode($response);
	}
}