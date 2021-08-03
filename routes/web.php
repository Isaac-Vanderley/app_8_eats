<?php

use App\Http\Controllers\pagotarjetaopen;
use App\Http\Controllers\ReportesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});

Route::get('/uttec', function () {

	$nuevoNegocio = new Negocios();
});
/*Negocios */
Route::post('/guardar_negocio',[App\Http\Controllers\negociosController::class,'guardar']);
Route::get('/lista_negocios',[App\Http\Controllers\negociosController::class,'listar']);
Route::post('/editar_negocio',[App\Http\Controllers\negociosController::class,'editar']);
Route::get('/eliminar_negocio/{id_negocio}',[App\Http\Controllers\negociosController::class,'eliminar']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/negocios', [App\Http\Controllers\negociosController::class, 'vista'])->name('n.negocios');
/*Alimentos*/
Route::get('/alimentos', [App\Http\Controllers\alimentosController::class, 'vista'])->name('n.alimentos');
Route::post('/guardar_alimento',[App\Http\Controllers\alimentosController::class,'guardar']);
Route::get('/lista_alimentos',[App\Http\Controllers\alimentosController::class,'listar']);
Route::post('/editar_alimento',[App\Http\Controllers\alimentosController::class,'editar']);
Route::get('/eliminar_alimento/{id_alimento}',[App\Http\Controllers\alimentosController::class,'eliminar']);
Route::get('/descargar_archivo/{id_alimento}',[App\Http\Controllers\alimentosController::class,'verArchivo'])->name('n.verarchivo.alimento');

/*Clientes*/ 
Route::get('/clientes', [App\Http\Controllers\clientesController::class, 'vista'])->name('n.clientes')->middleware('valRol:admin');
Route::post('/guardar_cliente',[App\Http\Controllers\clientesController::class,'guardar']);
Route::get('/lista_clientes',[App\Http\Controllers\clientesController::class,'listar']);
Route::post('/editar_cliente',[App\Http\Controllers\clientesController::class,'editar']);
Route::get('/eliminar_cliente/{id_cliente}',[App\Http\Controllers\clientesController::class,'eliminar']);


Route::get('/empleados',[App\Http\Controllers\empleadosController::class,'vista'])->name('n.empleados');
Route::post('/ver_empleado',[App\Http\Controllers\empleadosController::class,'empleados']);



Route::get('/aviso', [App\Http\Controllers\avisoPrivacidad::class, 'vista'])->name('aviso');
Route::get('/reporte', [ReportesController::class,'ejecutarReporteNegocios']);
Route::get('/generarreporte', [ReportesController::class,'compilarReporteNegocios']);



Route::get('/log', function(){
	$message = "Prueba LOG";

	Log::emergency($message);
	Log::alert($message);
	Log::critical($message);
	Log::error($message);
	Log::warning($message);
	Log::notice($message);
	Log::info($message);
	Log::debug($message);

	return 'Proceso completo';

});



Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	 Route::get('pago_tarjeta', function () {return view('pages.page_pago');})->name('paginapago'); 
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::post('procesarpagotarjeta', [pagotarjetaopen::class, 'procesar']); 
	
});

