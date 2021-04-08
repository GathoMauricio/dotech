<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VehicleHistory;
use App\VehicleHistoryImage;

class VehicleHistoryController extends Controller
{
    public function index()
    {
        //
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
        $history = VehicleHistory::findOrFail($id);
        $images = VehicleHistoryImage::where('vehicle_history_id',$history->id)->get();
        return view('vehicle_histories.show',['history' => $history, 'images' => $images]);
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
