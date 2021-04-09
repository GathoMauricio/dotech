<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reception;

class ApiReceptionController extends Controller
{
    public function index()
    {
        if(\Auth::user()->rol_user_id == 1)
        {
            $receptions = Reception::orderBy('created_at','DESC')->get();
        }else{
            $receptions = Reception::where('author_id',\Auth::user()->id)->orderBy('created_at','DESC')->get();
        }
        $json = [];
        foreach($receptions as $reception)
        {
            $json[] = [
                'company' => $reception->company['name'],
                'author' => $reception->author['name'].' '.$reception->author['middle_name'].' '.$reception->author['last_name'],
                'responsable' => $reception->responsable,
                'phone' => $reception->phone,
                'email' => $reception->email,
                'equipment' => $reception->equipment,
                'description' => $reception->description,
                'observation' => $reception->observation,
                'diagnostic' => $reception->diagnostic,
                'date' => formatDate($reception->created_at)
            ];
        }
        return $json;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $reception = Reception::create($request->all());
        if($reception)
        {
            createSysLog("agregó una recepción de equipo: " . $reception->description);
            return [
                'error' => 0,
                'reception_id' => $reception->id,
                'msg' => "La recepción del equipo se creó correctamente."
            ];
        }else{
            return [
                'error' => 1,
                'msg' => "Error al crear la recepción del equipo, por favor intente de nuevo."
            ];
        }
    }

    public function show($id)
    {
        $reception = Reception::findOrFail($id);
        return $reception;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $reception = Reception::findOrFail($id);
        $reception->fill($request->all())->save();
        createSysLog("actualizó la recepción de equipo: " . $reception->description);
    }

    public function destroy($id)
    {
        //
    }
}
