<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\QuotationMail;

class QuotationController extends Controller
{
    public static function saveQuotation(Request $request) {

        $params = $request->all();

        $userId                 = $params['userId'];
        $customerObservations   = $params['customerObservations'];
        $quotationStatus        = $params['quotationStatus']; 
        $userData               = json_decode($params['userData']);
        
        DB::beginTransaction();

        $insert = DB::insert('INSERT INTO quotation(`userId`,`total`,`customerObservations`,`observations`,`date`,`status`) VALUES(?,0,?,"",NOW(),?)', [
            $userId,
            $customerObservations,
            $quotationStatus
        ]);

        if ($insert) {
            $quotation = DB::select('SELECT MAX(quotationId) as quotationId FROM quotation');
            $errors = 0;
            foreach($params['product'] as $key => $value) {
                $insertDetail = DB::insert('INSERT INTO quotationdetail(`quotationId`,`productId`,`customerComments`,`description`,`unitPrice`,`quantity`,`totalPrice`)VALUES(?,?,?,"",0,0,0)', [
                    $quotation[0]->quotationId,
                    $value["productId"],
                    $value["comment"]
                ]);

                if (!$insertDetail) {
                    $errors++;
                }

            }

            if ($errors == 0) {
                DB::commit();

                $data = [
                    'title'     => 'Todopisos & Cortinas',
                    'body'      => 'Se ha generado la siguiente solicitud de cotización:',
                    'products'  => $params['product'],
                    'user'      => $userData,
                    'customerObservations' => $customerObservations,
                ];

                \Mail::to('felipegarxon@hotmail.com')
                ->cc($userData->email)
                ->send(new QuotationMail($data));

                $response = [
                    "status"    => 201,
                    "message"   =>  "La solicitud cotización ha sido registrada correctamente."
                ];
            } else {
                DB::rollback();
                $response = [
                    "status"    => 409,
                    "message"   =>  "No fue posible registrar el detalle de la cotización."
                ];
            }

        } else {
            DB::rollBack();

            $response = [
                "status"    => 409,
                "message"   =>  "No fue posible realizar el registro de la cotización."
            ];
        }

        return json_encode($response);
    }
}