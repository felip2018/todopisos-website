<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ImageUploadController extends Controller
{
    public static function imageUploadPost(Request $request) {
        $pathToUpload   = 'assets/img';

        $imageName = $request->image->getClientOriginalName();

        $upload = $request->image->move(public_path($pathToUpload), $imageName);

        return json_encode(['upload' => $upload]);
    }

    public static function uploadImage(Request $request) {
        try {
            $params = $request->all();
            $allowedExtensions = array("jpeg", "jpg", "png");
            $image = $_FILES["img"];
            $extension = explode("/",$image["type"])[1];
            if(!in_array($extension, $allowedExtensions)) {
                return response()->json([
                    "status" => 409,
                    "message" => "El formato del archivo no es permitido"
                ], 409);
            }

            DB::beginTransaction();

            $tmp_name = $image["tmp_name"];
            $timestamp = Carbon::now()->timestamp;
            $new_filename = $timestamp.".".$extension;
            $new_directory = public_path("gallery")."/".$new_filename;
            move_uploaded_file($tmp_name, $new_directory);
            $path = "gallery/".$new_filename;

            Gallery::create([
                "productLineId" => null,
                "name"          => $params["name"],
                "description"   => $params["description"],
                "url"           => $path,
                "date"          => Carbon::now()->toDateString()
            ]);

            DB::commit();

            return response()->json([
                "status" => 200,
                "response" => "La imagen ha sido cargada exitosamente"
            ], 200);
        } catch (\ErrorException $e) {
            return response()->json([
                "status" => 409,
                "message" => $e->getMessage()
            ], 409);
        }
    }

    public static function deleteImage() {

    }
}
