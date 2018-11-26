<?php

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

    Auth::routes();

    Route::resource('documentos','DocumentoController');
    Route::resource('consultar','BusquedaController');
    Route::resource('usuarios','UsuariosController');
    Route::post('enviarDocumento','DocumentoController@enviar')->name('enviarDocumento');
    Route::post('cambiarEstado','DocumentoController@estado')->name('cambiarEstado');
    Route::get('documento/detalleindex/{id}', 'DocumentoController@notificacion')->name('documento.detalleindex');
    Route::get('documentos.nuevo', array('as' => 'autocompletesPersona', 'uses' => 'DocumentoController@autocompletesPersona'));


    Route::get('detallesitem/{id}', 'BusquedaController@detalles')->name('detallesitem');
    Route::get('documentos/detallesindex/{id}', 'DocumentoController@show')->name('documentos.detallesindex');

    Route::resource('areas','AreasController'); /* AGREGAR*/
    Route::get('eliminar/areas/{id}','AreasController@destroy'); /* ELIMINAR CATEGORI */
    Route::get('datos/areas/{id}','AreasController@datos'); /* EDITAR CATEGORIA */


        Route::resource('home','HomeController');

    Route::get('eliminar/areas/{id}','AreasController@destroy'); /* ELIMINAR CATEGORI */
    Route::get('datos/areas/{id}','AreasController@datos'); /* EDITAR CATEGORIA */
    Route::get('data.areas', 'AreasController@dataCategoria')->name('data.areas'); /* AUTOCOMPLETE */

    Route::get('/home', 'HomeController@index')->name('home');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
