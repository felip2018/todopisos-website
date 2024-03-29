<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
	public static function login(Request $request) {
		$params = $request->all();

		$user = $params['user'];
		$pass = $params['pass'];

		$login = DB::select("SELECT COUNT(*) cant
							 FROM user
							 WHERE email = ? AND password = ? AND profileId = ?", [$user, $pass, 1]);

		if($login[0]->cant > 0) {

			$data = DB::select("SELECT
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
								INNER JOIN documenttype dt ON dt.documentTypeId = u.documentTypeId
								INNER JOIN profile p ON p.profileId = u.profileId
								WHERE email = ?
								AND password = ?", [$user, $pass]);

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

	public static function initialRoute(Request $request) {
		$params = $request->all();
		$profileId = $params['profileId'];

		$route = '';

		switch ($profileId) {
			case 1:
				$route = '/app/administrator';
				break;

			case 2:
				$route = '/app/customer';
				break;

			default:
				$route = '/app/customer';
				break;
		}

		return json_encode(["route" => $route]);
	}
}
