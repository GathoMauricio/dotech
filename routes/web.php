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

#Company
Route::get('company_index','CompanyController@index')->name('company_index')->middleware('auth');;
Route::get('company_index_ajax','CompanyController@indexAjax')->name('company_index_ajax')->middleware('auth');;
Route::get('cbo_all_companies','CompanyController@getCboItems')->name('cbo_all_companies')->middleware('auth');;

#CompanyFollow
Route::get('index_company_follow','CompanyFollowController@index')->name('index_company_follow')->middleware('auth');
Route::post('store_company_follow','CompanyFollowController@store')->name('store_company_follow')->middleware('auth');

#Sale
Route::get('show_sale/{id}','SaleController@show')->name('show_sale')->middleware('auth');
Route::get('quotes/{id}','SaleController@quotes')->name('quotes')->middleware('auth');
Route::get('projects/{id}','SaleController@projects')->name('projects')->middleware('auth');
Route::get('finalized/{id}','SaleController@finalized')->name('finalized')->middleware('auth');
Route::get('rejects/{id}','SaleController@rejects')->name('rejects')->middleware('auth');

#Task
Route::get('task_index','TaskController@index')->name('task_index')->middleware('auth');
Route::get('task_archived_index','TaskController@archivedIndex')->name('task_archived_index')->middleware('auth');
Route::get('task_index_ajax','TaskController@indexAjax')->name('task_index_ajax')->middleware('auth');
Route::get('task_archived_index_ajax','TaskController@archivedIndexdAjax')->name('task_archived_index_ajax')->middleware('auth');
Route::get('task_create','TaskController@create')->name('task_create')->middleware('auth');
Route::post('task_store','TaskController@store')->name('task_store')->middleware('auth');;
Route::get('show_task_ajax','TaskController@showAjax')->name('show_task_ajax')->middleware('auth');
Route::get('task_edit/{id}','TaskController@edit')->name('task_edit')->middleware('auth');
Route::put('task_update/{id}','TaskController@update')->name('task_update')->middleware('auth');
Route::put('task_archive_ajax','TaskController@archive')->name('task_archive_ajax')->middleware('auth');
Route::delete('task_destroy_ajax','TaskController@destroyAjax')->name('task_destroy_ajax')->middleware('auth');
#Task Comments
Route::get('index_task_comment_ajax','TaskCommentController@indexAjax')->name('index_task_comment_ajax');
Route::post('store_task_comment_ajax','TaskCommentController@storeAjax')->name('store_task_comment_ajax');
#Projects
Route::post('store_project_ajax','ProjectController@storeAjax')->name('store_project_ajax')->middleware('auth');;
Route::get('show_project_ajax','ProjectController@showAjax')->name('show_project_ajax')->middleware('auth');
Route::put('update_project_ajax','ProjectController@updateAjax')->name('update_project_ajax')->middleware('auth');
#users
Route::put('update_user_password','UserController@updatePassword')->name('update_user_password')->middleware('auth');
Route::get('show_user_ajax','UserController@showAjax')->name('show_user_ajax')->middleware('auth');

#Logs
Route::get('log_index','SysLogsController@index')->name('log_index')->middleware('auth');

Route::get('helper',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    $conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM venta";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $status = "";
        switch($fila['id_estatus_venta'])
        {
            case 1: $status="Pendiente"; break;
            case 2: $status="Proyecto"; break;
            case 3: $status="Rechazada"; break;
            case 4: $status="Finalizado"; break;
        }
        
        $sql2 = "INSERT INTO sales (
            id,
            company_id,
            department_id,
            author_id,
            status,
            description,
            investment,
            estimated,
            utility,
            iva,
            commision_percent,
            commision_pay,
            deadline,
            delivery_days,
            shipping,
            payment_type,
            credit,
            currency,
            observation,
            material,
            closed_at,
            created_at,
            updated_at
        ) VALUES(
            $fila[id_venta],
            $fila[id_compania],
            $fila[id_departamento_compania],
            $fila[id_empleado],
            '$status',
            '$fila[descripcion_venta]',
            '$fila[precio_total_compra_venta]',
            '$fila[precio_total_venta]',
            '$fila[utilidad_total_venta]',
            '$fila[total_con_iva]',
            '$fila[comision_venta]',
            '$fila[total_comision]',
            '$fila[vencimiento_cotizacion_venta]',
            '$fila[tiempo_entrega]',
            '$fila[incluye_envio]',
            '$fila[forma_pago]',
            '$fila[credito]',
            '$fila[divisa]',
            '$fila[observacion_venta]',
            '$fila[material_venta]',
            '$fila[ts_finalizado]',
            '$fila[fecha_cotizacion_venta] 00:00',
            '$fila[fecha_cotizacion_venta] 00:00'
        );";
        echo $sql2."<br/>";
        /*
        if(mysqli_query($conexion2,$sql2))
        {
            echo $status."<br>";
        }

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
        }
        */
    }
    
})->name('helper');
