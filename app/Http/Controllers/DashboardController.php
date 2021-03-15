<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index()
    {
        $withdrawals = count(\App\Whitdrawal::where('status','Pendiente')->get());
        $tasks = count(\App\Task::where('archived','NO')->get());
        $quotes = count(\App\Sale::where('status','Pendiente')->get());
        $projects = count(\App\Sale::where('status','Proyecto')->get());
        $binnacles = count(\App\Binnacle::all());
        $companies = count(\App\Company::all());

        return view('dashboard.index',[
            'withdrawals' => $withdrawals,
            'tasks' => $tasks,
            'quotes' => $quotes,
            'projects' => $projects,
            'binnacles' => $binnacles,
            'companies' => $companies
        ]);
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
