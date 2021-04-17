<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockProduct;
use App\StockProductCategory;

class StockProductController extends Controller
{
    public function index()
    {
        $products = StockProduct::orderBy('product')->get();
        return view('stock_products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = StockProductCategory::orderBy('name')->get();
        return view('stock_products.create', ['categories' => $categories]);
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
            return redirect()->route('stock_product_index')->with('message', 'Registro almacenado.');
        }
    }

    public function show($id)
    {
        $product = StockProduct::findOrFail($id);
        return view('stock_products.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = StockProduct::findOrFail($id);
        $categories = StockProductCategory::orderBy('name')->get();
        return view('stock_products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $product = StockProduct::findOrFail($id);
        if (!empty($request->image)) {
            if ($product->image != 'product_stock.png') {
                if (\Storage::get($product->image)) {
                    \Storage::disk('local')->delete($product->image);
                }
            }
            $file = $request->file('image');
            $name =  "StockProduct_[" . $product->id . "]_" . \Str::random(8) . "_" . $file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $product->image = $name;
            $product->save();

        }
        $product->fill($request->except(['image']))->save();
        return redirect()->route('stock_product_index')->with('message', 'Registro actualizado.');
    }

    public function destroy($id)
    {
        $product = StockProduct::findOrFail($id);
        if ($product->image != 'product_stock.png') {
            if (\Storage::get($product->image)) {
                \Storage::disk('local')->delete($product->image);
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Registro actualizado.');
    }
}
