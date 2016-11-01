<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api','namespace'=>'Api'], function () {
	Route::get('/user', function (Request $request) {
    	return $request->user(); // Info del usuario logueado
	});
	Route::group(['prefix'=>'users'],function(){
		Route::get('/','UserCtrl@index');
		Route::get('/rango/{ini}','UserCtrl@index');
		Route::get('/{id}','UserCtrl@show');
		Route::post('/','UserCtrl@store');
		Route::post('/{id}','UserCtrl@update');
		Route::post('/{id}/del','UserCtrl@destroy');
		Route::get('/search/{info}','UserCtrl@search');
	});
});
