<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
	return view('layouts.layout');
});

Route::get('rutapublic', function () {
	return public_path();
});

Route::resource('cuenta', 'CuentaController');

Route::get('datatablecuenta', 'CuentaController@datatables');

Route::resource('subcuenta', 'SubCuentaController');

Route::resource('proveedor', 'ProveedoreController');

Route::post('carga/create', 'CargaController@create');

Route::post('carga/validarP9', 'CargaController@validarP9');

Route::post('carga/validarNp', 'CargaController@validarNp');

Route::resource('carga', 'CargaController');

Route::get('datatables', 'CargaController@datatables');

Route::resource('producto', 'ProductoController'); 

Route::get('datatablesproducto', 'ProductoController@datatables');

Route::resource('marca', 'MarcaController');

Route::resource('modelo', 'ModeloController');

Route::resource('agente', 'AgenteController');

Route::get('datatablesag', 'AgenteController@datatables');

Route::post('transferencia/validarCodigo', 'TransferenciaController@validarCodigo');

Route::resource('transferencia', 'TransferenciaController');

Route::get('datatablestrans', 'TransferenciaController@datatables');

Route::get('datatablestransindex', 'TransferenciaController@indextables');				

Route::resource('dependencia', 'DependenciaController');

Route::get('datatablesdepen', 'DependenciaController@datatables');

Route::get('stock', 'GeneralController@stock');

Route::post('stock', 'GeneralController@stock');

Route::get('datatables/{id}', 'GeneralController@datatables');


Route::get('p9/{id}', 'GeneralController@imprimirp9');

Route::get('tranf/{id}', 'GeneralController@imprimirTransferencia');

Route::get('salida/{id}', 'GeneralController@imprimirSalida');

Route::resource('deposito', 'DepositoController');

Route::get('datatablesdepo', 'DepositoController@datatables');

Route::resource('tipo_destino', 'TipoDestinoController');

Route::resource('salida_material', 'SalidaMaterialController');

Route::get('datatablessalindex', 'SalidaMaterialController@indextables');

Route::get('datatablessal', 'SalidaMaterialController@datatables');

//logueo

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::post('auth/login', ['as' => 'auth/login', 'uses' => 'Auth\AuthController@postLogin']);

Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);


Route::get('prueba', 'DbaseController@index');

Route::get('prueba1', 'DbaseController@prueba');