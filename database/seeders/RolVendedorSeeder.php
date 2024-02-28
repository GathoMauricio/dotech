<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\RolUser;

class RolVendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se crea primero el rol antiguo
        $vendedor = RolUser::create([
            'name' => 'Vendedor',
        ]);
        //a partir del rol antigui se aplica el nuevo sistema de roles y permisos
        $vendedor = Role::create(['name' => $vendedor->name]);
        $vendedor->givePermissionTo('modulo_tareas');
        $vendedor->givePermissionTo('modulo_cotizaciones');
        $vendedor->givePermissionTo('modulo_proyectos');
    }
}
