<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\WhitdrawalProvider;
class WhitdrawalProviderController extends Controller
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
        WhitdrawalProvider::create($request->all());
        return redirect()->back()->with('message', 'El proveedor se agregó correctamente');
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
