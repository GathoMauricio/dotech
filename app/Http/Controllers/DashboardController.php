<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $withdrawals = count(\App\Whitdrawal::where('status', 'Pendiente')->get());
        $tasks = count(\App\Task::where('archived', 'NO')->get());
        $quotes = \App\Sale::where('status', 'Pendiente')->get();
        $projects = \App\Sale::where('status', 'Proyecto')->get();
        $binnacles = count(\App\Binnacle::all());
        $companies = count(\App\Company::all());

        $costoTotal = 0;
        $inversionTotal = 0;
        $utilidadTotal = 0;
        foreach ($projects as $venta) {
            $costoTotal += $venta->estimated + ($venta->estimated * 0.16);

            $retiros = \App\Whitdrawal::where('sale_id', $venta->id)->where('status', 'Aprobado')->get();
            foreach ($retiros as $retiro) {
                $inversionTotal += $retiro->quantity;
            }
        }
        $utilidadTotal = $costoTotal - $inversionTotal;


        return view('dashboard.index', [
            'costoTotal' => $costoTotal,
            'inversionTotal' => $inversionTotal,
            'utilidadTotal' => $utilidadTotal,

            'withdrawals' => $withdrawals,
            'tasks' => $tasks,
            'quotes' => count($quotes),
            'projects' => count($projects),
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
    public function changeGraphicMonth(Request $request)
    {
        $dates = explode('-', $request->month);
        $totalMes = Sale::whereYear('created_at', '=', $dates[0])->whereMonth('created_at', '=', $dates[1])->get();
        $cotizacionesMes = Sale::where('status', 'Pendiente')->whereYear('created_at', '=', $dates[0])->whereMonth('created_at', '=', $dates[1])->get();
        $proyectosMes = Sale::where('status', 'Proyecto')->whereYear('created_at', '=', $dates[0])->whereMonth('created_at', '=', $dates[1])->get();
        $totalVentaMes = 0;
        foreach ($proyectosMes as $p) {
            $totalVentaMes += $p->estimated;
        }
        return [
            'totalMes' => count($totalMes),
            'proyectosMes' => count($proyectosMes),
            'ventaMes' => '$'.number_format($totalVentaMes + ($totalVentaMes * 0.16),2)
        ];
    }
}
