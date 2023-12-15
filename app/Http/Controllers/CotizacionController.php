<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Sale;

class CotizacionController extends Controller
{
    public function store(Request $request, $id = null)
    {
        $request->validate([
            'description' => 'required',
            'delivery_days' => 'required',
            'shipping' => 'required',
            'payment_type' => 'required',
            'credit' => 'required',
            'department_id' => 'required',
            'currency' => 'required',
        ]);

        $ultimo = Sale::orderBy('id', 'DESC')->first(); //obtener el último registro
        $part = explode('-', $ultimo->folio_cotizacion); //separar el folio 

        $cotizacion = Sale::create($request->all()); //crear el nuevo registro
        $cotizacion->folio_cotizacion = 'COT-' . ($part[1] + 1); //asignar el nuevo folio
        $cotizacion->status = "Pendiente"; //Se especifica que será una cotizacion "Pendiente"

        if ($id) { //si el id del cliente viene en el 2do parametro se obtiene para sacar sus valores
            $cliente = Company::findOrFail($id);
            $cotizacion->company_id = $cliente->id; ///se asigna el id del cliente
            $cotizacion->commision_percent = $cliente->porcentaje; //se asigna el porcentaje del cliente
        }

        $cotizacion->save();
        return redirect()->route('quote_products', $cotizacion->id)->with('message', 'La cotización se creó con éxito ahora puede agregar productos.');
    }
}
