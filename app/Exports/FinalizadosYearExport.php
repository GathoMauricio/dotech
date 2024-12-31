<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Sale;

class FinalizadosYearExport implements FromView
{
    private $anio;

    public function __construct($anio)
    {
        $this->anio = $anio;
    }

    public function view(): View
    {
        $finalizados = Sale::whereYear('finished_at', $this->anio)
            ->get();
        return view('exports.finalizados_year', ['finalizados' => $finalizados]);
    }
}
