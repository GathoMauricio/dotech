<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Sale;

class ProyectosExport implements FromView
{
    private $anio;
    private $mes;

    public function __construct($anio, $mes)
    {
        $this->anio = $anio;
        $this->mes = $mes;
    }

    public function view(): View
    {
        $proyectos = Sale::whereYear('project_at', $this->anio)
            ->whereMonth('project_at', $this->mes)
            ->get();
        return view('exports.proyectos', ['proyectos' => $proyectos]);
    }
}
