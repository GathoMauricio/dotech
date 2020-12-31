<?php
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

#Sale Whitdraw temporaly
Route::get('withdraw_request_index','WithdrawRequestController@index')->name('withdraw_request_index')->middleware('auth');

#Company
Route::get('company_index','CompanyController@index')->name('company_index')->middleware('auth');;
Route::get('company_index_ajax','CompanyController@indexAjax')->name('company_index_ajax')->middleware('auth');
Route::get('cbo_all_companies','CompanyController@getCboItems')->name('cbo_all_companies')->middleware('auth');
Route::get('company_show_ajax','CompanyController@showAjax')->name('company_show_ajax')->middleware('auth');
Route::get('company_edit','CompanyController@edit')->name('company_edit')->middleware('auth');
Route::get('company_department_show_ajax','CompanyController@showCompanyDepartmentAjax')->name('company_department_show_ajax')->middleware('auth');;

#CompanyFollow
Route::get('index_company_follow','CompanyFollowController@index')->name('index_company_follow')->middleware('auth');
Route::post('store_company_follow','CompanyFollowController@store')->name('store_company_follow')->middleware('auth');

#CompanyDepartment
Route::get('load_departments_by_id','CompanyDepartmentController@loadDepartemnsById')->name('load_departments_by_id')->middleware('auth');

#Sale
Route::get('show_sale/{id}','SaleController@show')->name('show_sale')->middleware('auth');
Route::post('store_sale','SaleController@store')->name('store_sale')->middleware('auth');
Route::get('edit_sale/{id}','SaleController@edit')->name('edit_sale')->middleware('auth');
Route::put('update_sale/{id}','SaleController@update')->name('update_sale')->middleware('auth');
Route::get('create_sale/{id?}','SaleController@createSale')->name('create_sale')->middleware('auth');
Route::put('update_status_sale','SaleController@updateStatus')->name('update_status_sale')->middleware('auth');
Route::get('delete_sale/{id?}','SaleController@destroy')->name('delete_sale')->middleware('auth');

Route::get('quotes/{id}','SaleController@quotes')->name('quotes')->middleware('auth');
Route::get('projects/{id}','SaleController@projects')->name('projects')->middleware('auth');
Route::get('finalized/{id}','SaleController@finalized')->name('finalized')->middleware('auth');
Route::get('rejects/{id}','SaleController@rejects')->name('rejects')->middleware('auth');
Route::get('index_quotes','SaleController@indexQuotes')->name('index_quotes')->middleware('auth');
Route::get('index_proyects','SaleController@indexProyects')->name('index_proyects')->middleware('auth');

Route::get('show_quote_ajax','SaleController@showAjax')->name('show_quote_ajax')->middleware('auth');
Route::put('update_quote','SaleController@updateQuote')->name('update_quote')->middleware('auth');
Route::get('quote_products/{id}','SaleController@quoteProducts')->name('quote_products')->middleware('auth');
Route::get('change_commision','SaleController@changeCommision')->name('change_commision')->middleware('auth');

#Quotes
Route::post('store_sale_by_company','SaleController@storeSaleByCompany')->name('store_sale_by_company')->middleware('auth');
Route::post('store_quote','SaleController@storeQuote')->name('store_quote')->middleware('auth');;
#Email
Route::get('send_sale/{id}','SaleController@sendSale')->name('send_sale')->middleware('auth');

#PDF Sale
Route::get('load_sale_pdf/{id}','SaleController@loadPDF')->name('load_sale_pdf')->middleware('auth');

#Sale Follows
Route::get('sale_follows/{id}','SaleFollowController@index')->name('sale_follows')->middleware('auth');
Route::post('store_sale_follow','SaleFollowController@store')->name('store_sale_follow')->middleware('auth');
Route::get('delete_sale_follow/{id?}','SaleFollowController@destroy')->name('delete_sale_follow')->middleware('auth');

#Sale Document 
Route::post('store_sale_document','SaleDocumnetController@store')->name('store_sale_document')->middleware('auth');

#Sale Payment
Route::post('store_sale_payment','SalePaymentController@store')->name('store_sale_payment')->middleware('auth');

#Products
Route::post('store_product','ProductSaleController@store')->name('store_product')->middleware('auth');
Route::get('show_product_ajax','ProductSaleController@showAjax')->name('show_product_ajax')->middleware('auth');
Route::put('update_product','ProductSaleController@update')->name('update_product')->middleware('auth');
Route::get('delete_product/{id?}','ProductSaleController@destroy')->name('delete_product')->middleware('auth');

#Whitdrawal
Route::post('store_sale_whitdrawal','WhitdrawalController@store')->name('store_sale_whitdrawal')->middleware('auth');
Route::post('store_whitdrawal_document','WhitdrawalController@uploadDocument')->name('store_whitdrawal_document')->middleware('auth');
Route::post('apreove_withdrawal','WhitdrawalController@aprove')->name('apreove_withdrawal')->middleware('auth');;

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
    mysqli_set_charset ($conexion, 'utf8');
    $conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM comentario_venta";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $sql2 = "INSERT INTO sale_follows (
            id,
            sale_id,
            author_id,
            body,
            created_at,
            updated_at
        ) VALUES(
            $fila[id_comentario_venta],
            $fila[id_venta],
            $fila[id_empleado],
            '$fila[texto_comentario_venta]',
            '$fila[fecha_comentario_venta] $fila[hora_comentario_venta]',
            '$fila[fecha_comentario_venta] $fila[hora_comentario_venta]'
        );";
        //mysqli_query($conexion2,$sql2);
        echo $sql2."<br/>";
        
    }
    /*
    $unitarioV = 4567;
    $cantidad = 150;
    $desc = 10;
    $total = ($unitarioV * $cantidad)-((($unitarioV * $cantidad) * $desc) / 100);
    echo $total;
    */
    
})->name('helper');
