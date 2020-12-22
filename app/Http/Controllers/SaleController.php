<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Company;
use App\Sale;
use App\ProductSale;
use App\Whitdrawal;
use App\SalePayment;
use App\SaleDocument;
class SaleController extends Controller
{
    public function index()
    {
        //
    }
    public function indexQuotes()
    {
        $sales = Sale::where('status','Pendiente')->get();
        return view('quotes.index',['sales' => $sales]);
    }
    public function indexProyects()
    {
        $sales = Sale::where('status','Proyecto')->get();
        return view('projects.index',['sales' => $sales]);
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
        $company = Company::findOrFail($id);
        $sales = Sale::where('company_id', $id)->where('status','Pendiente')->get();
        return view('sale.quotes',['company' => $company, 'sales' => $sales]);
    }
    public function projects($id)
    {
        $company = Company::findOrFail($id);
        $sales = Sale::where('company_id', $id)->where('status','Proyecto')->get();
        return view('sale.projects',['company' => $company, 'sales' => $sales]);
    }
    public function finalized($id)
    {
        $company = Company::findOrFail($id);
        $sales = Sale::where('company_id', $id)->where('status','Finalizado')->get();
        return view('sale.finalized',['company' => $company, 'sales' => $sales]);
    }
    public function rejects($id)
    {
        $company = Company::findOrFail($id);
        $sales = Sale::where('company_id', $id)->where('status','Rechazada')->get();
        return view('sale.rejects',['company' => $company, 'sales' => $sales]);
    }
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        $products = ProductSale::where('sale_id',$id)->get();
        $whitdrawals = Whitdrawal::where('sale_id',$id)->get();
        $payments = SalePayment::where('sale_id',$id)->get();
        $documnets = SaleDocument::where('sale_id',$id)->get();
        return view('sale.show',[
            'sale' => $sale,
            'products' => $products,
            'whitdrawals' => $whitdrawals,
            'payments' => $payments,
            'documents' => $documnets
            ]);
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
