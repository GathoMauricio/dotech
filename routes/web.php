<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasPermissionTo('dashboard')) {
            return redirect('/dashboard');
        } else {
            return redirect('/wire_tasks');
        }
        return 'Unauthorized';
    } else {
        return view('auth.login');
    }
})->name('/');
Route::get('dashboard/{anio?}/{mes?}', 'DashboardController@index')->name('/dashboard')->middleware('permission:dashboard');

#Company
Route::get('company_index', 'CompanyController@index')->name('company_index')->middleware('auth');;
Route::get('company_index_ajax', 'CompanyController@indexAjax')->name('company_index_ajax')->middleware('auth');
Route::get('create_company', 'CompanyController@create')->name('create_company')->middleware('auth');
Route::post('store_company', 'CompanyController@store')->name('store_company')->middleware('auth');
Route::get('edit_company/{id}', 'CompanyController@edit')->name('edit_company')->middleware('auth');
Route::put('update_company/{id}', 'CompanyController@update')->name('update_company')->middleware('auth');
Route::get('delete_company/{id?}', 'CompanyController@destroy')->name('delete_company')->middleware('auth');
Route::get('cbo_all_companies', 'CompanyController@getCboItems')->name('cbo_all_companies')->middleware('auth');
Route::get('company_show_ajax', 'CompanyController@showAjax')->name('company_show_ajax')->middleware('auth');
Route::get('company_edit', 'CompanyController@edit')->name('company_edit')->middleware('auth');
Route::get('company_department_show_ajax', 'CompanyController@showCompanyDepartmentAjax')->name('company_department_show_ajax')->middleware('auth');

#CompanyRepository
Route::get('repository_company/{id}', 'CompanyRepositoryController@index')->name('repository_company')->middleware('auth');
Route::get('create_company_repository/{id}', 'CompanyRepositoryController@create')->name('create_company_repository')->middleware('auth');
Route::post('store_company_repository', 'CompanyRepositoryController@store')->name('store_company_repository')->middleware('auth');
Route::get('edit_company_repository/{id}', 'CompanyRepositoryController@edit')->name('edit_company_repository')->middleware('auth');
Route::put('update_company_repository/{id}', 'CompanyRepositoryController@update')->name('update_company_repository')->middleware('auth');
Route::get('destroy_company_repository/{id?}', 'CompanyRepositoryController@destroy')->name('destroy_company_repository')->middleware('auth');

#Company documents
Route::get('company_documents/{id}', 'CompanyDocumentController@index')->name('company_documents')->middleware('auth');
Route::post('store_company_document', 'CompanyDocumentController@store')->name('store_company_document')->middleware('auth');
Route::get('edit_company_document', 'CompanyDocumentController@edit')->name('edit_company_document')->middleware('auth');
Route::put('update_company_document', 'CompanyDocumentController@update')->name('update_company_document')->middleware('auth');
Route::get('delete_company_document/{id?}', 'CompanyDocumentController@destroy')->name('delete_company_document')->middleware('auth');

#CompanyFollow
Route::get('index_company_follow', 'CompanyFollowController@index')->name('index_company_follow')->middleware('auth');
Route::post('store_company_follow', 'CompanyFollowController@store')->name('store_company_follow')->middleware('auth');

#CompanyDepartment
Route::get('load_departments_by_id', 'CompanyDepartmentController@loadDepartemnsById')->name('load_departments_by_id')->middleware('auth');
Route::post('store_company_department', 'CompanyDepartmentController@store')->name('store_company_department')->middleware('auth');
#Sale
Route::get('show_sale/{id?}', 'SaleController@show')->name('show_sale')->middleware('auth');
Route::get('show_sale_ajax', 'SaleController@showAjax')->name('show_sale_ajax')->middleware('auth');
Route::post('store_sale', 'SaleController@store')->name('store_sale')->middleware('auth');
Route::get('edit_sale/{id}', 'SaleController@edit')->name('edit_sale')->middleware('auth');
Route::put('update_sale/{id}', 'SaleController@update')->name('update_sale')->middleware('auth');
Route::get('create_sale/{id?}', 'SaleController@createSale')->name('create_sale')->middleware('auth');
Route::put('update_status_sale', 'SaleController@updateStatus')->name('update_status_sale')->middleware('auth');
Route::get('delete_sale/{id?}', 'SaleController@destroy')->name('delete_sale')->middleware('auth');
Route::get('set_project_as_finish/{id?}', 'SaleController@setProjectAsFinish')->name('set_project_as_finish')->middleware('auth');

