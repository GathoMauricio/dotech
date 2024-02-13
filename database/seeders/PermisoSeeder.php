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
        Role::where('guard_name', 'web')->delete();
        Permission::where('guard_name', 'web')->delete();

        //crear roles
        $administrador = Role::create(['name' => 'Administrador']);
        $gerente_ventas = Role::create(['name' => 'Gerente de venta']);
        $tecnico = Role::create(['name' => 'Técnico']);

        //crear permisos
        Permission::create(['name' => 'modulo_roles_permisos']);
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'modulo_retiros']);
        Permission::create(['name' => 'modulo_transacciones']);
        Permission::create(['name' => 'cargar_transacciones']);
        Permission::create(['name' => 'crear_transacciones']);
        Permission::create(['name' => 'editar_transacciones']);
        Permission::create(['name' => 'eliminar_transacciones']);
        Permission::create(['name' => 'modulo_tareas']);
        Permission::create(['name' => 'modulo_cotizaciones']);
        Permission::create(['name' => 'modulo_proyectos']);
        Permission::create(['name' => 'modulo_bitacoras']);
        Permission::create(['name' => 'modulo_prospectos']);
        Permission::create(['name' => 'modulo_clientes']);
        Permission::create(['name' => 'modulo_vehiculos']);
        Permission::create(['name' => 'modulo_almacen']);
        Permission::create(['name' => 'modulo_aspirantes']);
        Permission::create(['name' => 'modulo_vacaciones']);
        Permission::create(['name' => 'modulo_documentos']);
        Permission::create(['name' => 'modulo_machotes']);
        Permission::create(['name' => 'catalogo_proveedores_de_retiro']);
        Permission::create(['name' => 'catalogo_departamentos_de_retiro']);
        Permission::create(['name' => 'catalogo_cuentas_de_retiro']);
        Permission::create(['name' => 'catalogo_de_usuarios']);
        Permission::create(['name' => 'crear_usuarios']);
        Permission::create(['name' => 'editar_usuarios']);
        Permission::create(['name' => 'eliminar_usuarios']);
        Permission::create(['name' => 'modulo_de_log']);
        Permission::create(['name' => 'enviar_notificacion_web']);

        //asignbar permisos al rol administrador
        $administrador->givePermissionTo('modulo_roles_permisos');
        $administrador->givePermissionTo('dashboard');
        $administrador->givePermissionTo('modulo_retiros');
        $administrador->givePermissionTo('modulo_transacciones');
        $administrador->givePermissionTo('cargar_transacciones');
        $administrador->givePermissionTo('crear_transacciones');
        $administrador->givePermissionTo('editar_transacciones');
        $administrador->givePermissionTo('eliminar_transacciones');
        $administrador->givePermissionTo('modulo_tareas');
        $administrador->givePermissionTo('modulo_cotizaciones');
        $administrador->givePermissionTo('modulo_proyectos');
        $administrador->givePermissionTo('modulo_bitacoras');
        $administrador->givePermissionTo('modulo_prospectos');
        $administrador->givePermissionTo('modulo_clientes');
        $administrador->givePermissionTo('modulo_vehiculos');
        $administrador->givePermissionTo('modulo_almacen');
        $administrador->givePermissionTo('modulo_aspirantes');
        $administrador->givePermissionTo('modulo_vacaciones');
        $administrador->givePermissionTo('modulo_documentos');
        $administrador->givePermissionTo('modulo_machotes');
        $administrador->givePermissionTo('catalogo_proveedores_de_retiro');
        $administrador->givePermissionTo('catalogo_departamentos_de_retiro');
        $administrador->givePermissionTo('catalogo_cuentas_de_retiro');
        $administrador->givePermissionTo('catalogo_de_usuarios');
        $administrador->givePermissionTo('crear_usuarios');
        $administrador->givePermissionTo('editar_usuarios');
        $administrador->givePermissionTo('eliminar_usuarios');
        $administrador->givePermissionTo('modulo_de_log');
        $administrador->givePermissionTo('enviar_notificacion_web');

        //asignbar permisos al rol gerente
        $gerente_ventas->givePermissionTo('dashboard');
        $gerente_ventas->givePermissionTo('modulo_tareas');
        $gerente_ventas->givePermissionTo('modulo_cotizaciones');
        $gerente_ventas->givePermissionTo('modulo_proyectos');
        $gerente_ventas->givePermissionTo('modulo_bitacoras');
        $gerente_ventas->givePermissionTo('modulo_prospectos');
        $gerente_ventas->givePermissionTo('modulo_clientes');
        $gerente_ventas->givePermissionTo('modulo_vehiculos');
        $gerente_ventas->givePermissionTo('modulo_almacen');
        $gerente_ventas->givePermissionTo('modulo_aspirantes');
        $gerente_ventas->givePermissionTo('modulo_documentos');
        $gerente_ventas->givePermissionTo('modulo_machotes');
        $gerente_ventas->givePermissionTo('catalogo_de_usuarios');

        //asignbar permisos al rol técnico
        $tecnico->givePermissionTo('modulo_tareas');
        $tecnico->givePermissionTo('modulo_documentos');
        $tecnico->givePermissionTo('modulo_machotes');
        $tecnico->givePermissionTo('modulo_bitacoras');

        $usuarios =  User::all();
        foreach ($usuarios as $usuario) {
            if ($usuario->rol->name != 'Cliente') {
                $usuario->assignRole($usuario->rol->name);
            }
        }
    }
}
