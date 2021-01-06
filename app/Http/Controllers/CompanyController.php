<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Company;
use App\CompanyDepartment;
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
            
            $spanCreate = "<a href='#' onclick='addQuoteByCompanyModal(".$company->id.");' style='cursor:pointer;color:black;'><span title='Crear cotización...' class='icon icon-plus'></span> Crear cotización</a>";
            $spanFollows = "<a href='#' onclick='indexCompanyFollow(".$company->id.");' style='cursor:pointer;color:black;'>".count(CompanyFollow::where('company_id',$company->id)->get())."<span title='Ver seguimientos...' class='icon icon-bubble'></span> Ver seguimientos</a>";
            $spanQuotations = "<a href='".route('quotes',$company->id)."' style='cursor:pointer;color:#2980B9;'>".count(Sale::where('company_id',$company->id)->where('status','Pendiente')->get())."<span title='Ver cotizaciones...' class='icon icon-coin-dollar'></span> Ver cotizaciones</a>";
            $spanProjects = "<a href='".route('projects',$company->id)."' style='cursor:pointer;color:#229954;'>".count(Sale::where('company_id',$company->id)->where('status','Proyecto')->get())."<span title='Ver proyectos...' class='icon icon-price-tag'></span> Ver proyectos</a>";
            $spanFinalized = "<a href='".route('finalized',$company->id)."' style='cursor:pointer;color:#F39C12;'>".count(Sale::where('company_id',$company->id)->where('status','Finalizado')->get())."<span title='Ver finalizados...' class='icon icon-smile'> Ver finalizados</span></a>";
            $spanRejects = "<a href='".route('rejects',$company->id)."' style='cursor:pointer;color:#C0392B;'>".count(Sale::where('company_id',$company->id)->where('status','Rechazada')->get())."<span title='Ver rechazos...' class='icon icon-sad'></span> Ver rechazos</a>";
            $spanUpdate = "<a href='".route('edit_company',$company->id)."' style='cursor:pointer;color:orange;'><span title='Actualizar...' class='icon icon-pencil'></span> Editar</a>";
            $spanDelete = "<a href='#' onclick='deleteCompany(".$company->id.")' style='cursor:pointer;color:red;'><span title='Eliminar..' class='icon icon-bin' style='cursor:pointer;color:red;'> Eliminar</span></a>";
            
            $json[] = [
                'name' => "<a href='#' onclick='showCompanyModal(".$company->id.")'>".$company['name']."</a>",
                'responsable' => $company['responsable'],
                'email' => "<a href='mailto:".$company['email']."'>".$company['email']."</a>",
                'phone' => "<a href='tel:".$company['phone']."'>".$company['phone']."</a>",
                //'address' => $company['address'],
                'options' => 
                $spanCreate.'<br/>'.
                $spanFollows.'<br/>'.
                $spanQuotations.'<br/>'.
                $spanProjects.'<br/>'.
                $spanFinalized.'<br/>'.
                $spanRejects.'<br/>'.
                $spanUpdate.'<br/>'.
                $spanDelete
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
        return view('companies.create');
    }
    public function store(Request $request)
    {
        $company = Company::create($request->all());
        $department = CompanyDepartment::create([
            'company_id' => $company->id,
            'name' => 'General',
            'manager' => $company->responsable,
            'email' => $company->email,
            'phone' => $company->phone
        ]);
        if(!empty($request->image))
        {
            $file = $request->file('image');
            $name =  "Company_[".$company->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $company->image = $name;
            $company->save();
            return redirect()->route('company_index')->with('message', 'La compañía se guardó, su imagen se almacenó con éxito y se creó su departamento '.$department->name);
        }
        
        return redirect()->route('company_index')->with('message', 'La compañía se almacenó con éxito y se creó su departamento '.$department->name);
    }
    public function show($id)
    {
        //
    }
    public function showAjax(Request $request)
    {
        $company = Company::findOrFail($request->id);
        return $company;
    }
    public function showCompanyDepartmentAjax(Request $request)
    {
        $company = Company::findOrFail($request->id);
        $departments = CompanyDepartment::where('company_id', $request->id)->get();
        $department_items = '';
        foreach($departments as $department)
        {
            $department_items .= '<option value="'.$department->id.'">'.$department->name.'</option>';
        }
        return [
            'company' => $company,
            'department_items' => $department_items
        ];
    }
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit',[ 'company' => $company]);
    }
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->origin = $request->origin;
        $company->status = $request->status;
        $company->name = $request->name;
        $company->responsable = $request->responsable;
        $company->rfc = $request->rfc;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->iguala = $request->iguala;
        if(!empty($request->image))
        {
            if($company->image != 'compania.png')
            {
                if(\Storage::get($company->image)){
                    \Storage::disk('local')->delete($company->image);
                }
            }
            $file = $request->file('image');
            $name =  "Company_[".$company->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $company->image = $name;
            $company->save();
            return redirect()->back()->with('message', 'La compañía se actualizó y su imagen se almacenó con éxito.');
        }
        $company->save();
        return redirect()->back()->with('message', 'La compañía se actualizó con éxito.');
    }
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->back()->with('message', 'La compañía se eliminó con éxito.');
    }
}
