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

Route::group(['middleware' => ['auth:api','permited'],'namespace'=>'Api'], function () {
	Route::get('/user', function (Request $request) {
    	return $request->user(); // Info del usuario logueado
	});
	
	/** RUTAS EVENTLOG TABLE **/
	Route::group(['prefix'=>'eventlog'],function(){
		//Basicos
		Route::get('/','EventlogCtrl@index')->middleware('admin');
		Route::post('/','EventlogCtrl@store')->middleware('admin');
		Route::get('/{id}','EventlogCtrl@show')->middleware('admin');
		Route::put('/{id}','EventlogCtrl@update')->middleware('admin');
		Route::delete('/{id}','EventlogCtrl@destroy')->middleware('admin');
		//Adicionales
		Route::get('/search/{info}','EventlogCtrl@search')->middleware('admin');
		Route::get('/range/{ini}','EventlogCtrl@index')->middleware('admin');
		Route::get('/registro/usuario','EventlogCtrl@registro');
	});

	/** RUTAS OPTIONS TABLE **/
	Route::group(['prefix'=>'options','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','OptCtrl@index');
		Route::post('/','OptCtrl@store');
		Route::get('/{id}','OptCtrl@show');
		Route::put('/{id}','OptCtrl@update');
		Route::delete('/{id}','OptCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','OptCtrl@search');
		Route::get('/range/{ini}','OptCtrl@index');
	});

	/** RUTAS USERS TABLE **/
	Route::group(['prefix'=>'users','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','UserCtrl@index');
		Route::post('/','UserCtrl@store');
		Route::get('/{user}','UserCtrl@show');
		Route::put('/{user}','UserCtrl@update');
		Route::delete('/{user}','UserCtrl@destroy');
		//Adicionales
		Route::get('/count/elems','UserCtrl@count');
		Route::get('/search/{info}','UserCtrl@search');
		Route::get('/range/{ini}','UserCtrl@index');
		Route::put('/status/{user}/{status}','UserCtrl@modEstado');
	});

	/** RUTAS PERFIL TABLE **/
	Route::group(['prefix'=>'perfil'],function(){
		//Basicos
		Route::get('/','PerfilCtrl@show');
		Route::put('/','PerfilCtrl@update');
		//Adicionales
	});

	/** RUTAS TIPO_USUARIO TABLE **/
	Route::group(['prefix'=>'tuser','middleware'=>'admin'],function(){
		Route::post('/','TUserCtrl@store');
		Route::put('/{id}','TUserCtrl@update');
		Route::delete('/{id}','TUserCtrl@destroy');
		Route::get('/','TUserCtrl@index');
		Route::get('/{id}','TUserCtrl@show');
	});
});
