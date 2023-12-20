<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Whitdrawal;

class RetiroController extends Controller
{
    public function destroy($id)
    {
        $retiro = Whitdrawal::findOrFail($id);
        if ($retiro->delete()) {
            return redirect()->back()->with('message', 'El registro se eliminó con éxito');
        } else {
            return redirect()->back()->with('message', 'Error al procesar la peticion');
        }
    }
}
