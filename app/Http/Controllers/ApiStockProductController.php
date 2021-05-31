<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockProduct;
use App\StockProductImage;

class ApiStockProductController extends Controller
{
    public function index()
    {
        $products = StockProduct::orderBy('product')->get();
        $json = [];
        foreach( $products as $product)
        {
            $image = StockProductImage::where('stock_product_id',$product->id)->orderBy('created_at', 'desc')->first();
            if($image)
            {
                $image = $image->image;
            }else{
                $image = "product_stock.png";
            }
            $json[] = [
                'id' => $product->id,
                'category' => $product->category['name'],
                'product' => $product->product,
                'description' => $product->description,
                'quantity' => $product->quantity,
                'image' => getUrl().'/storage/'.$image,
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
        $product = StockProduct::create($request->all());
        if ($product) {
            //storeImage
            if (!empty($request->image)) {
                $file = $request->file('image');
                $name =  "StockProduct_[" . $product->id . "]_" . \Str::random(8) . "_" . $file->getClientOriginalName();
                \Storage::disk('local')->put($name,  \File::get($file));
                $product->image = $name;
                $product->save();
            }
            return $product;
        }
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
        //
    }
}
