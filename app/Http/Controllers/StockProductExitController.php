<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockProductExit;
use App\StockProduct;

class StockProductExitController extends Controller
{
    public function index($id)
    {
        $product = StockProduct::findOrFail($id);
        $exits = StockProductExit::where('stock_product_id', $id)->get();
        return view('stock_product_exit.index',['product' => $product, 'exits' => $exits]);
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
        $exit = StockProductExit::findOrFail($id);
        $exit->delete();return redirect()->back()->with('message','Registro eliminado.');
    }
}
