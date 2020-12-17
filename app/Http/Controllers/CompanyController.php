<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Company;
use App\Sale;
use App\CompanyFollow;
class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index',['companies' => $companies]);
    }
    public function indexAjax()
    {
        $companies = Company::all();
        
        
        $json=[];
        foreach($companies as $company)
        {
            
            $spanFollows = "<a href='#' onclick='indexCompanyFollow(".$company->id.");' style='cursor:pointer;color:black;'>".count(CompanyFollow::where('company_id',$company->id)->get())."<span title='Seguimientos...' class='icon icon-bubble'></span></a>&nbsp;&nbsp;";
            $spanQuotations = "<a href='".route('quotes',$company->id)."' style='cursor:pointer;color:#2980B9;'>".count(Sale::where('company_id',$company->id)->where('status','Pendiente')->get())."<span title='Cotizaciones...' class='icon icon-coin-dollar'></span></a>&nbsp;&nbsp;";
            $spanProjects = "<a href='".route('projects',$company->id)."' style='cursor:pointer;color:#229954;'>".count(Sale::where('company_id',$company->id)->where('status','Proyecto')->get())."<span title='Proyectos...' class='icon icon-price-tag'></span></a>&nbsp;&nbsp;";
            $spanFinalized = "<a href='".route('finalized',$company->id)."' style='cursor:pointer;color:#F39C12;'>".count(Sale::where('company_id',$company->id)->where('status','Finalizada')->get())."<span title='Finalizados...' class='icon icon-smile'></span></a>&nbsp;&nbsp;";
            $spanRejects = "<a href='".route('rejects',$company->id)."' style='cursor:pointer;color:#C0392B;'>".count(Sale::where('company_id',$company->id)->where('status','Rechazada')->get())."<span title='Rechazos...' class='icon icon-sad'></span></a>&nbsp;&nbsp;";
            $spanUpdate = "<a href='#' style='cursor:pointer;color:orange;'><span title='Actualizar...' class='icon icon-pencil'></span></a>&nbsp;&nbsp;";
            $spanDelete = "<a href='#' style='cursor:pointer;color:red;'><span title='Eliminar..' class='icon icon-bin' style='cursor:pointer;color:red;'></span></a>&nbsp;&nbsp;";
            
            $json[] = [
                'name' => "<a href='#'>".$company['name']."</a>",
                'responsable' => $company['responsable'],
                'email' => "<a href='mailto:".$company['email']."'>".$company['email']."</a>",
                'phone' => "<a href='tel:".$company['phone']."'>".$company['phone']."</a>",
                //'address' => $company['address'],
                'options' => $spanFollows.$spanQuotations.$spanProjects.$spanFinalized.$spanRejects.$spanUpdate.$spanDelete
            ];
        }
        return $json;
    }
    public function getCboItems()
    {
        $companies = Company::orderBy('name')->get();
        $html = "<option value='0'>--Sin compañía--</option>";
        foreach($companies as $company)
        {
            $html .= "<option value='$company->id'>$company->name</option>";
        }
        return $html;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
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
