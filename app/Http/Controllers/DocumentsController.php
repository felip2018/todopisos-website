<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DocumentsController extends Controller
{

    public static function saveDocument(Request $request) {
        try {
            $params = $request->all();

            $userId         = $params["userId"];
            $type           = ($params["type"] == 1) ? "Remisión" : "Cotización";
            $total          = intval($params["total"]);
            $observations   = $params["observations"];
            $advancement    = $params["advancement"];
            $balance        = intval($total) - intval($advancement);
            $products       = json_decode($params["products"]);

            DB::beginTransaction();

            $number = Document::where("type", $type)->count() + 1;

            $document = Document::create([
                "userId" => $userId,
                "type"   => $type,
                "number" => $number,
                "observations" => $observations,
                "total" => $total,
                "advancement" => $advancement,
                "balance" => $balance,
                "date" => Carbon::now()->toDateString()
            ]);

            foreach ($products as $p) {
                DocumentDetail::create([
                    "idDocument" => $document->id,
                    "idProduct" => $p->product->productId,
                    "description" => $p->description,
                    "unitPrice" => $p->price,
                    "quantity" => $p->quantity,
                    "totalPrice" => $p->subtotal
                ]);
            }

            DB::commit();

            return response([
                "status" => 200,
                "response" => "Se ha registrado el documento correctamente!"
            ], 200);

        } catch (\ErrorException $e) {
            DB::rollBack();
            return response([
                "status" => 409,
                "message" => $e->getMessage()
            ], 409);
        }
    }

    public static function getDocumentInfo(string $id) {
        $info = Document::where("idDocument", $id)
            ->with("user")
            ->with("productsList", function($q) {
            $q->with("product");
        })->first();
        return response([
            "status" => 200,
            "response" => $info
        ], 200);
    }

    public static function sendDocumentByEmail(Request $request) {
        try {
            $params = $request->all();
            $d = Document::where("idDocument", $params["documentId"])
                ->with("user")
                ->with("productsList", function($q) {
                    $q->with("product");
                })->first();
            $data = [
                "idDocument" => $d->idDocument,
                "userId" => $d->userId,
                "type" => $d->type,
                "number" => $d->number,
                "observations" => $d->observations,
                "total" => $d->total,
                "advancement" => $d->advancement,
                "balance" => $d->balance,
                "date" => $d->date,
                "status" => $d->statusACTIVO,
                "user" => $d->user,
                "productsList" => $d->productsList
            ];
            $result = Mail::send("emails.document", ["data" => $data], function ($message) use ($data) {
                $subject = "TodopisosyCortinas: Envío de ".$data["type"]." No.".$data["number"];
                $message->to($data["user"]["email"], $data["user"]["name"]);
                $message->subject($subject);
                $message->from('gerencia@todopisosycortinas.com', 'Todopisos y Cortinas');
            });
            return response()->json([
                "message" => "send email successfully",
                "response" => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => 409,
                "message" => $e->getMessage()
            ], 409);
        }
    }

}
