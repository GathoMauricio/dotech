<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockProduct;
use App\StockProductCategory;

class ApiStockProductController extends Controller
{
    public function index()
    {
        $products = StockProduct::orderBy('product')->get();
        $json = [];
        foreach( $products as $product)
        {
            $json[] = [
                'id' => $product->id,
                'category' => $product->category['name'],
                'product' => $product->product,
                'description' => $product->description,
                'quantity' => $product->quantity,
                'image' => getUrl().'/storage/'.$product->image,
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
        //
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
