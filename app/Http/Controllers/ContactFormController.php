<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ContactForm;

class ContactFormController extends Controller
{
    public static function save(Request $request){
        try {
            $params = $request->all();

            DB::beginTransaction();
            ContactForm::create([
                "name" => $params["name"],
                "email" => $params["email"],
                "phone" => $params["phone"],
                "message" => $params["message"]
            ]);
            DB::commit();

            return response([
                "status" => 201,
                "response" => "Se ha registrado el formulario correctamente!"
            ], 200);

        } catch (\ErrorException $e) {
            DB::rollBack();
            return response([
                "status" => 409,
                "message" => $e->getMessage()
            ], 409);
        }
    }

    public static function updateStatus(Request $request) {
        try {
            $params = $request->all();

            DB::beginTransaction();
            ContactForm::where("id", $params["id"])->update([
               "status" => $params["status"]
            ]);
            DB::commit();

            return response([
                "status" => 200,
                "response" => "Se ha actualizado el formulario correctamente!"
            ], 200);

        } catch (\ErrorException $e) {
            DB::rollBack();
            return response([
                "status" => 409,
                "message" => $e->getMessage()
            ], 409);
        }
    }
}
