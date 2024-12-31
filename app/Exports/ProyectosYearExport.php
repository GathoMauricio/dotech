<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Sale;

class ProyectosYearExport implements FromView
{
    private $anio;

    public function __construct($anio)
    {
        $this->anio = $anio;
    }

    public function view(): View
    {
        $proyectos = Sale::whereYear('project_at', $this->anio)
            ->get();
        return view('exports.proyectos_year', ['proyectos' => $proyectos]);
    }
}
