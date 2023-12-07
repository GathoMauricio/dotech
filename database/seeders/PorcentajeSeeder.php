<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Company;
use App\Sale;

class PorcentajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proyectos = Sale::all();
        foreach ($proyectos as $proyecto) {
            $proyecto->commision_percent = $proyecto->cliente->porcentaje;
            $proyecto->save();
            //dump($proyecto->commision_percent);
        }
    }
}