Route::get('quotes/{id}', 'SaleController@quotes')->name('quotes')->middleware('auth');
Route::get('projects/{id}', 'SaleController@projects')->name('projects')->middleware('auth');
Route::get('finalized/{id}', 'SaleController@finalized')->name('finalized')->middleware('auth');
Route::get('rejects/{id}', 'SaleController@rejects')->name('rejects')->middleware('auth');
Route::get('all_rejects', 'SaleController@allRejects')->name('all_rejects')->middleware('auth');
Route::get('index_quotes', 'SaleController@indexQuotes')->name('index_quotes')->middleware('auth');
Route::get('index_proyects', 'SaleController@indexProyects')->name('index_proyects')->middleware('auth');
Route::get('index_proyects_finished', 'SaleController@indexProyectsFinished')->name('index_proyects_finished')->middleware('auth');

Route::get('show_quote_ajax', 'SaleController@showAjax')->name('show_quote_ajax')->middleware('auth');
Route::put('update_quote', 'SaleController@updateQuote')->name('update_quote')->middleware('auth');
Route::get('quote_products/{id}', 'SaleController@quoteProducts')->name('quote_products')->middleware('auth');
Route::get('change_commision', 'SaleController@changeCommision')->name('change_commision')->middleware('auth');

#Quotes
Route::post('store_sale_by_company', 'SaleController@storeSaleByCompany')->name('store_sale_by_company')->middleware('auth');
Route::post('store_quote', 'SaleController@storeQuote')->name('store_quote')->middleware('auth');;
#Email
Route::get('send_sale', 'SaleController@sendSale')->name('send_sale')->middleware('auth');

#PDF Sale
Route::get('load_sale_pdf/{id?}', 'SaleController@loadPDF')->name('load_sale_pdf');

#Sale Follows
Route::get('sale_follows/{id}', 'SaleFollowController@index')->name('sale_follows')->middleware('auth');
Route::post('store_sale_follow', 'SaleFollowController@store')->name('store_sale_follow')->middleware('auth');
Route::get('delete_sale_follow/{id?}', 'SaleFollowController@destroy')->name('delete_sale_follow')->middleware('auth');

#Sale Foloww Ajax
Route::get('index_sale_follow', 'SaleFollowController@indexAjax')->name('index_sale_follow')->middleware('auth');
Route::post('store_sale_follow_ajax', 'SaleFollowController@storeAjax')->name('store_sale_follow_ajax')->middleware('auth');

#Sale Document
Route::post('store_sale_document', 'SaleDocumnetController@store')->name('store_sale_document')->middleware('auth');

#Sale Payment
Route::post('store_sale_payment', 'SalePaymentController@store')->name('store_sale_payment')->middleware('auth');

#Sale Projects
Route::get('search_project_ajax', 'SaleController@searchProjectAjax')->name('search_project_ajax')->middleware('auth');
Route::get('search_project_ajax2', 'SaleController@searchProjectAjax2')->name('search_project_ajax2')->middleware('auth');
Route::get('search_project_f_ajax', 'SaleController@searchProjectFAjax')->name('search_project_f_ajax')->middleware('auth');
Route::get('show_project_ajax', 'SaleController@showProjectAjax')->name('show_project_ajax')->middleware('auth');

#Sale Quotes
Route::get('search_quote_ajax', 'SaleController@searchQuoteAjax')->name('search_quote_ajax')->middleware('auth');
Route::get('search_quote_ajax2', 'SaleController@searchQuoteAjax2')->name('search_quote_ajax2')->middleware('auth');
Route::get('show_quote_modal_ajax', 'SaleController@showQuoteAjax')->name('show_quote_modal_ajax')->middleware('auth');

#Products
Route::post('store_product', 'ProductSaleController@store')->name('store_product')->middleware('auth');
Route::get('show_product_ajax', 'ProductSaleController@showAjax')->name('show_product_ajax')->middleware('auth');
Route::put('update_product', 'ProductSaleController@update')->name('update_product')->middleware('auth');
Route::get('delete_product/{id?}', 'ProductSaleController@destroy')->name('delete_product')->middleware('auth');

