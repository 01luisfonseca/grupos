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
	Route::resource('users','UserCtrl@store');
	Route::group(['prefix'=>'users'],function(){
		Route::get('/search/{info}','UserCtrl@search');
		Route::get('/rango/{ini}','UserCtrl@index');
	});
	Route::group(['prefix'=>'tipo'],function(){
		Route::post('/','TipoCtrl@store');
		Route::put('/{id}','TipoCtrl@update');
		Route::delete('/{id}','TipoCtrl@destroy');
		Route::get('/','TipoCtrl@index');
		Route::get('/{id}','TipoCtrl@show');
	});
});
