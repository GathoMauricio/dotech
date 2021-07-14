<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockProductCategory;

class StockProductCategoryController extends Controller
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
        $category = StockProductCategory::create($request->all());
        if($category)
        {
            return redirect()->back()->with('message', 'Registro almacenado.');
        }
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