#Whitdrawal
Route::get('whitdrawal_index', 'WhitdrawalController@index')->name('whitdrawal_index')->middleware('auth');
Route::get('whitdrawal_aproved', 'WhitdrawalController@indexAproved')->name('whitdrawal_aproved')->middleware('auth');
Route::get('whitdrawal_disaproved', 'WhitdrawalController@indexDisaproved')->name('whitdrawal_disaproved')->middleware('auth');
Route::post('store_sale_whitdrawal', 'WhitdrawalController@store')->name('store_sale_whitdrawal')->middleware('auth');
Route::post('store_whitdrawal_document', 'WhitdrawalController@uploadDocument')->name('store_whitdrawal_document')->middleware('auth');
Route::post('apreove_withdrawal', 'WhitdrawalController@aprove')->name('apreove_withdrawal')->middleware('auth');;
Route::get('disaprove_whitdrawal/{id?}', 'WhitdrawalController@disaproveWithdrawal')->name('disaprove_whitdrawal')->middleware('auth');
Route::get('delete_whitdrawal/{id?}', 'WhitdrawalController@destroy')->name('delete_whitdrawal')->middleware('auth');
Route::get('show_whitdrawal', 'WhitdrawalController@show')->name('show_whitdrawal')->middleware('auth');
Route::get('search_whitdrawal_ajax', 'WhitdrawalController@searchWhitdrawalAjax')->name('search_whitdrawal_ajax')->middleware('auth');
Route::get('search_whitdrawal_ajax2', 'WhitdrawalController@searchWhitdrawalAjax2')->name('search_whitdrawal_ajax2')->middleware('auth');
Route::get('show_whitdrawal_ajax', 'WhitdrawalController@showWhitdrawalAjax')->name('show_whitdrawal_ajax')->middleware('auth');
Route::get('updateWhitdrawalFolio', 'WhitdrawalController@updateWhitdrawalFolio')->name('updateWhitdrawalFolio')->middleware('auth');
Route::get('update_whitdrawal_folio', 'WhitdrawalController@updateWhitdrawalFolio')->name('update_whitdrawal_folio')->middleware('auth');
Route::get('update_whitdrawal_paid', 'WhitdrawalController@updateWhitdrawalPaid')->name('update_whitdrawal_paid')->middleware('auth');
Route::get('show_whitdrawal_by_project/{id}', 'WhitdrawalController@showByProject')->name('show_whitdrawal_by_project')->middleware('auth');

#whitdrawal provider
Route::post('store_whitdrawal_provider', 'WhitdrawalProviderController@store')->name('store_whitdrawal_provider')->middleware('auth');

#witdrawal department
Route::get('index_department', 'WhitdrawalDepartmentController@index')->name('index_department')->middleware('permission:catalogo_departamentos_de_retiro');
Route::get('create_department', 'WhitdrawalDepartmentController@create')->name('create_department')->middleware('auth');
Route::post('store_department', 'WhitdrawalDepartmentController@store')->name('store_department')->middleware('auth');
Route::get('edit_department/{id}', 'WhitdrawalDepartmentController@edit')->name('edit_department')->middleware('auth');
Route::put('update_department/{id}', 'WhitdrawalDepartmentController@update')->name('update_department')->middleware('auth');
Route::get('delete_department/{id?}', 'WhitdrawalDepartmentController@destroy')->name('delete_department')->middleware('auth');

#witdrawal account
Route::get('index_account', 'WhitdrawalAccountController@index')->name('index_account')->middleware('permission:catalogo_cuentas_de_retiro');
Route::get('create_account', 'WhitdrawalAccountController@create')->name('create_account')->middleware('auth');
Route::post('store_account', 'WhitdrawalAccountController@store')->name('store_account')->middleware('auth');
Route::get('edit_account/{id}', 'WhitdrawalAccountController@edit')->name('edit_account')->middleware('auth');
Route::put('update_account/{id}', 'WhitdrawalAccountController@update')->name('update_account')->middleware('auth');
Route::get('delete_account/{id?}', 'WhitdrawalAccountController@destroy')->name('delete_account')->middleware('auth');

