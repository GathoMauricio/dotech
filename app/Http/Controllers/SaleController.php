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
use App\Binnacle;
use PDF;
use Auth;

use App\Http\Requests\SaleRequest;
class SaleController extends Controller
{
    public function index()
    {
        //
    }
    public function indexQuotes()
    {
        if(Auth::user()->rol_user_id == 1)
        {
            $sales = Sale::where('status','Pendiente')->orderBy('id','desc')->paginate(15);
        }else{
            $sales = Sale::where('status','Pendiente')->where('author_id',Auth::user()->id)->orderBy('id','desc')->paginate(15);
        }
        return view('quotes.index',['sales' => $sales]);
    }
    public function indexProyects()
    {
        $sales = Sale::where('status','Proyecto')->orderBy('id','desc')->paginate(15);
        return view('projects.index',['sales' => $sales]);
    }
    public function indexProyectsFinished()
    {
        $sales = Sale::where('status','Finalizado')->orderBy('id','desc')->paginate(15);
        return view('projects.finished',['sales' => $sales]);
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
    public function showProjectAjax(Request $request)
    {
        $sale = Sale::findOrFail($request->id);
        $button1 = '<a target="_blank" href="'.route('binnacles_by_project',$sale->id).'"><span class="icon-book" title="Proyecto" style="cursor:pointer;color:#8E44AD"> Bitácoras</span></a>';
        $button2 = '<a target="_blank" href="'.route('show_sale',$sale->id).'"><span class="icon-eye" title="Proyecto" style="cursor:pointer;color:#3498DB"> Proyecto</span></a>';
        $button3 = '<a href="#" onclick="editProject('.$sale->id.');"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>';
        $button4 = '<a href="#" onclick="saleFollowModal('.$sale->id.');"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>';
        return [
            'id' => $sale->id,
            'company' => $sale->company['name'],
            'author' => $sale->author['name'].' '.$sale->author['middle_name'].' '.$sale->author['last_name'],
            'description' => $sale->description,
            'price' => number_format($sale->estimated + ($sale->estimated * 0.16),2),
            'date' => onlyDate($sale->created_at),

            'button1' => $button1,
            'button2' => $button2,
            'button3' => $button3,
            'button4' => $button4,
        ];
    }
    public function showQuoteAjax(Request $request)
    {
        $sale = Sale::findOrFail($request->id);
        $button1 = '<a href="#" onclick="sendQuoteModal('.$sale->id.',\''.$sale->department['email'].'\');"><span class="icon-envelop" title="Enviar" style="cursor:pointer;color:#D7DF01"> Enviar</span></a>';
        $button2 = '<a href="'.route('quote_products',$sale->id).'" target="_blank"><span class="icon-eye" title="Productos" style="cursor:pointer;color:#3498DB"> Productos</span></a>';
        $button3 = '<a href="#" onclick="changeStatusModal('.$sale->id.');"><span class="icon-checkmark" title="Cambiar estatus" style="cursor:pointer;color:#2ECC71"> Estatus</span></a>';
        $button4 = '<a href="#" onclick="editQuote('.$sale->id.');"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>';
        $button5 = '<a onclick="saleFollowModal('.$sale->id.');" href="#"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>';
        return [
            'id' => $sale->id,
            'company' => $sale->company['name'],
            'author' => $sale->author['name'].' '.$sale->author['middle_name'].' '.$sale->author['last_name'],
            'description' => $sale->description,
            'price' => number_format($sale->estimated + ($sale->estimated * 0.16),2),
            'date' => onlyDate($sale->created_at),

            'button1' => $button1,
            'button2' => $button2,
            'button3' => $button3,
            'button4' => $button4,
            'button5' => $button5,
        ];
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
        $sales = Sale::orderBy('id','DESC')->where('company_id', $id)->where('status','Rechazada')->get();
        return view('sale.rejects',['company' => $company, 'sales' => $sales]);
    }
    public function allRejects()
    {
        $sales = Sale::orderBy('id','DESC')->where('status','Rechazada')->get();
        return view('sale.rejects',['company' => 'General', 'sales' => $sales]);
    }
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        $products = ProductSale::where('sale_id',$id)->get();
        $whitdrawals = Whitdrawal::where('sale_id',$id)->where('status','Aprobado')->get();
        $payments = SalePayment::where('sale_id',$id)->get();
        $documnets = SaleDocument::where('sale_id',$id)->get();
        $binnacles = Binnacle::where('sale_id',$id)->get();

        $estimado = 0;
        foreach($products as $product)
        {
            $estimado += $product->unity_price_sell * $product->quantity;
        }
        $sale->estimated = $estimado;
        $sale->iva = ($estimado + ($estimado * 0.16)) - $estimado;
        $sale->save();
        $totalRetiros = 0;
        foreach($whitdrawals as $whitdrawal)
        {
            $totalRetiros += floatval($whitdrawal->quantity);
        }
        
        $costoProyecto = number_format($sale->estimated + ($sale->estimated * 0.16),2);

        $utilidad = number_format($sale->estimated + ($sale->estimated * 0.16) - $totalRetiros,2);
        
        //$comision = (($sale->estimated + ($sale->estimated * 0.16) - $totalRetiros / 1.16) * $sale->commision_percent) / 100 ;
        //$comision =  number_format($comision - ($comision * 0.16),2);

        $comision = ($sale->estimated + ($sale->estimated * 0.16) - $totalRetiros) / 1.16;
        $comision = number_format($comision * ($sale->commision_percent / 100),2);

        /*
        costoProyecto
        1044/1.16=900
        900*.13=117 
        */

        $sale->utility = $utilidad;
        $sale->save();
        $totalSell = 0;
        foreach($whitdrawals as $whitdrawal)
        {
            if($whitdrawal->status == 'Aprobado')
            {
                $totalSell += $whitdrawal->quantity;
            }
        }
        $grossProfit = 0;
        $grossNoIvaProfit = 0;
        $commision = 0;
        $grossNoIvaProfitNoCommision = 0;
        return view('sale.show',[
            'sale' => $sale,
            'products' => $products,
            'whitdrawals' => $whitdrawals,
            'payments' => $payments,
            'documents' => $documnets,
            'binnacles' => $binnacles,

            'costoProyecto' => $costoProyecto,
            'utilidad' => $utilidad,
            'totalRetiros' => $totalRetiros,
            'comision' => $comision,

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
            'id' => $sale->id,
            'email' => $sale->department['email'],
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


        $msg_user_id=0;
        $msg = 'actualizó la informacion el proyecto: '.$sale->description.' de '.$sale->company->name;
        $msg_route=route('show_sale',$sale->id);
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

        $msg_user_id=0;
        $msg = 'actualizó la informacion la cotización: '.$sale->description.' de '.$sale->company->name;
        $msg_route=route('show_sale',$sale->id);
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

        return redirect()->back()->with('message', 'Información actualizada.');
    }
    public function quoteProducts($id)
    {
        $sale = Sale::findOrFail($id);
        $products = ProductSale::where('sale_id',$id)->get();
        $total=0;
        $totalMasIva = 0;
        foreach($products as $product){ 
            $total += $product->total_sell; 
            $totalMasIva += $product->total_sell; 
        }
        
        $totalIva = $total + (($total * .16) / 100);

        return view('quotes.products',[
            'sale'=> $sale,
            'products' => $products,
            'total' => $total,
            'totalIva' => $totalIva,
            'totalMasIva' => $totalMasIva
            ]);
    }
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);


        $msg_user_id=0;
        $msg = 'eliminó el proyecto: '.$sale->description.' de '.$sale->company->name;
        $msg_route=route('index_proyects');
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

        $sale->delete();
        ProductSale::where('sale_id',$id)->delete();
        Whitdrawal::where('sale_id',$id)->delete();
        SalePayment::where('sale_id',$id)->delete();
        SaleDocument::where('sale_id',$id)->delete();
        SaleFollow::where('sale_id',$id)->delete();
        return redirect()->back()->with('message', 'El registro se eliminó por completo.');
    }
    public function updateStatus(Request $request)
    {
        if($request->follow)
        {
            $follow = SaleFollow::create([
                'sale_id' => $request->sale_id,
                'body' => $request->follow
            ]);
        }

        $sale = Sale::findOrFail($request->sale_id);
        $sale->status = $request->status;
        $sale->save();

        $msg_user_id=0;
        $msg = 'actualizó el estatus de la cotización: '.$sale->description.' de '.$sale->company->name." a ".$sale->status;
        $msg_route=route('show_sale',$sale->id);
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

        return redirect()->back()->with('message', 'Información actualizada.');
    }
    public function changeCommision(Request $request)
    {
        $sale = Sale::findOrFail($request->sale_id);
        $sale->commision_percent = $request->commision_percent;
        $sale->save();


        $msg_user_id=0;
        $msg = 'cambió la comisión del proyecto: '.$sale->description.' de '.$sale->company->name." a ".$sale->commision_percent.'%';
        $msg_route=route('show_sale',$sale->id);
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

        $products = ProductSale::where('sale_id',$id)->get();
        $total=0;
        $totalMasIva = 0;
        foreach($products as $product){ 
            $total += $product->total_sell; 
            $totalMasIva += $product->total_sell; 
        }
        
        $totalIva = $total + (($total * .16) / 100);


        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        $logo2 = parseBase64(public_path("storage/".$sale->company['image']));
        $pdf = PDF::loadView('pdf.sale',
            [
                'logo' => $logo,
                'logo2' => $logo2,
                'sale' => $sale,
                'saleProducts' => $saleProducts,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total,
                
                'products' => $products,
                'totalMasIva' => $totalMasIva
            ]
        );
        return $pdf->stream('Cotizacion.pdf');
    }
    public function sendSale(Request $request)
    {
        $id = $request->sale_id;
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
        $logo2 = parseBase64(public_path("storage/".$sale->company['image']));
        $pdf = \PDF::loadView('pdf.sale',
            [
                'logo' => $logo,
                'logo2' => $logo2,
                'sale' => $sale,
                'saleProducts' => $saleProducts,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total
            ]
        );
        $emails=$sale->department['email'];
        if(!empty($request->extra_email))
        {
            $emails=[$sale->department['email'] ,$request->extra_email];
        }
        \Mail::send('email.sale', ['sale' => $sale], function ($mail) use ($pdf,$sale,$emails) {
            $mail->from('dotechapp@dotredes.com',env('APP_NAME'));
            $mail->to($emails);
            $mail->attachData($pdf->output(), 'Cotizacion_'.$sale->id.'.pdf');
        });

        $msg_user_id=0;
        $msg = 'envió la cotización: '.$sale->description.' de '.$sale->company->name;
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

        return redirect()->back()->with('message', 'Se envió la cotización '.$sale->description.' a '.$sale->company->name.' con éxito.');
    }
    public function storeSaleByCompany(Request $request)
    {
        $sale = Sale::create($request->all());
        if($sale)
        {
            $msg_user_id=0;
            $msg = 'creo la cotización: '.$sale->description.' para: '.$sale->company->name;
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
            return redirect()->route('quote_products',$sale->id)->with('message', 'La cotización se creó con éxito ahora puede agregar productos.');
        }else{ return "Error"; }
    }
    public function storeQuote(Request $request)
    {
        $sale = Sale::create($request->all());
        if($sale)
        {
            $msg_user_id=0;
            $msg = 'creo la cotización: '.$sale->description.' para: '.$sale->company->name;
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
            return redirect()->route('quote_products',$sale->id)->with('message', 'La cotización se creó con éxito ahora puede agregar productos.');
        }else{ return "Error"; }
    }
    public function setProjectAsFinish($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->status = 'Finalizado';
        $sale->save();
        $msg_user_id=0;
        $msg = 'ha marcado el proyecto: '.$sale->description.' de '.$sale->company->name.' como finalizado.';
        $msg_route=route('show_sale',$sale->id);
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
        return redirect()->route('index_proyects')->with('message','El proyecto '.$sale->description.' se marcó como finalizado.');
    }

