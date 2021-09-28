<?php

namespace App\Http\Controllers;

Use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\QuotationMail;

class QuotationController extends Controller
{

    public static function getAllQuotations() {
        $select = DB::select('SELECT 
            q.quotationId,
            u.userId,
            concat(dt.abbreviation, " ", u.docNum) as document,
            concat(u.name, " ", u.surname) as fullname,
            q.date,
            q.status
            FROM quotation q
            INNER JOIN user u ON u.userId = q.userId
            INNER JOIN documentType dt ON dt.documentTypeId = u.documentTypeId
            ORDER BY q.date DESC');
        return $select;
    }

    public static function getQuotationById(Request $request) {

        $params = $request->all();

        $quotationId = $params["quotationId"];

        $select = DB::select('SELECT 
            q.quotationId,
            u.userId,
            concat(dt.abbreviation, " ", u.docNum) as document,
            concat(u.name, " ", u.surname) as fullname,
            u.phone,
            u.address,
            q.date,
            q.status
            FROM quotation q
            INNER JOIN user u ON u.userId = q.userId
            INNER JOIN documentType dt ON dt.documentTypeId = u.documentTypeId
            WHERE q.quotationId = ?
            ORDER BY q.date DESC', [$quotationId]);

        if (sizeof($select) > 0) {

            // consultamos el detalle de la cotización
            $detail = DB::select('SELECT
            qd.quotationDetailId,
            qd.quotationId,
            qd.productId,
            p.name as productName,
            qd.customerComments as productComment,
            qd.quantity
            FROM quotationDetail qd 
            INNER JOIN product p ON p.productId = qd.productId
            WHERE qd.quotationId = ?', [$quotationId]);

            $response = [
                "status" => 200,
                "quotation" => $select[0],
                "detail" => $detail
            ];

        } else {
            $response = [
                "status" => 409,
                "message" => "No se ha encontrado registro para el id solicitado."
            ];
        }

        return json_encode($response);
    }

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
                $insertDetail = DB::insert('INSERT INTO quotationdetail(`quotationId`,`productId`,`customerComments`,`description`,`unitPrice`,`quantity`,`totalPrice`)VALUES(?,?,?,"",0,?,0)', [
                    $quotation[0]->quotationId,
                    $value["productId"],
                    $value["comment"],
                    $value["quantity"],
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