#Task
Route::get('task_index', 'TaskController@index')->name('task_index')->middleware('auth');
Route::get('task_archived_index', 'TaskController@archivedIndex')->name('task_archived_index')->middleware('auth');
Route::get('task_index_ajax', 'TaskController@indexAjax')->name('task_index_ajax')->middleware('auth');
Route::get('task_archived_index_ajax', 'TaskController@archivedIndexdAjax')->name('task_archived_index_ajax')->middleware('auth');
Route::get('task_create', 'TaskController@create')->name('task_create')->middleware('auth');
Route::post('task_store', 'TaskController@store')->name('task_store')->middleware('auth');;
Route::get('show_task_ajax', 'TaskController@showAjax')->name('show_task_ajax')->middleware('auth');
Route::get('task_edit/{id}', 'TaskController@edit')->name('task_edit')->middleware('auth');
Route::put('task_update/{id}', 'TaskController@update')->name('task_update')->middleware('auth');
Route::put('task_archive_ajax', 'TaskController@archive')->name('task_archive_ajax')->middleware('auth');
Route::delete('task_destroy_ajax', 'TaskController@destroyAjax')->name('task_destroy_ajax')->middleware('auth');
Route::put('set_task_status', 'TaskController@setTaskStatus')->name('set_task_status')->middleware('auth');

#Task Comments
Route::get('index_task_comment_ajax', 'TaskCommentController@indexAjax')->name('index_task_comment_ajax');
Route::post('store_task_comment_ajax', 'TaskCommentController@storeAjax')->name('store_task_comment_ajax');
#Projects
Route::post('store_project_ajax', 'ProjectController@storeAjax')->name('store_project_ajax')->middleware('auth');;
//Route::get('show_project_ajax','ProjectController@showAjax')->name('show_project_ajax')->middleware('auth');
Route::put('update_project_ajax', 'ProjectController@updateAjax')->name('update_project_ajax')->middleware('auth');

#Logs
Route::get('log_index', 'SysLogsController@index')->name('log_index')->middleware('permission:modulo_de_log');

#config
Route::get('config_index', 'ConfigController@index')->name('config_index')->middleware('auth');

#users
Route::get('show_user/{user}', 'UserController@show')->name('show_user')->middleware('permission:catalogo_de_usuarios');
Route::put('update_user_password', 'UserController@updatePassword')->name('update_user_password')->middleware('auth');
Route::get('show_user_ajax', 'UserController@showAjax')->name('show_user_ajax')->middleware('auth');
Route::put('update_user_name', 'UserController@updateUserName')->name('update_user_name')->middleware('auth');
Route::put('update_image_user', 'UserController@updateUserImage')->name('update_image_user')->middleware('auth');
Route::get('index_user/{search?}', 'UserController@index')->name('index_user')->middleware('permission:catalogo_de_usuarios');
Route::get('create_user', 'UserController@create')->name('create_user')->middleware('permission:crear_usuarios');
Route::post('store_user', 'UserController@store')->name('store_user')->middleware('permission:crear_usuarios');
Route::get('edit_user/{id}', 'UserController@edit')->name('edit_user')->middleware('permission:editar_usuarios');
Route::put('update_user/{id}', 'UserController@update')->name('update_user')->middleware('permission:editar_usuarios');
Route::delete('delete_user/{id?}', 'UserController@destroy')->name('delete_user')->middleware('permission:eliminar_usuarios');
Route::put('update_my_password', 'UserController@updateMyPassword')->name('update_my_password')->middleware('auth');
Route::put('update_password_admin', 'UserController@updatePasswordAdmin')->name('update_password_admin')->middleware('permission:editar_usuarios');
Route::get('update_evaluation_test', 'UserController@updateEvaluationTest')->name('update_evaluation_test')->middleware('auth');
Route::get('cambiar_estatus_vacacion', 'VacacionController@cambiarEstatus')->name('cambiar_estatus_vacacion')->middleware('auth');;
Route::post('solicitar_vacaciones', 'VacacionController@solicitarVacaciones')->name('solicitar_vacaciones')->middleware('auth');;

#User Documents
Route::post('store_user_document', 'UserDocumentController@store')->name('store_user_document')->middleware('auth');
Route::get('delete_user_document/{id?}', 'UserDocumentController@destroy')->name('delete_user_document')->middleware('auth');
#providers
Route::get('provider_index', 'WhitdrawalProviderController@index')->name('provider_index')->middleware('permission:catalogo_proveedores_de_retiro');
Route::get('edit_provider/{id}', 'WhitdrawalProviderController@edit')->name('edit_provider')->middleware('auth');
Route::put('update_provider/{id}', 'WhitdrawalProviderController@update')->name('update_provider')->middleware('auth');
Route::get('delete_provider/{id?}', 'WhitdrawalProviderController@destroy')->name('delete_provider')->middleware('auth');

