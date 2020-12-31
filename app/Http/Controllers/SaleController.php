<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Company;
use App\CompanyDepartment;
use App\Sale;
use App\ProductSale;
use App\Whitdrawal;
use App\SalePayment;
use App\SaleDocument;
use App\SaleFollow;

use App\Http\Requests\SaleRequest;
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
    public function createSale($id)
    {
        $company = Company::findOrFail($id);
        $departments = CompanyDepartment::where('company_id', $id)->get();
        return view('sale.create',['company' => $company, 'departments' => $departments]);
    }
    public function store(SaleRequest $request)
    {
        $sale = Sale::create($request->all());
        return redirect('show_sale/' . $sale->id)->with('message', 'Registro creado.');
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

        $totalSell = 0;
        foreach($whitdrawals as $whitdrawal)
        {
            if($whitdrawal->status == 'Aprobado')
            {
                $totalSell += $whitdrawal->quantity;
            }
        }
        $grossProfit = floatval($sale->estimated) - floatval($totalSell);
        $grossNoIvaProfit = ($grossProfit - ($grossProfit * 0.16));
        $commision = ($grossNoIvaProfit * $sale->commision_percent) / 100;
        $grossNoIvaProfitNoCommision = $grossNoIvaProfit -$commision;
        return view('sale.show',[
            'sale' => $sale,
            'products' => $products,
            'whitdrawals' => $whitdrawals,
            'payments' => $payments,
            'documents' => $documnets,

            'totalSell' => $totalSell,
            'grossProfit' => $grossProfit,
            'grossNoIvaProfit' => $grossNoIvaProfit,
            'commision' => $commision,
            'grossNoIvaProfitNoCommision' => $grossNoIvaProfitNoCommision
            ]);
    }
    public function showAjax(Request $request)
    {
        $sale = Sale::findOrFail($request->id);
        return [
            'company' => $sale->company['name'],
            'description' => $sale->description,
            'observation' => $sale->observation,
            'delivery_days' => $sale->delivery_days,
            'shipping' => $sale->shipping,
            'payment_type' => $sale->payment_type,
            'credit' => $sale->credit,
            'currency' => $sale->currency
        ];
    }
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $companies = Company::orderBy('name')->get();
        $departments = CompanyDepartment::where('company_id',$sale->company_id)->orderBy('name')->get();
        return view('sale.edit',[
            'sale' => $sale,
            'companies' => $companies,
            'departments' => $departments
        ]);
    }
    public function update(SaleRequest $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $sale->update($request->all());
        return redirect('show_sale/' . $sale->id)->with('message', 'Información actualizada.');
    }
    public function updateQuote(Request $request)
    {
        $sale = Sale::findOrFail($request->sale_id);
        $sale->description = $request->description;
        $sale->observation = $request->observation;
        $sale->delivery_days = $request->delivery_days;
        $sale->shipping = $request->shipping;
        $sale->payment_type = $request->payment_type;
        $sale->credit = $request->credit;
        $sale->currency = $request->currency;
        $sale->save();
        return redirect()->back()->with('message', 'Información actualizada.');
    }
    public function quoteProducts($id)
    {
        $sale = Sale::findOrFail($id);
        $products = ProductSale::where('sale_id',$id)->get();
        $total=0;
        foreach($products as $product){ $total += $product->total_sell; }
        $totalIva = $total + (($total * 16) / 100);
        return view('quotes.products',[ 
            'sale'=> $sale, 
            'products' => $products,
            'total' => $total,
            'totalIva' => $totalIva
            ]);
    }
    public function destroy($id)
    {
        Sale::findOrFail($id)->delete();
        ProductSale::where('sale_id',$id)->delete();
        Whitdrawal::where('sale_id',$id)->delete();
        SalePayment::where('sale_id',$id)->delete();
        SaleDocument::where('sale_id',$id)->delete();
        SaleFollow::where('sale_id',$id)->delete();
        return redirect()->back()->with('message', 'El registro se eliminó por completo.');
    }
    public function updateStatus(Request $request)
    {
        $sale = Sale::findOrFail($request->sale_id);
        $sale->status = $request->status;
        $sale->save();
        return redirect()->back()->with('message', 'Información actualizada.');
    }
    public function changeCommision(Request $request)
    {
        $sale = Sale::findOrFail($request->sale_id);
        $sale->commision_percent = $request->commision_percent;
        $sale->save();
        return $sale;
    }
    public function loadPDF($id)
    {
        $sale = Sale::findOrFail($id);
        $saleProducts =ProductSale::where('sale_id', $id)->get();
        $subtotal = 0;
        foreach($saleProducts as $saleProduct)
        {
            $subtotal += ($saleProduct->unity_price_sell * $saleProduct->quantity);
        }
        $iva = ($subtotal * 16) / 100;
        $total = $subtotal + $iva;
        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        $pdf = \PDF::loadView('pdf.sale',
            [
                'logo' => $logo,
                'sale' => $sale,
                'saleProducts' => $saleProducts,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total
            ]
        );
        return $pdf->stream('Cotizacion.pdf');
    }
}
