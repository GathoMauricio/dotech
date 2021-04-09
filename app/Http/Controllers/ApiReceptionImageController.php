<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReceptionImage;

class ApiReceptionImageController extends Controller
{
    public function index(Request $request)
    {
        $images = ReceptionImage::where('reception_id',$request->reception_id)->get();
        $json = [];
        foreach($images as $image)
        {
            $json[] = [
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
        $image = ReceptionImage::create([
            'reception_id' => $request->reception_id,
            'description' => $request->description,
        ]);
        if($image)
        {
            $file = $request->file('image');
            $name =  "ReceptionImage[".$image->id."_".$image->reception_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $image->image = $name;
            $image->save();
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