#services
Route::get('index_service', 'ServiceController@index')->name('index_service')->middleware('auth');
Route::get('processing_service', 'ServiceController@processing')->name('processing_service')->middleware('auth');
Route::get('finished_service', 'ServiceController@finished')->name('finished_service')->middleware('auth');
Route::get('canceled_service', 'ServiceController@canceled')->name('canceled_service')->middleware('auth');
Route::get('show_service/{id}', 'ServiceController@show')->name('show_service')->middleware('auth');
Route::get('create_service', 'ServiceController@create')->name('create_service')->middleware('auth');
Route::post('store_service', 'ServiceController@store')->name('store_service')->middleware('auth');
Route::get('edit_service/{id}', 'ServiceController@edit')->name('edit_service')->middleware('auth');
Route::get('delete_service', 'ServiceController@destroy')->name('delete_service')->middleware('auth');

#Service Follows
Route::get('index_service_follow', 'ServiceFollowController@index')->name('index_service_follow')->middleware('auth');
Route::post('store_service_follow', 'ServiceFollowController@store')->name('store_service_follow')->middleware('auth');

#Service images
Route::get('show_service_image', 'ServiceImageController@show')->name('show_service_image')->middleware('auth');

#Binnacles
Route::get('index_binnacle', 'BinnacleController@index')->name('index_binnacle')->middleware('auth');
Route::get('create_binnacle', 'BinnacleController@create')->name('create_binnacle')->middleware('auth');
Route::get('delete_binnacle/{id?}', 'BinnacleController@destroy')->name('delete_binnacle')->middleware('auth');
Route::any('store_binnacle/{id?}', 'BinnacleController@store')->name('store_binnacle')->middleware('auth');
Route::get('binnacle_show_json/{id?}', 'BinnacleController@show_json')->name('binnacle_show_json')->middleware('auth');
Route::post('send_binnacle_pdf', 'BinnacleController@sendPdf')->name('send_binnacle_pdf')->middleware('auth');
Route::post('send_all_binnacle_pdf', 'BinnacleController@sendAllPdf')->name('send_all_binnacle_pdf')->middleware('auth');
Route::get('binnacles_by_project/{id}', 'BinnacleController@indexByProject')->name('binnacles_by_project')->middleware('auth');
Route::get('search_binnacle_ajax', 'BinnacleController@searchBinnacleAjax')->name('search_binnacle_ajax')->middleware('auth');
Route::get('show_binnacle_ajax', 'BinnacleController@showBinnacleAjax')->name('show_binnacle_ajax')->middleware('auth');
Route::get('asignar_compania_bitacora', 'BinnacleController@asignarCompaniaBitacora')->name('asignar_compania_bitacora')->middleware('auth');
Route::get('asignar_alias_bitacora', 'BinnacleController@asignarAliasBitacora')->name('asignar_alias_bitacora')->middleware('auth');


#Binnacle PDF
Route::get('binnacle_pdf/{id}', 'BinnacleController@makePdf')->name('binnacle_pdf');

#Binnacles Images
Route::get('show_binnacle_image/{id?}', 'BinnacleImageController@show')->name('show_binnacle_image')->middleware('auth');
Route::get('binnacle_images_index/{id?}', 'BinnacleImageController@index')->name('binnacle_images_index')->middleware('auth');
Route::post('store_binnacle_image', 'BinnacleImageController@store')->name('store_binnacle_image')->middleware('auth');
Route::put('update_binnacle_image/{id}', 'BinnacleImageController@update')->name('update_binnacle_image')->middleware('auth');
Route::delete('delete_binnacle_image/{id?}', 'BinnacleImageController@destroy')->name('delete_binnacle_image')->middleware('auth');
Route::get('binnacle_images/{id}', 'BinnacleImageController@binnacleImages')->name('binnacle_images');

