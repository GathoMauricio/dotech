<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

class ConfigController extends Controller
{
    public function index()
    {
        $user = User::find(\Auth::user()->id);
        $anios = Carbon::parse($user->fecha_contrato)->age;
        $user['anios'] = $anios;
        $user['dias_obtenidos'] = $anios * 12;
        $user['dias_tomados'] = $user->vacaciones->where('estatus', 'aprobado')->pluck('dias')->sum();
        $user['dias_restantes'] = $user['dias_obtenidos'] - $user['dias_tomados'];
        return view('config.index', compact('user'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
