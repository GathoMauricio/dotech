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
        $whitdrawRequest = new \App\Http\Controllers\WithdrawRequestController();
        return $whitdrawRequest->index();
    }else{
        return view('auth.login');
    }    
})->name('/');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

#WhitdrawRequest
Route::get('withdraw_request_index','WithdrawRequestController@index')->name('withdraw_request_index')->middleware('auth');

#Task
Route::get('task_index','TaskController@index')->name('task_index')->middleware('auth');
Route::get('task_index_ajax','TaskController@indexAjax')->name('task_index_ajax')->middleware('auth');
Route::get('task_create','TaskController@create')->name('task_create')->middleware('auth');
Route::post('task_store','TaskController@store')->name('task_store')->middleware('auth');;
Route::get('show_task_ajax','TaskController@showAjax')->name('show_task_ajax')->middleware('auth');
#Projects
Route::post('store_project_ajax','ProjectController@storeAjax')->name('store_project_ajax')->middleware('auth');;

#users
Route::put('update_user_password','UserController@updatePassword')->name('update_user_password');

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
            '$fila[amaterno_empleado]',
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
