<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Debug;
use App\Http\Controllers\Controller;
use App\Jugador;
use App\PropiedadPartida;
use App\RespuestaAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropiedadPartidaController extends Controller
{
    public function getPartidasDeJugador($codPartida){
        $cuentaLogeada = Cuenta::getCuentaLogeada();
        $jugador = $cuentaLogeada->getJugadorPorPartida($codPartida);
        $listaMisPropiedades  = $jugador->getPropiedades();
        
        return view('Partidas.Invocables.inv_MisPropiedadesSelect',compact('listaMisPropiedades'));

    }

    //transfiere la propiedad de un jugador a otro
    public function transferirPropiedad(Request $request){
        
        try {
            DB::beginTransaction();
            $jugadorEmisor = Jugador::findOrFail($request->codJugadorEmisor);
            $jugadorReceptor= Jugador::findOrFail($request->codJugadorReceptor);
            $partida = $jugadorEmisor->getPartida();

            //verificamos que esté logeado el emisor 
            $cuentaLogeada = Cuenta::getCuentaLogeada();

            // Si el jug emisor no es de la cuenta logeada, ni es el banco 
            if($jugadorEmisor->codCuenta != $cuentaLogeada->codCuenta && $partida->codJugadorBanco != $jugadorEmisor->codJugador){
                throw new Exception("Ha ocurrido un error de verificacón.");
            }

            $propiedadPartida = PropiedadPartida::findOrFail($request->codPropiedadPartida);
            $propiedadPartida->codJugadorDueño = $request->codJugadorReceptor;
            $propiedadPartida->save();

            $nombre = $propiedadPartida->getPropiedad()->nombre;
            $nombreJugador = $jugadorReceptor->getCuenta()->usuario;
            
            
            Debug::mensajeSimple('el token antes era:'.$partida->tokenSincronizacion);
            $partida->cambiarToken();
            $partida->save();
            

            DB::commit();
            return RespuestaAPI::respuestaOk("Se ha transferido la propiedad '$nombre' al jugador $nombreJugador");

        } catch (\Throwable $th) {
            
            DB::rollBack();
            Debug::mensajeError('PropiedadPartidaController', $th);
            return RespuestaAPI::respuestaError("Ha ocurrido un error interno desconocido");

        }

    }

}
