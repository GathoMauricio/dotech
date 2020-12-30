<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProductSale;
class ProductSaleController extends Controller
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
        $product = ProductSale::create([
            'sale_id' => $request->sale_id,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'unity_price_sell' => $request->unity_price_sell,
            'total_sell' => ($request->quantity * $request->unity_price_sell)
        ]);
        return redirect()->back()->with('message', 'Producto agregado');
    }
    public function show($id)
    {
        //
    }
    public function showAjax(Request $request){
        $product = ProductSale::findOrFail($request->id);
        return $product;
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request)
    {
        $product = ProductSale::findOrFail($request->id);
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount;
        $product->unity_price_sell = $request->unity_price_sell;
        $product->total_sell = ($request->quantity * $request->unity_price_sell);
        $product->save();
        return redirect()->route('quote_products',$request->sale_id)->with('message', 'Producto actualizado');
    }
    public function destroy($id)
    {
        //
    }
}
