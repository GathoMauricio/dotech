<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //crear rol
        $rol = Role::create(['name' => 'administrador']);
        //crear permiso
        Permission::create(['name' => 'ver_retiros']);
        //asignbar permiso "ver_retiros" al rol administrador
        $rol->givePermissionTo('ver_retiros');
        //buscar usuario
        $user =  User::where('email', 'mauricio2769@gmail.com')->first();
        //asignar rol al usuario
        $user->assignRole('administrador');
    }
}
