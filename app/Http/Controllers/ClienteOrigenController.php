<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteOrigen;

class ClienteOrigenController extends Controller
{
    public function  ajaxStoreOrigen(Request $request)
    {
        $nuevoOrigen = ClienteOrigen::create([
            'author_id' => \Auth::user()->id,
            'origen' => $request->origen
        ]);
        $origenes = ClienteOrigen::orderBy('origen')->get();
        return response()->json($origenes);
    }
}