#Vehicles
Route::get('vehicle_index', 'VehicleController@index')->name('vehicle_index')->middleware('auth');
Route::get('create_vehicle', 'VehicleController@create')->name('create_vehicle')->middleware('auth');
Route::post('vehicle_store', 'VehicleController@store')->name('vehicle_store')->middleware('auth');
Route::get('vehicle_show/{id}', 'VehicleController@show')->name('vehicle_show')->middleware('auth');
Route::get('vehicle_edit/{id}', 'VehicleController@edit')->name('vehicle_edit')->middleware('auth');
Route::put('vehicle_update/{id}', 'VehicleController@update')->name('vehicle_update')->middleware('auth');
Route::get('vehicle_destroy/{id?}', 'VehicleController@destroy')->name('vehicle_destroy')->middleware('auth');
Route::get('pdf_inventario/{id?}', 'VehicleController@pdfInventario')->name('pdf_inventario')->middleware('auth');
Route::get('pdf_mantenimientos/{id}', 'VehicleController@mantenimientosPdf')->name('pdf_mantenimientos')->middleware('auth');
#Vehicles Images
Route::post('store_vehicle_image', 'VehicleImageController@store')->name('store_vehicle_image')->middleware('auth');
Route::get('vehicle_image_destroy/{id?}', 'VehicleImageController@destroy')->name('vehicle_image_destroy')->middleware('auth');

#Maintenances
Route::get('maintenance_show/{id}', 'MaintenanceController@show')->name('maintenance_show')->middleware('auth');
Route::post('maintenance_store', 'MaintenanceController@store')->name('maintenance_store')->middleware('auth');
Route::get('maintenance_edit/{id}', 'MaintenanceController@edit')->name('maintenance_edit')->middleware('auth');
Route::put('maintenance_update/{id}', 'MaintenanceController@update')->name('maintenance_update')->middleware('auth');
Route::get('maintenance_destroy/{id?}', 'MaintenanceController@destroy')->name('maintenance_destroy')->middleware('auth');

#Maintenance images
Route::post('store_maintenance_image', 'MaintenanceImageController@store')->name('store_maintenance_image')->middleware('auth');
Route::get('delete_maintenance_image/{id?}', 'MaintenanceImageController@destroy')->name('delete_maintenance_image')->middleware('auth');

#Vehicle histories
Route::get('vehicle_history_show/{id}', 'VehicleHistoryController@show')->name('vehicle_history_show')->middleware('auth');

#Vehicle verifications
Route::post('store_vehicle_verification', 'VehicleVerificationController@store')->name('store_vehicle_verification')->middleware('auth');

#Vehicle documents
Route::post('store_vehicle_document', 'VehicleDocumentController@store')->name('store_vehicle_document')->middleware('auth');

#Stock products
Route::get('stock_product_index', 'StockProductController@index')->name('stock_product_index')->middleware('auth');
Route::get('stock_product_create', 'StockProductController@create')->name('stock_product_create')->middleware('auth');
Route::post('stock_product_store', 'StockProductController@store')->name('stock_product_store')->middleware('auth');
Route::get('stock_product_edit/{id}', 'StockProductController@edit')->name('stock_product_edit')->middleware('auth');
Route::put('stock_product_update/{id}', 'StockProductController@update')->name('stock_product_update')->middleware('auth');
Route::get('stock_product_delete/{id?}', 'StockProductController@destroy')->name('stock_product_delete')->middleware('auth');

#Stock product category
Route::post('store_category_product', 'StockProductCategoryController@store')->name('store_category_product')->middleware('auth');

#Stock product exit
Route::get('stock_product_exit_index/{id}', 'StockProductExitController@index')->name('stock_product_exit_index')->middleware('auth');
Route::get('delete_stock_product_exit_route/{id?}', 'StockProductExitController@destroy')->name('delete_stock_product_exit_route')->middleware('auth');

#stock product images
Route::post('store_stock_product_image', 'StockProductImageController@store')->name('store_stock_product_image')->middleware('auth');
Route::delete('delete_stock_product_image/{id?}', 'StockProductImageController@destroy')->name('delete_stock_product_image')->middleware('auth');


#Product exits
Route::get('product_exits', 'StockProductExitController@indexExits')->name('product_exits')->middleware('auth');
Route::put('update_stock_product_exit_status', 'StockProductExitController@update')->name('update_stock_product_exit_status')->middleware('auth');
Route::get('delete_stock_product_exit/{id?}', 'StockProductExitController@destroy')->name('delete_stock_product_exit')->middleware('auth');

#Candidates
Route::get('candidates', 'CandidateController@index')->name('candidates')->middleware('auth');
Route::get('candidates_create', 'CandidateController@create')->name('candidates_create')->middleware('auth');
Route::get('candidates_edit/{id}', 'CandidateController@edit')->name('candidates_edit')->middleware('auth');
Route::post('candidates_store', 'CandidateController@store')->name('candidates_store')->middleware('auth');
Route::put('candidates_update/{id}', 'CandidateController@update')->name('candidates_update')->middleware('auth');
Route::get('candidates_destroy/{id?}', 'CandidateController@destroy')->name('candidates_destroy')->middleware('auth');

