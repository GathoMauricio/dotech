<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Company;
use App\Task;
use App\Vacacion;
use App\Whitdrawal;
//use Maatwebsite\Excel\Excel;
use App\Exports\CotizacionesExport;
use App\Exports\ProyectosExport;
use App\Exports\FinalizadosExport;
use App\Exports\ProspectosExport;

class DashboardController extends Controller
{
    public function index($anio = null, $mes = null)
    {
        if ($anio && $mes) {
            $anioActual = $anio;
            $mesActual = $mes;
        } else {
            $anioActual = date('Y');
            $mesActual = date('m');
        }
        $cotizaciones = Sale::whereYear('created_at', $anioActual)
            ->whereMonth('created_at', $mesActual)
            ->get();
        $proyectos = Sale::whereYear('project_at', $anioActual)
            ->whereMonth('project_at', $mesActual)
            ->get();
        $finalizados = Sale::whereYear('finished_at', $anioActual)
            ->whereMonth('finished_at', $mesActual)
            ->get();
        $prospectos = Company::where('status', 'Prospecto')->whereYear('created_at', $anioActual)
            ->whereMonth('created_at', $mesActual)
            ->get();
        $clientes = Company::where('status', 'Cliente')->whereYear('created_at', $anioActual)
            ->whereMonth('created_at', $mesActual)
            ->get();

        if (\Auth::user()->rol_user_id == 1) {
            $tareas = Task::where('archived', 'NO')
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $tareas = Task::where('archived', 'NO')->where(function ($query) {
                $query->orWhere('user_id', \Auth::user()->id);
                $query->orWhere('author_id', \Auth::user()->id);
                $query->orWhere('visibility', 'Público');
            })
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        return view('dashboard.index', compact('cotizaciones', 'proyectos', 'finalizados', 'prospectos', 'clientes', 'anioActual', 'mesActual', 'tareas'));
    }

    public function cambiarMesReportes($anio, $mes)
    {
        $cotizaciones = Sale::whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)
            ->get();
        $proyectos = Sale::whereYear('project_at', $anio)
            ->whereMonth('created_at', $mes)
            ->get();
        $finalizados = Sale::whereYear('created_at', $anio)
            ->whereMonth('finished_at', $mes)
            ->get();
        return response()->json([
            'estatus' => 1,
            'mensaje' => "Información obtenida",
            'data' => [
                'numero_cotizaciones' => count($cotizaciones),
                'numero_proyectos' => count($proyectos),
                'numero_finalizados' => count($finalizados),
            ]
        ]);
    }

    public function exportCotizaciones($anio, $mes)
    {
        return \Excel::download(new CotizacionesExport($anio, $mes), 'cotizaciones_' . $anio . '_' . $mes . '.xlsx');
    }
    public function exportProyectos($anio, $mes)
    {
        return \Excel::download(new ProyectosExport($anio, $mes), 'proyectos_' . $anio . '_' . $mes . '.xlsx');
    }
    public function exportFinalizados($anio, $mes)
    {
        return \Excel::download(new FinalizadosExport($anio, $mes), 'finalizados_' . $anio . '_' . $mes . '.xlsx');
    }
    public function _index()
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


        return view('dashboard._index', [
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
            'ventaMes' => '$' . number_format($totalVentaMes + ($totalVentaMes * 0.16), 2)
        ];
    }

    public function reporteMensualCotizacionesProyectos($anio, $mes)
    {
        return \Excel::download(new ProspectosExport($anio, $mes), 'reporte_mensual_cotizaciones_proyectos_' . $anio . '_' . $mes . '.xlsx');
    }

    public function obtenerPendientes(Request $request)
    {
        $tareas = Task::where('archived', 'NO')->where('user_id', $request->user_id)->get();

        return response()->json([
            'tareas' => $tareas,
        ]);
    }

    public function obtenerPendientesAdmin(Request $request)
    {
        $tareas = Task::where('archived', 'NO')->where('user_id', $request->user_id)->get();
        $retiros = Whitdrawal::where('status', 'Pendiente')->get();
        $vacaciones = Vacacion::where('estatus', 'pendiente')->with('empleado')->get();
        return response()->json([
            'tareas' => $tareas,
            'retiros' => $retiros,
            'vacaciones' => $vacaciones,
        ]);
    }
}
