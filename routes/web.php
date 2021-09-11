<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/* RUTAS PARA INGRESO Y REGISTRO DE USUARIO Y CLIENTE */


Route::get('/', 'UserController@home')->name('user.home');

Route::get('/login', 'UserController@verLogin')->name('user.verLogin'); //para desplegar la vista del Login
Route::post('/ingresar', 'UserController@logearse')->name('user.logearse'); //post

Route::get('/cerrarSesion','UserController@cerrarSesion')->name('user.cerrarSesion');

Route::get('/Partidas/listarPartidasEnEspera','PartidaController@listarPartidasEnEspera')->name('Partida.listarPartidasEnEspera');

Route::get('/Partida/getActualizacionListaPartidas/','PartidaController@invocarListaPartidasEnEspera')->name('Partida.invocarListaPartidasEnEspera');


Route::get('/Partida/EntrarSalaJuego/{codPartida}','PartidaController@EntrarSalaJuego')->name('Partida.EntrarSalaJuego');


//Ruta que te hace unirte a una sala de espera y te retorna la vista de esa sala 
Route::get('/Partidas/{codPartida}/SalaEspera/','PartidaController@IngresarSalaEspera')
    ->name('Partida.IngresarSalaEspera');


//Te hace salirte de la sala de espera de una partida, si eres el host, se cancela
Route::get('/Partidas/SalirmeDePartida/{codPartida}','PartidaController@SalirmeDePartida')
    ->name('Partida.SalirmeDePartida');


    //Vista para crear nueva partida
Route::get('/Partida/abrirPartida/','PartidaController@abrirPartida')->name('Partida.abrirPartida');

Route::get('/Partida/IniciarPartida/{codPartida}','PartidaController@IniciarPartida')->name('Partida.IniciarPartida');
Route::get('/Partida/CancelarPartida/{codPartida}','PartidaController@CancelarPartida')->name('Partida.CancelarPartida');

//INVOCABLES JS
Route::get('/Partida/getActualizacionPartida/{codUltimaTransaccion}','PartidaController@getActualizacionPartida');

Route::get('/Partida/getActualizacionSalaEspera/{codPartida}','PartidaController@getActualizacionSalaEspera');

Route::get('/Partida/HacerBancarioAJugador/{codJugador}','PartidaController@HacerBancarioAJugador')
    ->name('Partida.HacerBancarioAJugador');