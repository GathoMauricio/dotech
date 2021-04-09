<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
use Illuminate\Http\Request;

Route::get('login','ApiUserController@login')->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/get_current_version', function (Request $request) {
    return [
        'currentVersion' => '1.0.7',
        'downloadLink' => getUrl().'/mobile/dotech_mobile_1-0-7.apk'
    ];
});

#menu
Route::middleware('auth:api')->get('menu_index','ApiMenuController@index')->name('menu_index');

#Tasks
Route::middleware('auth:api')->get('tasks_index','ApiTaskController@index')->name('tasks_index');
Route::middleware('auth:api')->get('tasks_show/{id}','ApiTaskController@show')->name('tasks_show');
Route::middleware('auth:api')->put('tasks_update/{id}','ApiTaskController@update')->name('tasks_update');
Route::middleware('auth:api')->delete('tasks_delete/{id}','ApiTaskController@destroy')->name('delete_update');
Route::middleware('auth:api')->post('tasks_store','ApiTaskController@store')->name('tasks_store');

#TaskChat
Route::middleware('auth:api')->get('task_chat_index/{id}','ApiTaskCommentController@index')->name('task_chat_index');
Route::middleware('auth:api')->post('task_chat_store','ApiTaskCommentController@store')->name('task_chat_store');

#Projects
Route::middleware('auth:api')->get('project_index','ApiProjectController@index')->name('project_index');
Route::middleware('auth:api')->get('projects_show/{id}','ApiProjectController@show')->name('projects_show');

#Binnacles
Route::middleware('auth:api')->get('binnacle_index/{id}','ApiBinnacleController@index')->name('binnacle_index');
Route::middleware('auth:api')->post('binnacle_create','ApiBinnacleController@store')->name('binnacle_create');
Route::middleware('auth:api')->get('binnacles_all','ApiBinnacleController@binnaclesAll')->name('binnacles_all');
Route::middleware('auth:api')->get('get_binnacle_projects','ApiBinnacleController@getBinnacleProjects')->name('get_binnacle_projects');

#Binnacle pdf
Route::middleware('auth:api')->get('binnacle_show_json/{id?}','ApiBinnacleController@show_json')->name('binnacle_show_json');
Route::middleware('auth:api')->post('send_binnacle_pdf','ApiBinnacleController@sendPdf')->name('send_binnacle_pdf');

#Binnacle Images
Route::middleware('auth:api')->get('binnacle_image_index/{id}','ApiBinnacleImageController@index')->name('binnacle_image_index');
Route::middleware('auth:api')->post('upload_binnacle_image','ApiBinnacleImageController@store')->name('upload_binnacle_image');

#Binnacle Firm
Route::middleware('auth:api')->post('binnacle_firm_store','ApiBinnacleController@storeFirm')->name('binnacle_firm_store');

#binnacle Feedback
Route::middleware('auth:api')->post('binnacle_feedback_store','ApiBinnacleController@storeFeedback')->name('binnacle_feedback_store');

#Users
Route::middleware('auth:api')->get('active_users','ApiUserController@activeUsers')->name('active_users');
Route::middleware('auth:api')->put('update_fcm_token','ApiUserController@UpdateFcmToken')->name('update_fcm_token');
Route::middleware('auth:api')->post('user_dounload_new_version','ApiUserController@userDounloadNewVersion')->name('user_dounload_new_version');

Route::middleware('auth:api')->get('expense_index','ApiExpenseController@index')->name('expense_index');
Route::middleware('auth:api')->post('expense_store','ApiExpenseController@store')->name('expense_store');
Route::middleware('auth:api')->put('update_expense_status','ApiExpenseController@update')->name('update_expense_status');
Route::middleware('auth:api')->delete('destroy_expense','ApiExpenseController@destroy')->name('destroy_expense');

#Vehicles
Route::middleware('auth:api')->get('vehicle_index','ApiVehicleController@index')->name('vehicle_index');

#Vehicle Histories
Route::middleware('auth:api')->get('vehicle_history_index','ApiVehicleHistoryController@index')->name('vehicle_history_index');
Route::middleware('auth:api')->post('vehicle_history_store','ApiVehicleHistoryController@store')->name('vehicle_history_store');

#Vehicle history images
Route::middleware('auth:api')->get('vehicle_history_image_index/{id}','ApiVehicleHistoryImageController@index')->name('vehicle_history_image_index');
Route::middleware('auth:api')->post('upload_vehicle_history_image','ApiVehicleHistoryImageController@store')->name('upload_vehicle_history_image');

#Receptions
Route::middleware('auth:api')->get('reception_index','ApiReceptionController@index')->name('reception_index');
Route::middleware('auth:api')->post('reception_store','ApiReceptionController@store')->name('reception_store');

#Companies
Route::middleware('auth:api')->get('company_index','ApiCompanyController@index')->name('company_index');
Route::middleware('auth:api')->get('company_show/{id}','ApiCompanyController@show')->name('company_show');