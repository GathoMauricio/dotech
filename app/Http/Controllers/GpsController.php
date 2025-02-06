<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GpsController extends Controller
{
    public function update(Request $request)
    {
        \Storage::disk('public')->put('gps/data_gps.txt', $request);
    }

    public function download()
    {
        return response()->download(storage_path('app/public/gps/data_gps.txt'));
    }
}
