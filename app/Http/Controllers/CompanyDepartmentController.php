<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CompanyDepartment;
class CompanyDepartmentController extends Controller
{
    public function loadDepartemnsById(Request $request)
    {
        $departmens = CompanyDepartment::where('company_id', $request->id)->get();
        return $departmens;
    }
    public function store(Request $request)
    {
        $department = CompanyDepartment::create($request->all());
        if($department)
        {
            return redirect()->back()
            ->with('message', 'El departamento en '.$department->company['name'].' se agregó con éxito.');
        }
    }
}
