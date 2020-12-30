<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sale;
use App\SaleDocument;
class SaleDocumnetController extends Controller
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
        $name =  "SaleDocument_[".$sale->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
        \Storage::disk('local')->put($name,  \File::get($file));
        $saleDocument = SaleDocument::create([
            'sale_id' => $request->sale_id,
            'description' => $request->description,
            'document' => $name,
            'inner_identifier' => $request->inner_identifier
        ]);
        return redirect()->back()->with('message', 'El documento se agregó correctamente con el nombre: '.$saleDocument->document);
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
