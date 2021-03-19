<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\MaintenanceImage;
class MaintenanceImageController extends Controller
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
        $maintenance_image = MaintenanceImage::create([
            'maintenance_id' => $request->maintenance_id,
            'description' => $request->description,
        ]);
        if($maintenance_image)
        {
            $file = $request->file('image');
            $name =  "VehicleImage[".$maintenance_image->id."_".$maintenance_image->vehicle_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $maintenance_image->image = $name;
            $maintenance_image->save();
            createSysLog("Subió una imagen al mantenimiento ".$maintenance_image->maintenance['description']);
            return redirect()->back()->with('message', 'La imagen '.$maintenance_image->description.' se cargó con exito');
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
        $image = MaintenanceImage::findOrFail($id);
        if(\Storage::get($image->image)){
            \Storage::disk('local')->delete($image->image);
        }
        $image->delete();
        return redirect()->back()->with('message', 'La imagen  se eliminó con exito');
    }
}
