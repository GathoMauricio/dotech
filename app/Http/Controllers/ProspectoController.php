<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\ClienteOrigen;
use App\CompanyDepartment;
use App\CompanyFollow;

class ProspectoController extends Controller
{
    public function index()
    {
        $prospectos = Company::where('status', 'Prospecto')->orderBy('created_at', 'DESC')->paginate(15);
        $origenes = ClienteOrigen::orderBy('origen')->get();
        return view('prospectos.index', compact('prospectos', 'origenes'));
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
