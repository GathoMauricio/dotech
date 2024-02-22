<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Company;

class ActualizaProspectosClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = Company::get();
        foreach ($clientes as $cliente) {
            if (
                $cliente->cotizaciones_proyectos->where('status', 'Proyecto')->count() <= 0
                &&
                $cliente->cotizaciones_proyectos->where('status', 'Finalizado')->count() <= 0
            ) {
                $cliente->status = 'Prospecto';
            } else if (
                $cliente->cotizaciones_proyectos->where('status', 'Proyecto')->count() > 0
                ||
                $cliente->cotizaciones_proyectos->where('status', 'Finalizado')->count() > 0
            ) {
                $cliente->status = 'Cliente';
            }
            $cliente->save();
        }
    }
}
