<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleType;
use App\Maintenance;

use App\VehicleImage;
class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::paginate(15);
        return view('vehicles.index',['vehicles' => $vehicles]);
    }

    public function create()
    {
        $vehicleTypes = VehicleType::orderBy('type')->get();
        return view('vehicles.create',['vehicleTypes' => $vehicleTypes]);
    }

    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->all());
        if($vehicle)
        {
            return redirect()->route('vehicle_index')->with('message', 'El vehículo '.$vehicle->brand." ".$vehicle->model." se ha creado corréctamente.");
        }
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicleImages = VehicleImage::where('vehicle_id',$id)->get();
        $maintenances = Maintenance::where('vehicle_id',$id)->get();
        return view('vehicles.show',[
            'vehicle' => $vehicle,
            'vehicleImages' => $vehicleImages,
            'maintenances' => $maintenances
            ]);
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicleTypes = VehicleType::orderBy('type')->get();
        return view('vehicles.edit',['vehicle' => $vehicle,'vehicleTypes' => $vehicleTypes]);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->fill($request->all())->save();
        return redirect()->route('vehicle_index')->with('message','El vehículo '.$vehicle->brand." ".$vehicle->model." se actualizó corréctamente.");
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $images = VehicleImage::where('vehicle_id', $id);
        $maintenances = Maintenance::where('vehicle_id',$id);
        #TODO:delete maintenance images
        $vehicle->delete();
        $images->delete();
        $maintenances->delete();
        return redirect()->route('vehicle_index')->with('message','El vehículo '.$vehicle->brand." ".$vehicle->model." se eliminó corréctamente.");
    }
}
