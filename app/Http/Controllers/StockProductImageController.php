<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockProductImage;

class StockProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = StockProductImage::create([
            'stock_product_id' => $request->stock_product_id,
            'description' => $request->description,
        ]);

        if($image)
        {
            $file = $request->file('image');
            $name =  "StockProductImage[".$image->id."_".$image->stock_product_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $image->image = $name;
            $image->save();
            createSysLog("Subió una imagen al producto ".$image->product['product']);
            return redirect()->back()->with('message', 'La imagen '.$image->description.' se cargó con exito');
        }else{ "Error durante la carga"; }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = StockProductImage::findOrFail($id);
        if(\Storage::get($image->image)){
            \Storage::disk('local')->delete($image->image);
        }

        $msg = "Eliminó una imagen del producto ".$image->product['product'];
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('stock_product_edit',$image->product['id'])
            ]));
        }

        $image->delete();
        return redirect()->back()->with('message', 'La imagen se eliminó con éxito');
    }
}
