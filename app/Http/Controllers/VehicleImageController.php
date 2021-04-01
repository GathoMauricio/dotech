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

        $msg = "agregó una imagen al vehículo ".$vehicle_image->vehicle['brand']." ".$vehicle_image->vehicle['model'];
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('vehicle_show',$vehicle_image->vehicle['id'])
            ]));
        }

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
        $vehicle_image = VehicleImage::findOrFail($id);
        if(\Storage::get($vehicle_image->image)){
            \Storage::disk('local')->delete($vehicle_image->image);
        }

        $msg = "eliminó una imagen del vehículo ".$vehicle_image->vehicle['brand']." ".$vehicle_image->vehicle['model'];
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('vehicle_show',$vehicle_image->vehicle['id'])
            ]));
        }

        $vehicle_image->delete();
        return redirect()->back()->with('message', 'La imagen  se eliminó con exito');
    }
}
