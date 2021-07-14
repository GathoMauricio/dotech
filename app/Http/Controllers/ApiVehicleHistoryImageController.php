<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VehicleHistoryImage;

class ApiVehicleHistoryImageController extends Controller
{
    public function index($id)
    {
        $images = VehicleHistoryImage::where('vehicle_history_id',$id)->get();
        $json = [];
        foreach($images as $image)
        {
            $json[] = [
                'author' => $image->author['name'].' '.$image->author['middle_name'].' '.$image->author['last_name'],
                'date' => formatDate($image->created_at),
                'image' => getUrl().'/storage/'.$image->image,
                'description' => $image->description
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
        $vehicle_history_image = VehicleHistoryImage::create([
            'vehicle_history_id' => $request->vehicle_history_id,
            'description' => $request->description,
        ]);
        if($vehicle_history_image)
        {
            $file = $request->file('image');
            $name =  "VehicleHistoryImage[".$vehicle_history_image->id."_".$vehicle_history_image->vehicle_history_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $vehicle_history_image->image = $name;
            $vehicle_history_image->save();
            return "Imagen almacenada";
        }else{ "Error durante la carga"; } 
        
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
