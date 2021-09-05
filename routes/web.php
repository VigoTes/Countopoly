<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/* RUTAS PARA INGRESO Y REGISTRO DE USUARIO Y CLIENTE */


Route::get('/', 'UserController@home')->name('user.home');

Route::get('/login', 'UserController@verLogin')->name('user.verLogin'); //para desplegar la vista del Login
Route::post('/ingresar', 'UserController@logearse')->name('user.logearse'); //post

Route::get('/cerrarSesion','UserController@cerrarSesion')->name('user.cerrarSesion');


Route::get('/Partidas/{codPartida}/IngresarSalaEspera/','PartidaController@IngresarSalaEspera')
    ->name('Partida.IngresarSalaEspera');

//INVOCABLES JS
Route::get('/Partida/getActualizacionPartida/{codUltimaTransaccion}','PartidaController@getActualizacionPartida');
