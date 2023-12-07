<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BinnacleImage;

class BitacoraController extends Controller
{
    public function ajaxIndex(Request $request)
    {
        $imagenes = BinnacleImage::where('binnacle_id', $request->bitacora_id)->get();
        return response()->json([
            'cantidad' => count($imagenes),
            'imagenes' => $imagenes,
        ]);
    }
}
