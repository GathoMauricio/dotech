<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Sale;

class FinalizadosExport implements FromView
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
        $finalizados = Sale::whereYear('finished_at', $this->anio)
            ->whereMonth('finished_at', $this->mes)
            ->get();
        return view('exports.finalizados', ['finalizados' => $finalizados]);
    }
}
