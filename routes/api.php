<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
use Illuminate\Http\Request;

Route::get('login','ApiUserController@login')->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

