<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  App\ClienteListaPivot;
use  App\Company;
use  App\MailingLista;

class ListaClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prospectos = Company::where('status', 'Prospecto')->get();
        $clientes = Company::where('status', 'Cliente')->get();

        $lista_prospecto = MailingLista::create([
            'nombre' => 'Prospectos',
            'descripcion' => 'Lista de prospectos el el sistema'
        ]);

        foreach ($prospectos as $item) {
            ClienteListaPivot::create([
                'lista_id' => $lista_prospecto->id,
                'cliente_id' => $item->id
            ]);
        }


        $lista_clientes = MailingLista::create([
            'nombre' => 'Clientes',
            'descripcion' => 'Lista de clientes activos en el sistema'
        ]);

        foreach ($clientes as $item) {
            ClienteListaPivot::create([
                'lista_id' => $lista_clientes->id,
                'cliente_id' => $item->id
            ]);
        }
    }
}
