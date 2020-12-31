<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sale;
use App\SalePayment;
class SalePaymentController extends Controller
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
        $sale = Sale::findOrFail($request->sale_id);
        $file = $request->file('document');
        $name =  "SalePayment_[".$sale->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
        \Storage::disk('local')->put($name,  \File::get($file));
        $salePayment = SalePAyment::create([
            'sale_id' => $request->sale_id,
            'description' => $request->description,
            'document' => $name,
            'amount' => $request->amount
        ]);
        return redirect()->back()->with('message', 'El pago se agregó correctamente con el comprobante: '.$salePayment->document);
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
