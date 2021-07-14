<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockProductExit;
use App\StockProduct;
use App\Sale;

class ApiStockProductExitController extends Controller
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
        $product = StockProduct::find($request->stock_product_id);
        if($request->quantity <= $product->quantity)
        {
            $exit = StockProductExit::create($request->all());
            if($exit)
            {
                $product->quantity = $product->quantity - $exit->quantity;
                $product->save();
                createSysLog("le dió salida al producto: ".$product->product.", Cant: ".$exit->quantity." para ".$exit->description);
                return [
                    'error' => 0,
                    'msg' => "El registro se creó correctamente.",
                    'new_quantity' => $product->quantity
                ];
            }
        }else{
            return [
                'error' => 1,
                'msg' => "La cantidad solicitada excede la cantidad existente."
            ];
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

    public function getActiveProjects(Request $request)
    {
        $projects = Sale::where('status','Proyecto')->orderBy('description')->get();
        //return json_encode($projects);
        return $projects;
    }
}
