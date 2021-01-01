<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\WhitdrawalProvider;
class WhitdrawalProviderController extends Controller
{
    public function index()
    {
        $whitdrawals = WhitdrawalProvider::orderBy('name')->get();
        return view('providers.index',['whitdrawals' => $whitdrawals]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        WhitdrawalProvider::create($request->all());
        return redirect()->back()->with('message', 'El proveedor se agregó correctamente');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $whitdrawal = WhitdrawalProvider::findOrFail($id);
        return view('providers.edit',['whitdrawal' => $whitdrawal]);
    }
    public function update(Request $request, $id)
    {
        $whitdrawal = WhitdrawalProvider::findOrFail($id);
        $whitdrawal->name = $request->name;
        $whitdrawal->bank = $request->bank;
        $whitdrawal->account = $request->account;
        $whitdrawal->pay_type = $request->pay_type;
        $whitdrawal->rfc = $request->rfc;
        $whitdrawal->address = $request->address;
        $whitdrawal->manager = $request->manager;
        $whitdrawal->phone = $request->phone;
        $whitdrawal->save();
        return redirect()->back()->with('message', 'El proveedor se actualizó correctamente');
    }
    public function destroy($id)
    {
        $whitdrawal = WhitdrawalProvider::findOrFail($id);
        $whitdrawal->delete();
        return redirect()->back()->with('message', 'El proveedor se eliminó correctamente');
    }
}
