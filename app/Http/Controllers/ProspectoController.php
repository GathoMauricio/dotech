<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\ClienteOrigen;
use App\CompanyDepartment;
use App\CompanyFollow;

class ProspectoController extends Controller
{
    public function index()
    {
        $prospectos = Company::where('status', 'Prospecto')->orderBy('created_at', 'DESC')->paginate(15);
        $prospectos_all = Company::where('status', 'Prospecto')->orderBy('name')->get();
        if (\Auth::user()->rol_user_id == 5) {
            $prospectos = Company::where('status', 'Prospecto')->where('author_id', \Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(15);
            $prospectos_all = Company::where('status', 'Prospecto')->where('author_id', \Auth::user()->id)->orderBy('name')->get();
        }
        $origenes = ClienteOrigen::orderBy('origen')->get();
        $users =  User::get();
        $autores = [];
        foreach (User::get() as $user) {
            if ($user->hasRole('Administrador') || $user->hasRole('Gerente de venta') || $user->hasRole('Vendedor')) {
                $autores[] = $user;
            }
        }
        return view('prospectos.index', compact('prospectos', 'origenes', 'prospectos_all', 'autores'));
    }

    public function store(Request $request)
    {
        $prospecto = Company::create([
            'origin' => $request->origin,
            'name' => $request->name,
            'responsable' => $request->responsable,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => 'Prospecto',
            'porcentaje' => $request->porcentaje,
            'author_id' => \Auth::user()->id,
            'vendedor_id' => \Auth::user()->id,
        ]);
        $departamento =  CompanyDepartment::create([
            'company_id' => $prospecto->id,
            'name' => $prospecto->name,
            'manager' => $prospecto->responsable,
            'email' => $prospecto->email,
            'phone' => $prospecto->phone,
        ]);
        if ($prospecto && $departamento) {
            return redirect()->back()->with('message', 'Registro creado.');
        } else {
            return redirect()->back()->with('message', 'Error al crear el registro.');
        }
    }

    public function ajaxShowProspecto(Request $request)
    {
        $prospecto = Company::find($request->prospecto_id);
        return response()->json($prospecto);
    }

    public function update(Request $request)
    {
        $prospecto = Company::find($request->prospecto_id);
        if ($prospecto->update($request->all())) {
            return redirect()->back()->with('message', 'Registro actualizado.');
        } else {
            return redirect()->back()->with('message', 'Error al actualizar el registro.');
        }
    }

    public function ajaxOpenSeguimientos(Request $request)
    {
        $seguimientos = CompanyFollow::where('company_id', $request->prospecto_id)->with('author')->orderBy('id', 'DESC')->get();
        return response()->json($seguimientos);
    }

    public function ajaxStoreSeguimientoProspecto(Request $request)
    {
        $seguimiento = CompanyFollow::create([
            'author_id' => \Auth::user()->id,
            'company_id' => $request->prospecto_id,
            'body' => $request->body,
            'tipo_seguimiento' => $request->tipo_seguimiento
        ]);
        if ($seguimiento) {
            return $this->ajaxOpenSeguimientos($request);
        } else {
            return "Error";
        }
    }

    public function destroy(Request $request)
    {
        $prospecto = Company::find($request->prospecto_id);
        if ($prospecto->delete()) {
            return "Registro eliminado";
        }
    }
}
