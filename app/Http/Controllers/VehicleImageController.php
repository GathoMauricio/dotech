<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\VehicleImage;
class VehicleImageController extends Controller
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
        $vehicle_image = VehicleImage::create([
            'vehicle_id' => $request->vehicle_id,
            'description' => $request->description,
        ]);
        if($vehicle_image)
        {
            $file = $request->file('image');
            $name =  "VehicleImage[".$vehicle_image->id."_".$vehicle_image->vehicle_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $vehicle_image->image = $name;
            $vehicle_image->save();
            createSysLog("Subió una imagen al vehículo ".$vehicle_image->vehicle['description']);
            return redirect()->back()->with('message', 'La imagen '.$vehicle_image->description.' se cargó con exito');
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
        $image = VehicleImage::findOrFail($id);
        if(\Storage::get($image->image)){
            \Storage::disk('local')->delete($image->image);
        }
        $image->delete();
        return redirect()->back()->with('message', 'La imagen  se eliminó con exito');
    }
}
