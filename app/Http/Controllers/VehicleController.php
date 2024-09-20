<?php

namespace App\Http\Controllers;

use App\InventarioVehiculo;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleType;
use App\Maintenance;
use App\MaintenanceImage;
use App\VehicleImage;
use App\VehicleHistory;
use App\VehicleVerification;
use App\VehicleDocument;

class VehicleController extends Controller
{
    public function index()
    {
        if (\Auth::user()->rol_user_id == 1) {
            $vehicles = Vehicle::paginate(15);
        } else {
            $vehicles = Vehicle::where('visibility', 'publica')->paginate(15);
        }
        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create()
    {
        $vehicleTypes = VehicleType::orderBy('type')->get();
        return view('vehicles.create', ['vehicleTypes' => $vehicleTypes]);
    }

    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->all());
        if ($vehicle) {

            $msg = "agregó el vehículo " . $vehicle->brand . " " . $vehicle->model;
            createSysLog($msg);
            $notificationUsers = \App\User::where('rol_user_id', 1)->get();
            foreach ($notificationUsers as $user) {
                event(new \App\Events\NotificationEvent([
                    'id' => $user->id,
                    'msg' => \Auth::user()->name . ' ' . \Auth::user()->middle_name . ' ' . $msg,
                    'route' => route('wire_vehicles')
                ]));
            }

            return redirect()->route('wire_vehicles')->with('message', 'El vehículo ' . $vehicle->brand . " " . $vehicle->model . " se ha creado corréctamente.");
        }
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicleImages = VehicleImage::where('vehicle_id', $id)->orderBy('created_at', 'DESC')->get();
        $maintenances = Maintenance::where('vehicle_id', $id)->orderBy('date', 'DESC')->get();
        $vehicleHistories = VehicleHistory::where('vehicle_id', $id)->orderBy('id', 'DESC')->get();
        $verifications = VehicleVerification::where('vehicle_id', $id)->orderBy('date', 'DESC')->get();
        $documents = VehicleDocument::where('vehicle_id', $id)->orderBy('created_at', 'DESC')->get();
        $inventarios = InventarioVehiculo::where('vehiculo_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('vehicles.show', [
            'vehicle' => $vehicle,
            'vehicleImages' => $vehicleImages,
            'maintenances' => $maintenances,
            'vehicleHistories' => $vehicleHistories,
            'verifications' => $verifications,
            'documents' => $documents,
            'inventarios' => $inventarios,
        ]);
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicleTypes = VehicleType::orderBy('type')->get();
        return view('vehicles.edit', ['vehicle' => $vehicle, 'vehicleTypes' => $vehicleTypes]);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->fill($request->all())->save();

        $msg = "actualizó el vehículo " . $vehicle->brand . " " . $vehicle->model;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id', 1)->get();
        foreach ($notificationUsers as $user) {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name . ' ' . \Auth::user()->middle_name . ' ' . $msg,
                'route' => route('vehicle_show', $vehicle->id)
            ]));
        }

        return redirect()->route('wire_vehicles')->with('message', 'El vehículo ' . $vehicle->brand . " " . $vehicle->model . " se actualizó corréctamente.");
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $imagesVehicle = VehicleImage::where('vehicle_id', $id)->get();
        foreach ($imagesVehicle as $image) {
            if (\Storage::get($image->image)) {
                \Storage::disk('local')->delete($image->image);
            }
            $image->delete();
        }
        $maintenances = Maintenance::where('vehicle_id', $id)->get();
        foreach ($maintenances as $maintenance) {
            $imagesMaintenance = MaintenanceImage::where('vehicle_id', $maintenance->id);
            foreach ($imagesMaintenance as $image) {
                if (\Storage::get($image->image)) {
                    \Storage::disk('local')->delete($image->image);
                }
                $image->delete();
            }
            $maintenance->delete();
        }

        $msg = "eliminó el vehículo " . $vehicle->brand . " " . $vehicle->model;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id', 1)->get();
        foreach ($notificationUsers as $user) {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name . ' ' . \Auth::user()->middle_name . ' ' . $msg,
                'route' => route('wire_vehicles')
            ]));
        }

        $vehicle->delete();
        return redirect()->route('wire_vehicles')->with('message', 'El vehículo ' . $vehicle->brand . " " . $vehicle->model . " se eliminó corréctamente.");
    }

    public function pdfInventario($id)
    {
        $inventario = InventarioVehiculo::find($id);
        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        $pdf = \PDF::loadView(
            'pdf.inventario',
            [
                'logo' => $logo,
                'inventario' => $inventario
            ]
        );
        return $pdf->stream('inventario_' . $inventario->id . '.pdf');
    }

    public function mantenimientosPdf($id)
    {
        $vehiculo = Vehicle::find($id);

        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        $pdf = \PDF::loadView(
            'pdf.mantenimientos',
            [
                'logo' => $logo,
                'vehiculo' => $vehiculo,
            ]
        );
        return $pdf->stream('Mantenimientos_' . $vehiculo->brand . '_' . $vehiculo->model . '_' . $vehiculo->enrollment . '.pdf');
    }
}
