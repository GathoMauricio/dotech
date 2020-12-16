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
    $sql = "SELECT * FROM comentario_compania";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $sql2 = "INSERT INTO company_follows (
            id,
            company_id,
            author_id,
            body,
            created_at,
            updated_at
        ) VALUES (
            $fila[id_comentario_compania],
            $fila[id_compania],
            $fila[id_empleado],
            '$fila[texto_comentario_compania]',
            '".$fila['fecha_comentario_compania']." ".$fila['hora_comentario_compania']."',
            '".$fila['fecha_comentario_compania']." ".$fila['hora_comentario_compania']."'
        )";
        //echo $fila['texto_comentario_compania']."<br><br>";
        echo $sql2." ".mysqli_query($conexion2,$sql2)."<br><br>";
    }
    
})->name('helper');

