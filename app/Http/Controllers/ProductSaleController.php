<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProductSale;
use App\Sale;
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
        $newProduct = ProductSale::create([
            'sale_id' => $request->sale_id,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'unity_price_sell' => $request->unity_price_sell,
            'total_sell' => ($request->quantity * $request->unity_price_sell)
        ]);
        $sale = Sale::findOrFail($request->sale_id);
        $products = ProductSale::where('sale_id', $sale->id)->get();
        $newEstimated=0;
        foreach($products as $product)
        {
            $newEstimated += $product->total_sell;
        }
        $sale->estimated = $newEstimated;
        $sale->iva = ($newEstimated * 16) / 100;
        $sale->save();
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
        
        $product = ProductSale::findOrFail($id);
        $lastId = $product->sale_id;
        $product->delete();

        $sale = Sale::findOrFail($lastId);
        $products = ProductSale::where('sale_id', $lastId)->get();
        $newEstimated=0;
        foreach($products as $product)
        {
            $newEstimated += $product->total_sell;
        }
        $sale->estimated = $newEstimated;
        $sale->iva = ($newEstimated * 16) / 100;
        $sale->save();

        return redirect()->back()->with('message', 'Producto eliminado');
    }
}
