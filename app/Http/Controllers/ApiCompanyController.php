<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
class ApiCompanyController extends Controller
{
    public function index()
    {
        $companies = Company::where('status','Cliente')->orderBy('name')->get();
        return $companies;
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
        $company = Company::findOrFail($id);
        return $company;
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
