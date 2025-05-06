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
        $prospectos = new Company();

        $prospectos = $prospectos->where('status', 'Prospecto');
        $prospectos_all = Company::where('status', 'Prospecto')->orderBy('name')->get();

        if (\Auth::user()->rol_user_id == 5) {
            $prospectos = $prospectos->where('status', 'Prospecto')->where('vendedor_id', \Auth::user()->id);
            $prospectos_all = Company::where('status', 'Prospecto')->where('vendedor_id', \Auth::user()->id)->orderBy('name')->get();
        }

        if (request()->mira) {
            $prospectos = $prospectos->where('mira', request()->mira);
        }

        if (request()->esporadico) {
            $prospectos = $prospectos->where('esporadico', request()->esporadico);
        }

        if (request()->author_id) {
            $prospectos = $prospectos->where('author_id', request()->author_id);
        }

        $prospectos = $prospectos->orderBy('created_at', 'DESC')->get();

        $origenes = ClienteOrigen::orderBy('origen')->get();
        $users =  User::get();
        $autores = [];
        foreach (User::get() as $user) {
            if ($user->hasRole('Administrador') || $user->hasRole('Gerente de venta') || $user->hasRole('Vendedor')) {
                $autores[] = $user;
            }
        }

        $vendedores = [];
        foreach (User::get() as $user) {
            if ($user->hasRole('Administrador') || $user->hasRole('Gerente de venta') || $user->hasRole('Vendedor')) {
                $vendedores[] = $user;
            }
        }
        return view('prospectos.index', compact('prospectos', 'origenes', 'prospectos_all', 'autores', 'vendedores'));
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
            'web' => $request->web,
            'giro' => $request->giro,
        ]);
        CompanyFollow::create(
            [
                'company_id' => $prospecto->id,
                'author_id' => \Auth::user()->id,
                'body' => 'Nuevo propecto',
                'tipo_seguimiento' => 'Alta de prospecto',
            ]
        );
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

    public function cambiarMira(Request $request, $id)
    {
        $prospecto = Company::find($id);
        $prospecto->mira = $request->mira;
        $prospecto->save();
        return redirect()->back()->with('message', 'Registro actualizado.');
    }

    public function cambiarEsporadico(Request $request, $id)
    {
        $prospecto = Company::find($id);
        $prospecto->esporadico = $request->esporadico;
        $prospecto->save();
        return redirect()->back()->with('message', 'Registro actualizado.');
    }

    public function destroy(Request $request)
    {
        $prospecto = Company::find($request->prospecto_id);
        if ($prospecto->delete()) {
            return "Registro eliminado";
        }
    }
}
