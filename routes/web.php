<?php
/*
Route::get('migecocasa','ScrapingController@index')->name('migecocasa');
Route::post('scraping_result','ScrapingController@result')->name('scraping_result');
Route::post('migeocasa_result_ajax','ScrapingController@result_ajax')->name('migeocasa_result_ajax');
Route::get('scraping_excel','ScrapingController@excel')->name('scraping_excel');
*/

Route::get('zip', function(){
    $files = glob('storage/*');
    \Madzipper::make('my.zip')->add($files)->close();
    return "files ziped";
})->name('zip');


Route::get('/', function () {
    if(Auth::check())
    {
        $whitdrawal = new \App\Http\Controllers\WhitdrawalController();
        return $whitdrawal->index();
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
Route::get('create_company','CompanyController@create')->name('create_company')->middleware('auth');
Route::post('store_company','CompanyController@store')->name('store_company')->middleware('auth');
Route::get('edit_company/{id}','CompanyController@edit')->name('edit_company')->middleware('auth');
Route::put('update_company/{id}','CompanyController@update')->name('update_company')->middleware('auth');
Route::get('delete_company/{id?}','CompanyController@destroy')->name('delete_company')->middleware('auth');
Route::get('cbo_all_companies','CompanyController@getCboItems')->name('cbo_all_companies')->middleware('auth');
Route::get('company_show_ajax','CompanyController@showAjax')->name('company_show_ajax')->middleware('auth');
Route::get('company_edit','CompanyController@edit')->name('company_edit')->middleware('auth');
Route::get('company_department_show_ajax','CompanyController@showCompanyDepartmentAjax')->name('company_department_show_ajax')->middleware('auth');

#CompanyRepository
Route::get('repository_company/{id}','CompanyRepositoryController@index')->name('repository_company')->middleware('auth');
Route::get('create_company_repository/{id}','CompanyRepositoryController@create')->name('create_company_repository')->middleware('auth');
Route::post('store_company_repository','CompanyRepositoryController@store')->name('store_company_repository')->middleware('auth');
Route::get('edit_company_repository/{id}','CompanyRepositoryController@edit')->name('edit_company_repository')->middleware('auth');
Route::put('update_company_repository/{id}','CompanyRepositoryController@update')->name('update_company_repository')->middleware('auth');
Route::get('destroy_company_repository/{id?}','CompanyRepositoryController@destroy')->name('destroy_company_repository')->middleware('auth');

#CompanyFollow
Route::get('index_company_follow','CompanyFollowController@index')->name('index_company_follow')->middleware('auth');
Route::post('store_company_follow','CompanyFollowController@store')->name('store_company_follow')->middleware('auth');

#CompanyDepartment
Route::get('load_departments_by_id','CompanyDepartmentController@loadDepartemnsById')->name('load_departments_by_id')->middleware('auth');
Route::post('store_company_department','CompanyDepartmentController@store')->name('store_company_department')->middleware('auth');
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
Route::get('send_sale','SaleController@sendSale')->name('send_sale')->middleware('auth');

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
Route::get('whitdrawal_index','WhitdrawalController@index')->name('whitdrawal_index')->middleware('auth');
Route::get('whitdrawal_aproved','WhitdrawalController@indexAproved')->name('whitdrawal_aproved')->middleware('auth');
Route::get('whitdrawal_disaproved','WhitdrawalController@indexDisaproved')->name('whitdrawal_disaproved')->middleware('auth');
Route::post('store_sale_whitdrawal','WhitdrawalController@store')->name('store_sale_whitdrawal')->middleware('auth');
Route::post('store_whitdrawal_document','WhitdrawalController@uploadDocument')->name('store_whitdrawal_document')->middleware('auth');
Route::post('apreove_withdrawal','WhitdrawalController@aprove')->name('apreove_withdrawal')->middleware('auth');;
Route::get('disaprove_whitdrawal/{id?}','WhitdrawalController@disaproveWithdrawal')->name('disaprove_whitdrawal')->middleware('auth');
Route::get('delete_whitdrawal/{id?}','WhitdrawalController@destroy')->name('delete_whitdrawal')->middleware('auth');
Route::get('show_whitdrawal','WhitdrawalController@show')->name('show_whitdrawal')->middleware('auth');


#whitdrawal provider
Route::post('store_whitdrawal_provider','WhitdrawalProviderController@store')->name('store_whitdrawal_provider')->middleware('auth');

#witdrawal department
Route::get('index_department','WhitdrawalDepartmentController@index')->name('index_department')->middleware('auth');
Route::get('create_department','WhitdrawalDepartmentController@create')->name('create_department')->middleware('auth');
Route::post('store_department','WhitdrawalDepartmentController@store')->name('store_department')->middleware('auth');
Route::get('edit_department/{id}','WhitdrawalDepartmentController@edit')->name('edit_department')->middleware('auth');
Route::put('update_department/{id}','WhitdrawalDepartmentController@update')->name('update_department')->middleware('auth');
Route::get('delete_department/{id?}','WhitdrawalDepartmentController@destroy')->name('delete_department')->middleware('auth');

#witdrawal account
Route::get('index_account','WhitdrawalAccountController@index')->name('index_account')->middleware('auth');
Route::get('create_account','WhitdrawalAccountController@create')->name('create_account')->middleware('auth');
Route::post('store_account','WhitdrawalAccountController@store')->name('store_account')->middleware('auth');
Route::get('edit_account/{id}','WhitdrawalAccountController@edit')->name('edit_account')->middleware('auth');
Route::put('update_account/{id}','WhitdrawalAccountController@update')->name('update_account')->middleware('auth');
Route::get('delete_account/{id?}','WhitdrawalAccountController@destroy')->name('delete_account')->middleware('auth');

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
Route::put('set_task_status','TaskController@setTaskStatus')->name('set_task_status')->middleware('auth');

#Task Comments
Route::get('index_task_comment_ajax','TaskCommentController@indexAjax')->name('index_task_comment_ajax');
Route::post('store_task_comment_ajax','TaskCommentController@storeAjax')->name('store_task_comment_ajax');
#Projects
Route::post('store_project_ajax','ProjectController@storeAjax')->name('store_project_ajax')->middleware('auth');;
Route::get('show_project_ajax','ProjectController@showAjax')->name('show_project_ajax')->middleware('auth');
Route::put('update_project_ajax','ProjectController@updateAjax')->name('update_project_ajax')->middleware('auth');

#Logs
Route::get('log_index','SysLogsController@index')->name('log_index')->middleware('auth');

#config
Route::get('config_index','ConfigController@index')->name('config_index')->middleware('auth');

#users
Route::put('update_user_password','UserController@updatePassword')->name('update_user_password')->middleware('auth');
Route::get('show_user_ajax','UserController@showAjax')->name('show_user_ajax')->middleware('auth');
Route::put('update_user_name','UserController@updateUserName')->name('update_user_name')->middleware('auth');
Route::put('update_image_user','UserController@updateUserImage')->name('update_image_user')->middleware('auth');
Route::get('index_user','UserController@index')->name('index_user')->middleware('auth');
Route::get('create_user','UserController@create')->name('create_user')->middleware('auth');
Route::post('store_user','UserController@store')->name('store_user')->middleware('auth');
Route::get('edit_user/{id}','UserController@edit')->name('edit_user')->middleware('auth');
Route::put('update_user/{id}','UserController@update')->name('update_user')->middleware('auth');
Route::get('delete_user/{id?}','UserController@destroy')->name('delete_user')->middleware('auth');
Route::put('update_my_password','UserController@updateMyPassword')->name('update_my_password')->middleware('auth');
Route::put('update_password_admin','UserController@updatePasswordAdmin')->name('update_password_admin')->middleware('auth');

#providers
Route::get('provider_index','WhitdrawalProviderController@index')->name('provider_index')->middleware('auth');
Route::get('edit_provider/{id}','WhitdrawalProviderController@edit')->name('edit_provider')->middleware('auth');
Route::put('update_provider/{id}','WhitdrawalProviderController@update')->name('update_provider')->middleware('auth');
Route::get('delete_provider/{id?}','WhitdrawalProviderController@destroy')->name('delete_provider')->middleware('auth');

#services
Route::get('index_service','ServiceController@index')->name('index_service')->middleware('auth');
Route::get('processing_service','ServiceController@processing')->name('processing_service')->middleware('auth');
Route::get('finished_service','ServiceController@finished')->name('finished_service')->middleware('auth');
Route::get('canceled_service','ServiceController@canceled')->name('canceled_service')->middleware('auth');
Route::get('show_service/{id}','ServiceController@show')->name('show_service')->middleware('auth');
Route::get('create_service','ServiceController@create')->name('create_service')->middleware('auth');
Route::post('store_service','ServiceController@store')->name('store_service')->middleware('auth');
Route::get('edit_service/{id}','ServiceController@edit')->name('edit_service')->middleware('auth');
Route::get('delete_service','ServiceController@destroy')->name('delete_service')->middleware('auth');

#Service Follows
Route::get('index_service_follow','ServiceFollowController@index')->name('index_service_follow')->middleware('auth');
Route::post('store_service_follow','ServiceFollowController@store')->name('store_service_follow')->middleware('auth');

#Service images
Route::get('show_service_image','ServiceImageController@show')->name('show_service_image')->middleware('auth');

#Binnacles
Route::get('index_binnacle','BinnacleController@index')->name('index_binnacle')->middleware('auth');
Route::get('create_binnacle','BinnacleController@create')->name('create_binnacle')->middleware('auth');

Route::post('store_binnacle/{id?}','BinnacleController@store')->name('store_binnacle')->middleware('auth');
Route::get('binnacle_show_json/{id?}','BinnacleController@show_json')->name('binnacle_show_json')->middleware('auth');
Route::post('send_binnacle_pdf','BinnacleController@sendPdf')->name('send_binnacle_pdf')->middleware('auth');

#Binnacle PDF
Route::get('binnacle_pdf/{id}','BinnacleController@makePdf')->name('binnacle_pdf')->middleware('auth');

#Binnacles Images
Route::get('show_binnacle_image/{id?}','BinnacleImageController@show')->name('show_binnacle_image')->middleware('auth');
Route::get('binnacle_images_index/{id?}','BinnacleImageController@index')->name('binnacle_images_index')->middleware('auth');
Route::post('store_binnacle_image','BinnacleImageController@store')->name('store_binnacle_image')->middleware('auth');
Route::put('update_binnacle_image/{id}','BinnacleImageController@update')->name('update_binnacle_image')->middleware('auth');
Route::delete('delete_binnacle_image/{id?}','BinnacleImageController@destroy')->name('delete_binnacle_image')->middleware('auth');

#Helpers
/*
Route::get('helper_sales',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    mysqli_set_charset ($conexion, 'utf8');
    //$conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM venta";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $status = '';
        switch($fila['id_estatus_venta'])
        {
            case 1: 
                $status = 'Pendiente';
            break;
            case 2: 
                $status = 'Proyecto';
            break;
            case 3: 
                $status = 'Rechazada';
            break;
            case 4: 
                $status = 'Finalizado';
            break;
        }
        $sql2 = "INSERT INTO sales(
            id,
            company_id,
            department_id,
            author_id,
            status,
            description,
            estimated,
            commision_percent,
            commision_pay,
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
            '$fila[precio_total_venta]',
            '$fila[comision_venta]',
            '$fila[total_comision]',
            '$fila[tiempo_entrega]',
            '$fila[incluye_envio]',
            '$fila[forma_pago]',
            '$fila[credito]',
            '$fila[divisa]',
            '$fila[observacion_venta]',
            '$fila[material_venta]',
            '$fila[ts_finalizado]',
            '$fila[fecha_cotizacion_venta] 00:00:00',
            '$fila[fecha_cotizacion_venta] 00:00:00'
            
        );";
        //mysqli_query($conexion2,$sql2);
        echo $sql2."<br/>";
        
    }
})->name('helper_sales');


Route::get('helper_sale_documents',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    mysqli_set_charset ($conexion, 'utf8');
    //$conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM documento_venta";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $sql2 = "INSERT INTO sale_documents(
            id,
            sale_id,
            description,
            document,
            inner_identifier,
            created_at,
            updated_at
        ) VALUES(
            $fila[id_documento_venta],
            $fila[id_venta],
            '$fila[descripcion_documento_venta]',
            '$fila[ruta_documento_venta]',
            '$fila[folio_interno_venta]',
            '".date('Y-m-d H:i:s')."',
            '".date('Y-m-d H:i:s')."'
            
        );";
        //mysqli_query($conexion2,$sql2);
        echo $sql2."<br/>";
        
    }
})->name('helper_sale_documents');


Route::get('helper_sale_follows',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    mysqli_set_charset ($conexion, 'utf8');
    //$conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM comentario_venta";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $sql2 = "INSERT INTO sale_follows(
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
})->name('helper_sale_follows');

Route::get('helper_sale_products',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    mysqli_set_charset ($conexion, 'utf8');
    //$conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM producto_venta";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $sql2 = "INSERT INTO product_sale(
            id,
            sale_id,

            measure,
            description,

            unity_price_buy,
            unity_price_sell,

            quantity,
            discount,

            total_buy,
            total_sell,

            utility,
            created_at,
            updated_at
        ) VALUES(
            $fila[id_producto_venta],
            $fila[id_venta],
            
            NULL,
            '".str_replace("'","",$fila['descripcion_producto'])."',

            '$fila[precio_compra_producto]',
            '$fila[precio_venta_producto]',

            '$fila[cantidad_producto_venta]',
            '$fila[descuento_producto_venta]',

            '$fila[precio_lista_producto]',
            '$fila[precio_lista_producto]',

            '$fila[utilidad_venta_producto]',

            '".date('Y-m-d H:i:s')."',
            '".date('Y-m-d H:i:s')."'

            
        );";
        //mysqli_query($conexion2,$sql2);
        echo $sql2."<br/>";
        
    }
})->name('helper_sale_products');


Route::get('helper_whitdrawals',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    mysqli_set_charset ($conexion, 'utf8');
    //$conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM retiro";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $status = '';
        switch($fila['id_estatus_retiro'])
        {
            case 1: 
                $status = 'Pendiente';
            break;
            case 2: 
                $status = 'Aprobado';
            break;
            case 3: 
                $status = 'Rechazado';
            break;
        }
        $type = '';
        switch($fila['id_tipo_retiro'])
        {
            case 1: 
                $type = 'Efectivo';
            break;
            case 2: 
                $type = 'Cheque';
            break;
            case 3: 
                $type = 'Transferencia';
            break;
        }
        $sql2 = "INSERT INTO whitdrawals(
            id,
            sale_id,
            whitdrawal_provider_id,
            whitdrawal_account_id,
            whitdrawal_department_id,
            

            status,
            type,
            description,
            quantity,
            invoive,
            document,


            created_at,
            updated_at
        ) VALUES(
            $fila[id_retiro],
            $fila[id_venta],
            $fila[id_proveedor],
            $fila[id_cuenta],
            $fila[id_departamento_retiro],

            '$status',
            '$type',
            '$fila[descripcion_retiro]',
            '$fila[precio_compra_retiro]',
            '$fila[con_sin_factura]',
            '$fila[documento_retiro]',

            '$fila[fecha_retiro] 00:00:00',
            '$fila[fecha_retiro] 00:00:00'
            
        );";
        //mysqli_query($conexion2,$sql2);
        echo $sql2."<br/>";
        
    }
})->name('helper_whitdrawals');


Route::get('helper_services',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    mysqli_set_charset ($conexion, 'utf8');
    //$conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM expediente";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $sql2 = "INSERT INTO services(
            id,
            author_id,
            technical_id,
            location_id,
            company_id,
            department_id,
            

            status,
            type,
            subject,
            description,
            feedback,
            
            programed_at,
            contacted_at,
            closed_at,


            created_at,
            updated_at
        ) VALUES(
            $fila[id_expediente],
            $fila[id_gerente_expediente],
            $fila[id_tecnico_expediente],
            $fila[id_localidad],
            $fila[id_compania],
            NULL,

            '$fila[id_estatus_expediente]',
            '$fila[id_tipo_expediente]',
            '$fila[asunto_expediente]',
            '$fila[problematica_expediente]',
            '$fila[solucion_expediente]',
            
            '$fila[fecha_expediente] $fila[hora_expediente]',
            '$fila[timestamp_contacto]',
            '$fila[timestamp_salida]',

            '$fila[timestamp_asignacion]',
            '$fila[timestamp_asignacion]'
            
        );";
        //mysqli_query($conexion2,$sql2);
        echo $sql2."<br/>";
        
    }
})->name('helper_services');
Route::get('helper_service_follows',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    mysqli_set_charset ($conexion, 'utf8');
    //$conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM comentario_expediente";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $sql2 = "INSERT INTO service_follows(
            id,
            service_id,
            author_id,
            body,
            created_at,
            updated_at
        ) VALUES(
            $fila[id_comentario_expediente],
            $fila[id_expediente],
            $fila[id_empleado],
            '$fila[texto_comentario_expediente]',
            '$fila[timestamp_comentario_expediente]',
            '$fila[timestamp_comentario_expediente]'
            
        );";
        //mysqli_query($conexion2,$sql2);
        echo $sql2."<br/>";
        
    }
})->name('helper_service_follows');
Route::get('helper_service_images',function(){
    
    $conexion = mysqli_connect("localhost", "root", "", "dotech");
    mysqli_set_charset ($conexion, 'utf8');
    //$conexion2 = mysqli_connect("localhost", "root", "", "dotech_laravel");
    $sql = "SELECT * FROM foto_expediente";
    $datos = mysqli_query($conexion,$sql);
    while($fila=mysqli_fetch_array($datos))
    {
        $sql2 = "INSERT INTO service_images(
            id,
            service_id,
            author_id,
            image,
            description,
            created_at,
            updated_at
        ) VALUES(
            $fila[id_foto_expediente],
            $fila[id_expediente],
            NULL,
            '$fila[ruta_foto_expediente]',
            '',
            '".date('Y-m-d H:i:s')."',
            '".date('Y-m-d H:i:s')."'
            
        );";
        //mysqli_query($conexion2,$sql2);
        echo $sql2."<br/>";
        
    }
})->name('helper_service_images');
*/