<?php
Route::group(['namespace' => 'Codwelt\codinstagram\controllers', 'prefix' => 'codinstagram'], function () {
    Route::get('/inicio', ['as' => 'CodinstagramInicio', 'uses' => 'codinstagramconrtoller@index']);
    //Rutas para la configuración de la conexion
    Route::get('/configuracion/{code?}', ['as' => 'CodinstagramConfig', 'uses' => 'CodinstagramConfigController@index']);
    Route::get('/testeo', ['as' => 'CodinstagramTest', 'uses' => 'CodinstagramConfigController@create']);
    Route::get('/Eliminar/{id}', ['as' => 'CodinstagramDelete', 'uses' => 'CodinstagramConfigController@destroy']);
    //Rutas para llamar con ajax
    Route::get('/obtener/datos/', ['as' => 'CodinstagramObDatos', 'uses' => 'codinstagramconrtoller@create']);
    Route::get('/obtener/comentarios/{id}', ['as' => 'CodinstagramObtComment', 'uses' => 'codinstagramconrtoller@comentarios']);
    // Rutas para registar o actualizar los datos de acceso a la api
    Route::get('/configuracion/agregando/{clientid}/{clientsecret}/{redirecturi}', ['as' => 'CodinstagramAgeregarClient', 'uses' => 'CodinstagramConfigController@AgregarCredenciales']);
    Route::get('/obtener/token/{clientid}/{redirecturi}', ['as' => 'CodinstagramObtenerToken', 'uses' => 'CodinstagramConfigController@obtenertoken']);
    Route::post('/configuracion/actualizar', ['as' => 'CodinstagramConfigActua', 'uses' => 'CodinstagramConfigController@update']);
});