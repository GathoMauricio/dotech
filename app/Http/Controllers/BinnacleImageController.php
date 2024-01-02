<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BinnacleImage;
use App\Binnacle;

class BinnacleImageController extends Controller
{
    public function index($id)
    {
        $images = BinnacleImage::where('binnacle_id', $id)->get();
        $json = [];
        foreach ($images as $image) {
            $json[] = [
                'id' => $image->id,
                'url' => getUrl() . '/storage/' . $image->image,
                'description' => $image->description,
                'date' => formatDate($image->created_at)
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
        $binnacle_image = BinnacleImage::create([
            'binnacle_id' => $request->binnacle_id,
            'description' => $request->description,
        ]);
        if ($binnacle_image) {
            $file = $request->file('image');
            $name =  "Binnacle[" . $binnacle_image->id . "_" . $binnacle_image->binnacle_id . "]_" . \Str::random(8) . "_" . $file->getClientOriginalName();
            $img = \Image::make($file);
            $img = $img->widen(intdiv($img->width(), 4));
            $img->save('storage/' . $name, 60);
            //\Storage::disk('local')->put($name,  \File::get($file));
            $binnacle_image->image = $name;
            $binnacle_image->save();
            $msg = "Subió una imagen a la bitácora " . $binnacle_image->binnacle['description'];
            createSysLog($msg);
            $notificationUsers = \App\User::where('rol_user_id', 1)->get();
            // foreach($notificationUsers as $user)
            // {
            //     event(new \App\Events\NotificationEvent([
            //         'id' => $user->id,
            //         'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
            //         'route' => route('show_binnacle_image',$binnacle_image->id)
            //     ]));
            // }

            return redirect()->back()->with('message', 'La imagen ' . $binnacle_image->description . ' se cargó con exito');
        } else {
            "Error durante la carga";
        }
    }
    public function show($id)
    {
        $image = BinnacleImage::findOrFail($id);
        return view('sale.show_binnacle_image', ['image' => $image]);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $image = BinnacleImage::findOrFail($id);
        $image->description = $request->description;
        $image->save();

        $msg = "Actualizó una imagen de la bitácora " . $image->binnacle['description'];
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id', 1)->get();
        foreach ($notificationUsers as $user) {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name . ' ' . \Auth::user()->middle_name . ' ' . $msg,
                'route' => route('show_binnacle_image', $image->id)
            ]));
        }

        return redirect()->back()->with('message', 'La imagen se actualizó con éxito');
    }
    public function destroy($id)
    {
        $image = BinnacleImage::findOrFail($id);
        if (\Storage::get($image->image)) {
            \Storage::disk('local')->delete($image->image);
        }

        $msg = "Eliminó una imagen de la bitácora " . $image->binnacle['description'];
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id', 1)->get();
        foreach ($notificationUsers as $user) {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name . ' ' . \Auth::user()->middle_name . ' ' . $msg,
                'route' => route('index_binnacle')
            ]));
        }

        $image->delete();
        return redirect()->back()->with('message', 'La imagen se eliminó con éxito');
    }

    public function binnacleImages($id)
    {
        $images = BinnacleImage::where('binnacle_id', $id)->get();
        $urls = [];
        foreach ($images as $image) {
            $urls[] = getUrl() . '/storage/' . $image->image;
        }
        return view('binnacles.images', ['urls' => $urls]);
    }
}
