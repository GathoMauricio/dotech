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
        return view('clientes.show', compact('cliente'));
    }
}
