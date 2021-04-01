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

        $msg = "agregó el documento ".$saleDocument->description." al proyecto ".$sale->description;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('show_sale',$sale->id)
            ]));
        }

        return redirect()->back()->with('message', 'El documento '.$saleDocument->description.' se agregó correctamente');
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
