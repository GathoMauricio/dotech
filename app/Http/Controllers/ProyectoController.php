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
            'proveedores'
        ));
    }

    public function solicitarRetiro(Request $request)
    {
        $retiro = Whitdrawal::create($request->all());
        if ($retiro) {
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
}
