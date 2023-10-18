<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Sale;

class CotizacionesExport implements FromView
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
        $cotizaciones = Sale::whereYear('created_at', $this->anio)
            ->whereMonth('created_at', $this->mes)
            ->get();
        return view('exports.cotizaciones', ['cotizaciones' => $cotizaciones]);
    }
}