#UserTest
Route::post('store_user_test', 'UserTestController@store')->name('store_user_test')->middleware('auth');
Route::get('check_user_test/{id?}', 'UserTestController@checkUserTest')->name('check_user_test')->middleware('auth');
Route::get('generate_user_test/{id?}', 'UserTestController@generateUserTest')->name('generate_user_test')->middleware('auth');

#Dashboard
Route::get('change_graphic_month', 'DashboardController@changeGraphicMonth')->name('change_graphic_month')->middleware('auth');;


Route::get('test', function () {
    //return view('test');
    event(new \App\Events\NotificationEvent([
        'id' => 259,
        'msg' => "Prueba push",
        'route' => "Testing"
    ]));
})->name('test');



#Livewire Components
Route::group(['middleware' => ['auth']], function () {
    #Retiros
    Route::get('wire_whitdrawals', function () {
        return view('wire.whitdrawals.index');
    })->name('wire_whitdrawals')->middleware('permission:modulo_retiros');
    #Transacciones
    Route::get('wire_transactions', function () {
        return view('wire.transactions.index');
    })->name('wire_transactions')->middleware('permission:modulo_transacciones');
    #Tareas
    Route::get('wire_tasks', function () {
        return view('wire.tasks.index');
    })->name('wire_tasks')->middleware('permission:modulo_tareas');
    #Cotizaciones
    Route::get('wire_quotes', function () {
        return view('wire.quotes.index');
    })->name('wire_quotes')->middleware('permission:modulo_cotizaciones');
    #Proyectos
    Route::get('wire_projects', function () {
        return view('wire.projects.index');
    })->name('wire_projects')->middleware('permission:modulo_proyectos');
    #Bitácoras
    Route::get('wire_binnacles', function () {
        return view('wire.binnacles.index');
    })->name('wire_binnacles')->middleware('permission:modulo_bitacoras');
    #Compañias
    Route::get('wire_companies', function () {
        return view('wire.companies.index');
    })->name('wire_companies')->middleware('permission:modulo_retiros');
    #Vehiculos
    Route::get('wire_vehicles', function () {
        return view('wire.vehicles.index');
    })->name('wire_vehicles')->middleware('permission:modulo_vehiculos');
    #Almacen
    Route::get('wire_stocks', function () {
        return view('wire.stocks.index');
    })->name('wire_stocks')->middleware('permission:modulo_almacen');
    #Aspirantes
    Route::get('wire_candidates', function () {
        return view('wire.candidates.index');
    })->name('wire_candidates')->middleware('permission:modulo_aspirantes');
    #Documentos
    Route::get('wire_documents', function () {
        return view('wire.documents.index');
    })->name('wire_documents')->middleware('permission:modulo_documentos');
    #Machotes(Formularios)
    Route::get('wire_forms', function () {
        return view('wire.forms.index');
    })->name('wire_forms')->middleware('permission:modulo_machotes');
});

Route::get('clients_login', 'ClientController@showLoginForm')->name('clients_login');
Route::post('clients_login', 'ClientController@login')->name('clients_login');
Route::get('clients_dashboard', 'ClientController@dashboard')->name('clients_dashboard');
Route::post('clients_logout', 'ClientController@logout')->name('clients_logout');
Route::get('binnacle_pdf_client/{id}', 'ClientController@makePdf')->name('binnacle_pdf_client');

Route::get('notificar', function () {
    event(new \App\Events\NotificationEvent([
        'id' => 'landing',
        'titulo' => request('titulo'),
        'mensaje' => request('mensaje'),
    ]));
})->name('notificar');

Route::get('sat', function () {
    $res = validarCFDI('PET040903DH1', 'DTI100516SC5', '300', 'c1374385-d21e-440d-9e37-70c9f4cb57ef');
    //$res = validarCFDI('CIN960904FQ2','DTI100516SC5','306.94','cd9b0608-8540-4a74-a631-5999d71af7aa');
    return $res;
    $json = json_decode($res);
    return $json->CodigoEstatus;
})->name('sat');


