<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check())
    {
        return "logged";
    }else{
        return view('auth.login');
    }    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*
Route::get('helper',function(){
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    $conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM empleado";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        
        $sql2 = "INSERT INTO users (
            id,
            status_user_id,
            rol_user_id,
            location_user_id,
            name,
            middle_name,
            last_name,
            phone,
            emergency_phone,
            address,
            email,
            password,
            token,
            created_at,
            updated_at
        ) VALUES (
            $fila[id_empleado],
            $fila[id_estatus_empleado],
            $fila[id_rol_empleado],
            $fila[id_localidad_empleado],
            '$fila[nombre_empleado]',
            '$fila[apaterno_empleado]',
            '$fila[apaterno_empleado]',
            '$fila[telefono_empleado]',
            '$fila[telefono_emergencia_empleado]',
            '$fila[direccion_empleado]',
            '$fila[email_empleado]',
            '".bcrypt($fila['email_empleado'])."',
            '".\Str::random(64)."',
            '2020-11-25 00:23:36',
            '2020-11-25 00:23:36'
        );";
        mysqli_query($conexion2,$sql2);
        
        echo $fila['id_empleado'].'-'.$fila['nombre_empleado']."<br>";
    }
})->name('helper');
*/
