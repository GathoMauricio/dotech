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
            'measure' => $request->measure,
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
        $msg_user_id=0;
        $msg = 'ha agregado el producto: '.$newProduct->description.' a la cotización: '.$sale->description;
        $msg_route=route('quote_products',$sale->id);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        createSysLog($msg);
        foreach($notificationUsers as $user)
        {
            $msg_user_id=$user->id;
            event(new \App\Events\NotificationEvent([
                'id' => $msg_user_id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => $msg_route
            ]));
        }
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
        $product->measure = $request->measure;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount;
        $product->unity_price_sell = $request->unity_price_sell;
        $product->total_sell = ($request->quantity * $request->unity_price_sell);
        $product->save();

        $msg_user_id=0;
        $msg = 'ha actualizado el producto: '.$product->description.' de la cotización: '.$product->sale['description'];
        $msg_route=route('quote_products',$product->sale['id']);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        createSysLog($msg);
        foreach($notificationUsers as $user)
        {
            $msg_user_id=$user->id;
            event(new \App\Events\NotificationEvent([
                'id' => $msg_user_id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => $msg_route
            ]));
        }

        return redirect()->route('quote_products',$request->sale_id)->with('message', 'Producto actualizado');
    }
    public function destroy($id)
    {
        
        $product = ProductSale::findOrFail($id);


        $msg_user_id=0;
        $msg = 'ha eliminado el producto: '.$product->description.' de la cotización: '.$product->sale['description'];
        $msg_route=route('quote_products',$product->sale['id']);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        createSysLog($msg);
        foreach($notificationUsers as $user)
        {
            $msg_user_id=$user->id;
            event(new \App\Events\NotificationEvent([
                'id' => $msg_user_id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => $msg_route
            ]));
        }


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
