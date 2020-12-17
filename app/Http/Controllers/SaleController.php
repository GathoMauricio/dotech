<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sale;
class SaleController extends Controller
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
        //
    }
    public function quotes($id)
    {
        $sales = Sale::where('company_id', $id)->where('status','Pendiente')->get();
        return view('sale.quotes',['sales' => $sales]);
    }
    public function projects($id)
    {
        return view('sale.projects',[]);
    }
    public function finalized($id)
    {
        return view('sale.finalized',[]);
    }
    public function rejects($id)
    {
        return view('sale.rejects',[]);
    }
    public function show($id)
    {
        return view('sale.show',[]);
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