#Exports
Route::group(['middleware' => ['auth']], function () {

    Route::get('export_cotizaciones/{anio}/{mes}', 'DashboardController@exportCotizaciones');
    Route::get('export_proyectos/{anio}/{mes}', 'DashboardController@exportProyectos');
    Route::get('export_proyectos_year', 'DashboardController@exportProyectosYear')->name('export_proyectos_year');
    Route::get('export_finalizados_year', 'DashboardController@exportFinalizadosYear')->name('export_finalizados_year');
    Route::get('export_finalizados/{anio}/{mes}', 'DashboardController@exportFinalizados');

    Route::post('store_origen', 'CompanyController@storeOrigen')->name('store_origen');
    Route::get('preview_proyecto', 'SaleController@showPreview');

    Route::get('prospecto_index', 'ProspectoController@index')->name('prospecto_index')->middleware('permission:modulo_prospectos');
    Route::get('editar_vendedor_cliente/{cliente_id?}/{vendedor_id?}', 'ClienteController@editarVendedorCliente')->name('editar_vendedor_cliente')->middleware('permission:editar_clientes');
    Route::post('store_prospecto', 'ProspectoController@store')->name('store_prospecto');
    Route::post('ajax_store_origen', 'ClienteOrigenController@ajaxStoreOrigen')->name('ajax_store_origen');
    Route::get('ajax_show_prospecto', 'ProspectoController@ajaxShowProspecto')->name('ajax_show_prospecto');
    Route::put('update_prospecto', 'ProspectoController@update')->name('update_prospecto');
    Route::get('ajax_open_seguimientos', 'ProspectoController@ajaxOpenSeguimientos')->name('ajax_open_seguimientos');
    Route::post('ajax_store_seguimiento_prospecto', 'ProspectoController@ajaxStoreSeguimientoProspecto');
    Route::get('ajax_eliminar_prospecto', 'ProspectoController@destroy');
    Route::get('reporte_mensual_cotizaciones_proyectos/{anio}/{mes}', 'DashboardController@reporteMensualCotizacionesProyectos');
    Route::get('last_dashboard', 'DashboardController@_index')->name('last_dashboard');
    Route::get('obtener_pendientes', 'DashboardController@obtenerPendientes')->name('obtener_pendientes');
    Route::get('obtener_pendientes_admin', 'DashboardController@obtenerPendientesAdmin')->name('obtener_pendientes_admin');

    Route::get('clientes', 'ClienteController@index')->name('clientes'); //->middleware('permission:modulo_clientes');
    Route::get('clientes.show/{id}', 'ClienteController@show')->name('clientes.show');
    Route::put('clientes.update/{id}', 'ClienteController@update')->name('clientes.update')->middleware('permission:editar_clientes');
    Route::delete('eliminar_cliente/{cliente_id}', 'ClienteController@destroy')->name('eliminar_cliente')->middleware('permission:eliminar_clientes');

    Route::post('iniciar_cotizacion/{id?}', 'CotizacionController@store')->name('iniciar_cotizacion');

    Route::get('proyecto.show/{id?}', 'ProyectoController@show')->name('proyecto.show');
    Route::post('solicitar_retiro', 'ProyectoController@solicitarRetiro')->name('solicitar_retiro');
    Route::post('subir_factura_retiro', 'ProyectoController@subirFacturaRetiro')->name('subir_factura_retiro');
    Route::put('actualizar_estatus_proyecto', 'ProyectoController@actualizarEstatus')->name('actualizar_estatus_proyecto');
    Route::put('actualizar_descripcion_proyecto', 'ProyectoController@actualizarDescripcion')->name('actualizar_descripcion_proyecto');

    Route::get('ajax_imagenes_bitacora', 'BitacoraController@ajaxIndex')->name('ajax_imagenes_bitacora');
    Route::delete('eliminar_retiro/{retiro_id}', 'RetiroController@destroy')->name('eliminar_retiro');

    Route::get('roles_permisos', 'RolesPermisoController@index')->name('roles_permisos')->middleware('permission:modulo_roles_permisos');
    Route::post('actualizar_roles_permisos', 'RolesPermisoController@updatePermisos')->name('actualizar_roles_permisos')->middleware('permission:modulo_roles_permisos');
    Route::get('exportar_ultimos_seguimientos', function () {
        return \Excel::download(new App\Exports\CompanyFollowsExport(), 'ultimos_seguimientos_' . date('Y-m-d_H-i') . '_.xlsx');
    })->name('exportar_ultimos_seguimientos');
});
