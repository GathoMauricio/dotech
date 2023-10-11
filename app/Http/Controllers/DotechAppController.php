<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\ProductSale;
use PDF;
use Auth;

class DotechAppController extends Controller
{
    public function enviarCotizacion(Request $request)
    {
        $id = $request->ticket_id;
        $sale = Sale::findOrFail($id);
        $saleProducts = ProductSale::where('sale_id', $id)->get();
        $subtotal = 0;
        foreach ($saleProducts as $saleProduct) {
            $subtotal += ($saleProduct->unity_price_sell * $saleProduct->quantity);
        }
        $iva = ($subtotal * 16) / 100;
        $total = $subtotal + $iva;
        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        $logo2 = parseBase64(public_path("storage/" . $sale->company['image']));
        $pdf = \PDF::loadView(
            'pdf.sale',
            [
                'logo' => $logo,
                'logo2' => $logo2,
                'sale' => $sale,
                'saleProducts' => $saleProducts,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total
            ]
        );
        $emails = $sale->department['email'];
        // if (!empty($request->extra_email)) {
        //     $emails = [$sale->department['email'], $request->extra_email];
        // }
        $result = \Mail::send('email.sale', ['sale' => $sale], function ($mail) use ($pdf, $sale, $emails) {
            $mail->from('dotechapp@dotredes.com', env('APP_NAME'));
            $mail->to($emails);
            $mail->attachData($pdf->output(), 'Cotizacion_' . $sale->id . '.pdf');
        });

        return response()->json([
            'status' => 1,
            'message' => 'Cotización enviada',
            'result' => $result
        ]);
        //$msg_user_id = 0;
        //$msg = 'envió la cotización: ' . $sale->description . ' de ' . $sale->company->name;
        //$msg_route = route('quote_products', $sale->id);
        //$notificationUsers = \App\User::where('rol_user_id', 1)->get();
        // createSysLog($msg);
        // foreach ($notificationUsers as $user) {
        //     $msg_user_id = $user->id;
        //     event(new \App\Events\NotificationEvent([
        //         'id' => $msg_user_id,
        //         'msg' => \Auth::user()->name . ' ' . \Auth::user()->middle_name . ' ' . $msg,
        //         'route' => $msg_route
        //     ]));
        // }
    }
}
