<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockProductImage;

class ApiStockProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $images = StockProductImage::where('stock_product_id',$id)->get();
        $json = [];
        foreach($images as $image)
        {
            $json[] = [
                'author' => $image->author['name'].' '.$image->author['middle_name'].' '.$image->author['last_name'],
                'date' => formatDate($image->created_at),
                'image' => getUrl().'/storage/'.$image->image,
                'description' => $image->description
            ];
        }
        return $json;
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
            $name =  "Stock_Product_api[".$image->id."_".$image->binnacle_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            $img = \Image::make($file);
            $img = $img->widen(intdiv($img->width() , 4));
            $img->save('storage/'.$name, 60);
            //\Storage::disk('local')->put($name,  \File::get($file));
            $image->image = $name;
            $image->save();
            return "Imagen almacenada";
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
        //
    }


}
