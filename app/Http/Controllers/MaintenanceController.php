<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Maintenance;
use App\MaintenanceImage;
class MaintenanceController extends Controller
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
        $maintenance = Maintenance::create($request->all());
        if($maintenance)
        {
            return redirect()->back()->with('message', 'El mantenimiento para '.$maintenance->vehicle['brand'].' se creó con éxito.');
        }
    }

    public function show($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $images = MaintenanceImage::where('maintenance_id',$id)->get();
        return view('maintenances.show',['maintenance' => $maintenance, 'images' => $images]);
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        return view('maintenances.edit',['maintenance' => $maintenance]);
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->fill($request->all())->save();
        return redirect()->route('vehicle_show',$maintenance->vehicle['id'])->with('message', 'El mantenimiento se actualizó con éxito.');
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $images = MaintenanceImage::where('maintenance_id', $id)->get();
        foreach($images as $image){
            if(\Storage::get($image->image)){
                \Storage::disk('local')->delete($image->image);
            }
            $image->delete();
        }
        $maintenance->delete();
        return redirect()->route('vehicle_show',$maintenance->vehicle['id'])->with('message', 'El mantenimiento se eliminó con éxito.');
    }
}
