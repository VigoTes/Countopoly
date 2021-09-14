<?php

use App\Jugador;
use App\Partida;
use App\TransaccionMonetaria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/* RUTAS PARA INGRESO Y REGISTRO DE USUARIO Y CLIENTE */

Route::get('/ProbandoCosas',function(){

    return Partida::findOrFail(17)->getUltimaTransaccion();
    
    Jugador::where('codJugador','>','-1')->delete();
    Partida::where('codPartida','>','0')->delete();
    TransaccionMonetaria::where('codTransaccionMonetaria','>','0')->delete();

});

Route::get('/', 'UserController@home')->name('user.home');

Route::get('/login', 'UserController@verLogin')->name('user.verLogin'); //para desplegar la vista del Login
Route::post('/ingresar', 'UserController@logearse')->name('user.logearse'); //post

Route::get('/cerrarSesion','UserController@cerrarSesion')->name('user.cerrarSesion');

Route::get('/Partidas/listarPartidasEnEspera','PartidaController@listarPartidasEnEspera')->name('Partida.listarPartidasEnEspera');

Route::get('/Partida/getActualizacionListaPartidas/','PartidaController@invocarListaPartidasEnEspera')->name('Partida.invocarListaPartidasEnEspera');


Route::get('/Partida/SalaJuego/{codPartida}','PartidaController@EntrarSalaJuego')->name('Partida.EntrarSalaJuego');


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
Route::get('/Partida/getActualizacionPartida/','PartidaController@getActualizacionPartida');

Route::get('/Partida/getActualizacionSalaEspera/{codPartida}','PartidaController@getActualizacionSalaEspera');

Route::get('/Partida/HacerBancarioAJugador/{codJugador}','PartidaController@HacerBancarioAJugador')
    ->name('Partida.HacerBancarioAJugador');

Route::get('/Partida/CambiarEdicion/','PartidaController@CambiarEdicion')
    ->name('Partida.CambiarEdicion');


Route::get('/Partida/realizarPago/','PartidaController@realizarPago')->name('Partida.realizarPago');




/* CRUD Edicion */
Route::get('/Edicion/Listar','EdicionController@listarEdiciones')->name('Edicion.Listar');
Route::get('/Edicion/Editar/{codEdicion}','EdicionController@Editar')->name('Edicion.Editar');
Route::get('/Edicion/Eliminar/{codEdicion}','EdicionController@EliminarEdicion')->name('Edicion.Eliminar');

Route::post('/Edicion/ActualizarNombre','EdicionController@ActualizarNombre')->name('Edicion.ActualizarNombre');


/* CRUD PROPIEDAD */

Route::post('/Edicion/agregarEditarPropiedad','EdicionController@agregarEditarPropiedad')->name('Edicion.agregarEditarPropiedad');
Route::get('/Edicion/eliminarPropiedad/{codPropiedad}','EdicionController@eliminarPropiedad')->name('Edicion.eliminarPropiedad');

/* CRUD COLOR */
Route::get('/Color/Listar','ColorController@listarColores')->name('Color.Listar');
Route::post('/Color/agregarEditarColor','ColorController@agregarEditarColor')->name('Color.agregarEditarColor');
Route::get('/Color/eliminar/{codColor}','ColorController@Eliminar')->name('Color.Eliminar');
 




/* ****************************************************************************************************************************** */
/* ****************************************************************************************************************************** */
/* ****************************************************************************************************************************** */
/* ****************************************************************************************************************************** */
/* *********************************************         SISTEMA LINKS      ***************************************************** */
/* ****************************************************************************************************************************** */
/* ****************************************************************************************************************************** */
/* ****************************************************************************************************************************** */
/* ****************************************************************************************************************************** */


/* SISTEMA LINKS */
Route::post('/QRs/agregarEditarLink','LinkController@agregarEditarLink')->name('Link.agregarEditarLink');

Route::get('/QRs/eliminarLink/{codLink}','LinkController@eliminarLink')->name('Link.eliminarLink');

Route::get('/QRs/ListarLinks/','LinkController@ListarLinks')->name('Link.ListarLinks');


Route::get('/QRs/{string}','LinkController@verLink')->name('Link.Ver');

 //  "1gatosinventana.maracsoft.com/QRs/6a37adk282jy8k8y85"  // 13
 //  "1gatosinventana.maracsoft.com/QRs/a6a3s5yy80ykyyamaa"   //14 
 //  "1gatosinventana.maracsoft.com/QRs/a4a6367652aksa3baa"   //15
 //  "1gatosinventana.maracsoft.com/QRs/ad926a3612a5skaehj"   //16
 //  "1gatosinventana.maracsoft.com/QRs/e75as765s1daaksdaa"  
 //  "1gatosinventana.maracsoft.com/QRs/g08y0asg8yyky8y08b"   //18
 //  "1gatosinventana.maracsoft.com/QRs/se5a65s7ssd3as75ea"  
 //  "1gatosinventana.maracsoft.com/QRs/adsa5fmhf1d8yasaw5"   //20
 //  "1gatosinventana.maracsoft.com/QRs/bb5sadfhadsmfh3qu5"  
 //  "1gatosinventana.maracsoft.com/QRs/s57ebn63asyy8yty57"   //22
 //  "1gatosinventana.maracsoft.com/QRs/aw4fm6shsasada67aa"  
 //  "1gatosinventana.maracsoft.com/QRs/hfhm4fmhda58yky45h"   //24
 //  "1gatosinventana.maracsoft.com/QRs/c6fds46masflhm8458"  
 //  "1gatosinventana.maracsoft.com/QRs/ityrutkk5y8ky3udfd"   //26
