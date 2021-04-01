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

        $msg = "agregó una imagen al mantenimiento de ".$maintenance_image->maintenance->type['type']." para el vehículo ".$maintenance_image->maintenance->vehicle['brand'].' '.$maintenance_image->maintenance->vehicle['model'];
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('maintenance_show',$maintenance_image->maintenance_id)
            ]));
        }

        if($maintenance_image)
        {
            $file = $request->file('image');
            $name =  "VehicleImage[".$maintenance_image->id."_".$maintenance_image->vehicle_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $maintenance_image->image = $name;
            $maintenance_image->save();
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
        $maintenance_image = MaintenanceImage::findOrFail($id);
        if(\Storage::get($maintenance_image->image)){
            \Storage::disk('local')->delete($maintenance_image->image);
        }

        $msg = "eliminó una imagen del mantenimiento de ".$maintenance_image->maintenance->type['type']." para el vehículo ".$maintenance_image->maintenance->vehicle['brand'].' '.$maintenance_image->maintenance->vehicle['model'];
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('maintenance_show',$maintenance_image->maintenance_id)
            ]));
        }

        $maintenance_image->delete();
        return redirect()->back()->with('message', 'La imagen  se eliminó con exito');
    }
}
