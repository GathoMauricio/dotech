<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
// use App\ProductSale;
// use App\Whitdrawal;
// use App\SalePayment;
// use App\SaleDocument;
// use App\Binnacle;

class ProyectoController extends Controller
{
    public function show($id)
    {
        $proyecto =  Sale::findOrFail($id);
        //$sale = Sale::findOrFail($id);
        //$products = ProductSale::where('sale_id', $id)->get();
        //$whitdrawals = Whitdrawal::where('sale_id', $id)->where('status', 'Aprobado')->get();
        //$payments = SalePayment::where('sale_id', $id)->get();
        //$documnets = SaleDocument::where('sale_id', $id)->get();
        //$binnacles = Binnacle::where('sale_id', $id)->get();

        $estimado = 0;
        foreach ($proyecto->productos as $producto) {
            $estimado += $producto->unity_price_sell * $producto->quantity;
        }

        $proyecto->estimated = $estimado;
        $proyecto->iva = ($estimado + ($estimado * 0.16)) - $estimado;
        $proyecto->save();
        $totalRetiros = 0;
        foreach ($proyecto->retiros as $retiro) {
            $totalRetiros += floatval($retiro->quantity);
        }

        $costoProyecto = number_format($proyecto->estimated + ($proyecto->estimated * 0.16), 2);
        $utilidad = number_format($proyecto->estimated + ($proyecto->estimated * 0.16) - $totalRetiros, 2);
        $comision = ($proyecto->estimated + ($proyecto->estimated * 0.16) - $totalRetiros) / 1.16;
        $comision = number_format($comision * ($proyecto->commision_percent / 100), 2);

        $proyecto->utility = $utilidad;
        $proyecto->save();
        // $totalSell = 0;
        // foreach ($proyecto->retiros as $retiro) {
        //     if ($retiro->status == 'Aprobado') {
        //         $totalSell += $retiro->quantity;
        //     }
        // }
        // $grossProfit = 0;
        // $grossNoIvaProfit = 0;
        // $commision = 0;
        // $grossNoIvaProfitNoCommision = 0;

        $productos_subtotal = $proyecto->productos->sum('total_sell');
        $productos_iva = ($productos_subtotal * 16) / 100;
        $productos_total = ($productos_subtotal + $productos_iva);

        return view('proyectos.show', compact(
            'proyecto',
            'costoProyecto',
            'utilidad',
            'totalRetiros',
            'comision',
            'productos_subtotal',
            'productos_iva',
            'productos_total'
        ));
        // return view('proyectos.show', [
        //     //'sale' => $sale,
        //     'proyecto' => $proyecto,
        //     //'products' => $products,
        //     //'whitdrawals' => $whitdrawals,
        //     //'payments' => $payments,
        //     //'documents' => $documnets,
        //     //'binnacles' => $binnacles,

        //     'costoProyecto' => $costoProyecto,
        //     'utilidad' => $utilidad,
        //     'totalRetiros' => $totalRetiros,
        //     'comision' => $comision,

        //     //'totalSell' => $totalSell,
        //     //'grossProfit' => $grossProfit,
        //     //'grossNoIvaProfit' => $grossNoIvaProfit,
        //     //'commision' => $commision,
        //     //'grossNoIvaProfitNoCommision' => $grossNoIvaProfitNoCommision
        // ]);
    }
}
