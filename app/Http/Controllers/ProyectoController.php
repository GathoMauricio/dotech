<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\WhitdrawalProvider;
use App\Whitdrawal;

class ProyectoController extends Controller
{
    public function show($id)
    {
        $proyecto =  Sale::findOrFail($id);

        $estimado = 0;
        foreach ($proyecto->productos as $producto) {
            $estimado += $producto->unity_price_sell * $producto->quantity;
        }

        $proyecto->estimated = $estimado;
        $proyecto->iva = ($estimado + ($estimado * 0.16)) - $estimado;
        $proyecto->save();
        $totalRetiros = 0;
        foreach ($proyecto->retiros as $retiro) {
            if ($retiro->status == 'Aprobado')
                $totalRetiros += floatval($retiro->quantity);
        }

        $costoProyecto = number_format($proyecto->estimated + ($proyecto->estimated * 0.16), 2);
        $utilidad = number_format($proyecto->estimated + ($proyecto->estimated * 0.16) - $totalRetiros, 2);
        $comision = ($proyecto->estimated + ($proyecto->estimated * 0.16) - $totalRetiros) / 1.16;
        $comision = number_format($comision * ($proyecto->commision_percent / 100), 2);

        $proyecto->utility = $utilidad;
        $proyecto->save();

        $productos_subtotal = $proyecto->productos->sum('total_sell');
        $productos_iva = ($productos_subtotal * 16) / 100;
        $productos_total = ($productos_subtotal + $productos_iva);

        $total = 0;
        $totalMasIva = 0;
        $products = $proyecto->productos;
        foreach ($products as $product) {
            $subtotal = $product->unity_price_sell * $product->quantity;
            $product->total_sell = $subtotal + ($subtotal * .16);

            if (strlen($product->discount) <= 1) {
                $product->total_sell = $product->total_sell / number_format('1.0' . $product->discount, 2);
            } else {
                $product->total_sell = $product->total_sell / number_format('1.' . $product->discount, 2);
            }

            $product->save();
            $total += $product->total_sell;
            $totalMasIva += $product->total_sell;
        }

        $totalIva = $total + (($total * .16) / 100);

        $proveedores = WhitdrawalProvider::orderBy('name')->get();

        return view('proyectos.show', compact(
            'proyecto',
            'costoProyecto',
            'utilidad',
            'totalRetiros',
            'comision',
            'productos_subtotal',
            'productos_iva',
            'productos_total',
            'proveedores',

            'products',
            'total',
            'totalIva',
            'totalMasIva',
        ));
    }

    public function solicitarRetiro(Request $request)
    {
        $retiro = Whitdrawal::create($request->all());
        if ($retiro) {
            \Mail::send('email.retiro', ['retiro' => $retiro], function ($mail) {
                $mail->subject('Solicitud de retiro');
                $mail->from('dotechapp@dotredes.com', env('APP_NAME'));
                $mail->to(['rortuno@dotredes.com', 'mauricio2769@gmail.com']);
            });
            return redirect()->back()->with('message', 'Solicitud de retiro agreagada');
        } else {
            return redirect()->back()->with('message', 'Error al procesar la peticion');
        }
    }

    public function subirFacturaRetiro(Request $request)
    {
        $retiro = Whitdrawal::findOrFail($request->id);
        $file = $request->file('document');
        $name =  "FacturaRetiro_[" . $retiro->id . "]_" . \Str::random(8) . "_" . $file->getClientOriginalName();
        \Storage::disk('local')->put($name,  \File::get($file));
        $retiro->document = $name;
        $retiro->folio = $request->folio;
        if ($retiro->save()) {
            return redirect()->back()->with('message', 'El documento se almacenó con éxito con el nombre: ' . $retiro->document);
        } else {
            return redirect()->back()->with('message', 'Error al procesar la peticion');
        }
    }

    public function actualizarEstatus(Request $request)
    {
        $proyecto = Sale::findOrFail($request->sale_id);
        $proyecto->status = $request->status;
        switch ($request->status) {
            case 'Proyecto':
                $proyecto->project_at = date('Y-m-d H:i:s');
                break;
            case 'Finalizado':
                $proyecto->finished_at = date('Y-m-d H:i:s');
                $proyecto->closed_at = date('Y-m-d H:i:s');
                break;
                // case 'Pendiente':
                //     $proyecto->project_at = null;
                //     $proyecto->finished_at = null;
                //     break;
                // case 'Rechazada':
                //     $proyecto->project_at = null;
                //     $proyecto->finished_at = null;
                //     break;
        }

        if ($proyecto->save()) {
            return redirect()->back()->with('message', 'El registro se actualizó con éxito');
        } else {
            return redirect()->back()->with('message', 'Error al procesar la peticion');
        }
    }

    public function actualizarDescripcion(Request $request)
    {
        $proyecto = Sale::findOrFail($request->sale_id);
        $proyecto->description = $request->description;
        if ($proyecto->save()) {
            return redirect()->back()->with('message', 'El registro se actualizó con éxito');
        } else {
            return redirect()->back()->with('message', 'Error al procesar la peticion');
        }
    }
}
