<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
class ImageUploadController extends Controller
{
    public static function imageUploadPost(Request $request) {
        
        $params = $request->all();
        $pathToUpload   = 'assets/img';

        $imageName = $request->image->getClientOriginalName();
     
        $upload = $request->image->move(public_path($pathToUpload), $imageName);
    
        return json_encode(['upload' => $upload]); 
    }
}