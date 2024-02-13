<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermisoController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name')->get();
        $permisos = Permission::all();
        return view('roles_permisos.index', compact('roles', 'permisos'));
    }

    public function updatePermisos(Request $request)
    {
        $rol = Role::find($request->rol);
        $rol->syncPermissions();
        if ($request->permisos) {
            foreach ($request->permisos as $permiso) {
                $rol->givePermissionTo($permiso);
            }
        }
        return $rol->name . " actualizado";
    }
}
