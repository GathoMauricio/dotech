<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\ClienteOrigen;
use App\CompanyDepartment;
use App\CompanyFollow;

class ClienteController extends Controller
{
    public function index()
    {
        $data = Company::where('status', 'Cliente')->orderBy('created_at', 'DESC');
        $clientes_all = $data->get();
        $clientes = $data->paginate(15);

        $origenes = ClienteOrigen::orderBy('origen')->get();
        return view('clientes.index', compact('clientes', 'clientes_all', 'origenes'));
    }

    public function show($id)
    {
        $cliente = Company::findOrFail($id);
        $origenes = ClienteOrigen::orderBy('origen')->get();
        return view('clientes.show', compact('cliente', 'origenes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'origin' => 'required',
            'porcentaje' => 'required',
            'name' => 'required',
            'responsable' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $cliente = Company::findOrFail($id);
        foreach ($cliente->cotizaciones_proyectos as $key => $historial) {
            $historial->commision_percent = $request->porcentaje;
            //$historial->commision_pay = 0; //Calcular porcentaje ganado
            $historial->save();
        }
        if ($cliente->update($request->all())) {
            return redirect()->back()->with('message', 'Registro actualizado.');
        } else {
            return redirect()->back()->with('message', 'Error al procesar petición.');
        }
    }
}
