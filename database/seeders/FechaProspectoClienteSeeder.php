<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Company;

class FechaProspectoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::all();
        foreach ($companies as $company) {
            $company->fecha_prospecto = $company->created_at;
            $company->fecha_cliente = $company->updated_at;
            $company->save();
        }
    }
}
