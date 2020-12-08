<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Company;
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
        $spanFollows = "<a href='#' style='cursor:pointer;color:black;'>0<span title='Seguimientos...' class='icon icon-bubble'></span></a>&nbsp;&nbsp;";
        $spanQuotations = "<a href='#' style='cursor:pointer;color:#2980B9;'>0<span title='Cotizaciones...' class='icon icon-coin-dollar'></span></a>&nbsp;&nbsp;";
        $spanProjects = "<a href='#' style='cursor:pointer;color:#229954;'>0<span title='Proyectos...' class='icon icon-price-tag'></span></a>&nbsp;&nbsp;";
        $spanRejects = "<a href='#' style='cursor:pointer;color:#C0392B;'>0<span title='Rechazos...' class='icon icon-sad'></span></a>&nbsp;&nbsp;";
        $spanUpdate = "<a href='#' style='cursor:pointer;color:orange;'>0<span title='Actualizar...' class='icon icon-pencil'></span></a>&nbsp;&nbsp;";
        $spanDelete = "<a href='#' style='cursor:pointer;color:red;'>0<span title='Eliminar..' class='icon icon-bin' style='cursor:pointer;color:red;'></span></a>&nbsp;&nbsp;";
        
        $json=[];
        foreach($companies as $company)
        {
            $json[] = [
                'name' => "<a href='#'>".$company['name']."</a>",
                'responsable' => $company['responsable'],
                'email' => "<a href='mailto:".$company['email']."'>".$company['email']."</a>",
                'phone' => "<a href='tel:".$company['phone']."'>".$company['phone']."</a>",
                //'address' => $company['address'],
                'options' => $spanFollows.$spanQuotations.$spanProjects.$spanRejects.$spanUpdate.$spanDelete
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
