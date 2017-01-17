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

	/** RUTAS ESTADO TABLE **/
	Route::group(['prefix'=>'estado','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','EstadoCtrl@index');
		Route::post('/','EstadoCtrl@store');
		Route::get('/{id}','EstadoCtrl@show');
		Route::put('/{id}','EstadoCtrl@update');
		Route::delete('/{id}','EstadoCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','EstadoCtrl@search');
		Route::get('/range/{ini}','EstadoCtrl@index');
	});

	/** RUTAS ESTADO CASA TABLE **/
	Route::group(['prefix'=>'estado_casa','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','EstadoCasaCtrl@index');
		Route::post('/','EstadoCasaCtrl@store');
		Route::get('/{id}','EstadoCasaCtrl@show');
		Route::put('/{id}','EstadoCasaCtrl@update');
		Route::delete('/{id}','EstadoCasaCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','EstadoCasaCtrl@search');
		Route::get('/range/{ini}','EstadoCasaCtrl@index');
	});

	/** RUTAS CASA TABLE **/
	Route::group(['prefix'=>'casa','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','CasaCtrl@index');
		Route::post('/','CasaCtrl@store');
		Route::get('/{id}','CasaCtrl@show');
		Route::put('/{id}','CasaCtrl@update');
		Route::delete('/{id}','CasaCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','CasaCtrl@search');
		Route::get('/range/{ini}','CasaCtrl@index');
	});

	/** RUTAS UBICACION TABLE **/
	Route::group(['prefix'=>'ubicacion','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','UbicacionCtrl@index');
		Route::post('/','UbicacionCtrl@store');
		Route::get('/{id}','UbicacionCtrl@show');
		Route::put('/{id}','UbicacionCtrl@update');
		Route::delete('/{id}','UbicacionCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','UbicacionCtrl@search');
		Route::get('/range/{ini}','UbicacionCtrl@index');
	});

	/** RUTAS CUADRA TABLE **/
	Route::group(['prefix'=>'cuadra','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','CuadraCtrl@index');
		Route::post('/','CuadraCtrl@store');
		Route::get('/{id}','CuadraCtrl@show');
		Route::put('/{id}','CuadraCtrl@update');
		Route::delete('/{id}','CuadraCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','CuadraCtrl@search');
		Route::get('/range/{ini}','CuadraCtrl@index');
	});

	/** RUTAS TERRITORIO TABLE **/
	Route::group(['prefix'=>'territorio','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','TerritorioCtrl@index');
		Route::post('/','TerritorioCtrl@store');
		Route::get('/{id}','TerritorioCtrl@show');
		Route::put('/{id}','TerritorioCtrl@update');
		Route::delete('/{id}','TerritorioCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','TerritorioCtrl@search');
		Route::get('/range/{ini}','TerritorioCtrl@index');
	});

	/** RUTAS GRUPO TABLE **/
	Route::group(['prefix'=>'grupo','middleware'=>'admin'],function(){
		//Basicos
		Route::get('/','GrupoCtrl@index');
		Route::post('/','GrupoCtrl@store');
		Route::get('/{id}','GrupoCtrl@show');
		Route::put('/{id}','GrupoCtrl@update');
		Route::delete('/{id}','GrupoCtrl@destroy');
		//Adicionales
		Route::get('/search/{info}','GrupoCtrl@search');
		Route::get('/range/{ini}','GrupoCtrl@index');
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
