<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Sale;

class FoliosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tickets = Sale::all();
        $contador_cotizacion = 1;
        $contador_proyecto = 1;
        foreach ($tickets as $ticket) {
            $ticket->folio_cotizacion = 'COT-' . $contador_cotizacion;
            $contador_cotizacion++;
            if ($ticket->status == 'Proyecto' || $ticket->status == 'Finalizado') {
                $ticket->folio_proyecto = 'PROY-' . $contador_proyecto;
                $contador_proyecto++;
            }
            $ticket->save();
        }
    }
}