    public function searchProjectAjax(Request $request)
    {
        $sales = Sale::select('companies.name','sales.id','sales.description')
                ->join('companies', 'sales.company_id', '=', 'companies.id')
                ->where(function($q) use ($request){
                    $q->where('companies.name','LIKE','%'.$request->q.'%')->orWhere('sales.description','LIKE','%'.$request->q.'%');
                })
                ->limit(10)
                ->get();
        $json = [];
        foreach($sales as $sale){
            $json [] = [
                'label' => $sale->name.' - '.$sale->id.' - '.$sale->description,
                'value' => $sale->id
            ];
        }
        return $json;
    }
    public function searchProjectAjax2(Request $request)
    {
        $sales = Sale::select(
            'sales.id AS ID',
            'companies.name AS COMPANIA',
            'sales.description AS DESCRIPCION',
            'sales.estimated AS MONTO',
            'sales.created_at AS FECHA'
            )
            ->join('companies', 'sales.company_id', '=', 'companies.id')
            ->where('sales.status','Proyecto')
            ->where(function($q) use ($request){
                $q->where('sales.id','LIKE','%'.$request->q.'%')
                ->orWhere('companies.name','LIKE','%'.$request->q.'%')
                ->orWhere('sales.description','LIKE','%'.$request->q.'%')
                ->orWhere('sales.estimated','LIKE','%'.$request->q.'%')
                ->orWhere('sales.created_at','LIKE','%'.$request->q.'%')
                ;
            })
            ->orderBy('sales.id','DESC')
            ->get();
                
        $json = [];
        foreach($sales as $sale){
            $links = '
            <a href="'.route('binnacles_by_project',$sale->ID).'"><span class="icon-book" title="Proyecto" style="cursor:pointer;color:#8E44AD"> Bitácoras</span></a>
            <br>
            <a href="'.route('show_sale',$sale->ID).'"><span class="icon-eye" title="Proyecto" style="cursor:pointer;color:#3498DB"> Proyecto</span></a>
            <br>
            <a href="#" onclick="editProject('.$sale->ID.');"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
            <br>
            <a href="#" onclick="saleFollowModal('.$sale->ID.');"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
            ';
            if(\Auth::user()->rol_user_id == 1){
                $links .= '
                <br>
                <a href="#" onclick="deleteSale('.$sale->ID.')"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                ';
            }
            $json[] = [
                'id' => $sale->ID,
                'company' => $sale->COMPANIA,
                'description' => $sale->DESCRIPCION,
                'amount' => number_format($sale->MONTO + ($sale->MONTO * 0.16),2),
                'date' => onlyDate($sale->FECHA),
                'links' => $links
            ];
        }
        return $json;
    }
    public function searchProjectFAjax(Request $request)
    {
        $sales = Sale::select(
            'sales.id AS ID',
            'companies.name AS COMPANIA',
            'sales.description AS DESCRIPCION',
            'sales.estimated AS MONTO',
            'sales.created_at AS FECHA'
            )
            ->join('companies', 'sales.company_id', '=', 'companies.id')
            ->where('sales.status','Finalizado')
            ->where(function($q) use ($request){
                $q->where('sales.id','LIKE','%'.$request->q.'%')
                ->orWhere('companies.name','LIKE','%'.$request->q.'%')
                ->orWhere('sales.description','LIKE','%'.$request->q.'%')
                ->orWhere('sales.estimated','LIKE','%'.$request->q.'%')
                ->orWhere('sales.created_at','LIKE','%'.$request->q.'%')
                ;
            })
            ->orderBy('sales.id','DESC')
            ->get();
                
        $json = [];
        foreach($sales as $sale){
            $links = '
            <a href="'.route('binnacles_by_project',$sale->ID).'"><span class="icon-book" title="Proyecto" style="cursor:pointer;color:#8E44AD"> Bitácoras</span></a>
            <br>
            <a href="'.route('show_sale',$sale->ID).'"><span class="icon-eye" title="Proyecto" style="cursor:pointer;color:#3498DB"> Proyecto</span></a>
            <br>
            <a href="#" onclick="editProject('.$sale->ID.');"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
            <br>
            <a href="#" onclick="saleFollowModal('.$sale->ID.');"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
            ';
            if(\Auth::user()->rol_user_id == 1){
                $links .= '
                <br>
                <a href="#" onclick="deleteSale('.$sale->ID.')"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                ';
            }
            $json[] = [
                'id' => $sale->ID,
                'company' => $sale->COMPANIA,
                'description' => $sale->DESCRIPCION,
                'amount' => number_format($sale->MONTO + ($sale->MONTO * 0.16),2),
                'date' => onlyDate($sale->FECHA),
                'links' => $links
            ];
        }
        return $json;
    }
    public function searchQuoteAjax(Request $request)
    {
        //return $request;
        //$sales = Sale::where('description','LIKE','%'.$request->q.'%')->where('status','Pendiente')->limit(10)->get();

        $sales = Sale::select('companies.name','sales.id','sales.description')
                ->join('companies', 'sales.company_id', '=', 'companies.id')
                ->where(function($q) use ($request){
                    $q->where('companies.name','LIKE','%'.$request->q.'%')->orWhere('sales.description','LIKE','%'.$request->q.'%');
                })
                ->limit(10)
                ->get();

        $json = [];
        foreach($sales as $sale){
            $json [] = [
                'label' => $sale->name.' - '.$sale->id.' - '.$sale->description,
                'value' => $sale->id
            ];
        }
        return $json;
    }
    public function searchQuoteAjax2(Request $request)
    {
        $sales = Sale::select(
            'sales.id AS ID',
            'companies.name AS COMPANIA',
            'sales.description AS DESCRIPCION',
            'sales.estimated AS MONTO',
            'company_department.email AS EMAIL',
            'sales.created_at AS FECHA'
            )
            ->join('companies', 'sales.company_id', '=', 'companies.id')
            ->join('company_department','company_department.id','=','sales.department_id')
            ->where('sales.status','Pendiente')
            ->where(function($q) use ($request){
                $q->where('sales.id','LIKE','%'.$request->q.'%')
                ->orWhere('companies.name','LIKE','%'.$request->q.'%')
                ->orWhere('sales.description','LIKE','%'.$request->q.'%')
                ->orWhere('sales.estimated','LIKE','%'.$request->q.'%')
                ->orWhere('sales.created_at','LIKE','%'.$request->q.'%')
                ;
            })
            ->orderBy('sales.id','DESC')
            ->limit(25)
            ->get();
                
        $json = [];
        foreach($sales as $sale){
            $links = '
            <a href="#" onclick="sendQuoteModal('.$sale->ID.',\''.$sale->EMAIL.'\');"><span class="icon-envelop" title="Enviar" style="cursor:pointer;color:#D7DF01"> Enviar</span></a>
                <br>
                <a href="'.route('quote_products',$sale->ID).'" target="_blank"><span class="icon-eye" title="Productos" style="cursor:pointer;color:#3498DB"> Productos</span></a>
                <br>
                <a href="#" onclick="changeStatusModal('.$sale->ID.');"><span class="icon-checkmark" title="Cambiar estatus" style="cursor:pointer;color:#2ECC71"> Estatus</span></a>
                <br>
                <a href="#" onclick="editQuote('.$sale->ID.');"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a onclick="saleFollowModal('.$sale->ID.');" href="#"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
            ';
            if(\Auth::user()->rol_user_id == 1){
                $links .= '
                <br>
                <a href="#" onclick="deleteSale('.$sale->ID.')"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                ';
            }
            $json[] = [
                'id' => $sale->ID,
                'company' => $sale->COMPANIA,
                'description' => $sale->DESCRIPCION,
                'amount' => number_format($sale->MONTO + ($sale->MONTO * 0.16),2),
                'date' => onlyDate($sale->FECHA),
                'links' => $links
            ];
        }
        return $json;
    }
}
