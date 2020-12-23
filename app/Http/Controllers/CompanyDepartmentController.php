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
}
