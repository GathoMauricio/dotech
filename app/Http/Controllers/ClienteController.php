<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\ClienteOrigen;
use App\User;
use App\MailingLista;
use App\ClienteListaPivot;

class ClienteController extends Controller
{
    public function index()
    {
        $data = Company::where('status', 'Cliente')->orderBy('created_at', 'DESC');
        if (\Auth::user()->rol_user_id == 5) {
            $data = Company::where('status', 'Cliente')->where('vendedor_id', \Auth::user()->id)->orderBy('created_at', 'DESC');
        }
        $clientes_all = $data->get();
        $clientes = $data->paginate(15);
        $origenes = ClienteOrigen::orderBy('origen')->get();
        $vendedores = [];
        foreach (User::get() as $user) {
            if ($user->hasRole('Administrador') || $user->hasRole('Gerente de venta') || $user->hasRole('Vendedor')) {
                $vendedores[] = $user;
            }
        }
        $autores = [];
        foreach (User::get() as $user) {
            if ($user->hasRole('Administrador') || $user->hasRole('Gerente de venta') || $user->hasRole('Vendedor')) {
                $autores[] = $user;
            }
        }
        return view('clientes.index', compact('clientes', 'clientes_all', 'origenes', 'vendedores', 'autores'));
    }

    public function show($id)
    {
        $cliente = Company::findOrFail($id);
        $origenes = ClienteOrigen::orderBy('origen')->get();
        $vendedores = [];
        $listas = MailingLista::orderBy('nombre')->get();
        foreach (User::get() as $user) {
            if ($user->hasRole('Administrador') || $user->hasRole('Gerente de venta') || $user->hasRole('Vendedor')) {
                $vendedores[] = $user;
            }
        }
        return view('clientes.show', compact('cliente', 'origenes', 'vendedores', 'listas'));
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

    public function destroy($id)
    {
        $cliente = Company::findOrFail($id);
        $status = $cliente->status;
        if ($cliente->delete()) {
            if ($status == 'Prospecto')
                return redirect('prospecto_index')->with('message', 'El ' . $status . ' ha sido eliminado');
            else
                return redirect('clientes')->with('message', 'El ' . $status . ' ha sido eliminado');
        }
    }

    public function editarVendedorCliente($cliente_id, $vendedor_id)
    {
        $cliente = Company::findOrFail($cliente_id);
        $cliente->vendedor_id = $vendedor_id;
        if ($cliente->save()) {
            return response()->json([
                'error' => 0,
                'msg' => 'Vendedor actualizado'
            ]);
        }
    }

    public function anadirLista(Request $request)
    {
        $cliente = Company::findOrFail($request->cliente_id);
        if (!in_array($request->lista_id, $cliente->listas->pluck('lista_id')->toArray())) {
            $pivot = ClienteListaPivot::create([
                'lista_id' => $request->lista_id,
                'cliente_id' => $request->cliente_id,
            ]);
            return redirect()->back()->with('message', 'Se agregó a la lista correctamente.');
        } else {
            return redirect()->back()->with('message', 'Ya se encuentra registrado en esta lista.');
        }
    }

    public function removerLista($cliente_id, $lista_id)
    {
        $pivot = ClienteListaPivot::where('cliente_id', $cliente_id)->where('lista_id', $lista_id);
        if ($pivot->delete()) {
            return redirect()->back()->with('message', 'Se removió de la lista correctamente.');
        }
    }
}
