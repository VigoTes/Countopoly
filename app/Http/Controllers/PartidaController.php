<?php

namespace App\Http\Controllers;

use App\Partida;
use Illuminate\Http\Request;
use App\User;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
use Illuminate\Support\Carbon;
 
use Illuminate\Support\Facades\DB;
class PartidaController extends Controller
{

    //vista sin datos que llamara al invocable
    public function listarPartidasEnEspera(){
        
        return view('Partidas.ListarPartidas');
    }
    
    //invocable que será llamado cada x segundos
    public function invocarListaPartidasEnEspera(){
        $listaPartidas = Partida::getPartidasEnEspera();
        return view('Partidas.Invocables.inv_ListaPartidas',compact('listaPartidas'));
    }
    

    /* 
        funcion que se llama desde JS cada 0.5 segundos para actualizar la vista

        Se le envía por parametro GET el código de la última transaccion monetaria de la que nuestro usuario tiene registro
        Si es la misma  que la que tenemos en backend, retornamos 
            [
                'sincronizado'=>'1',
                'body'=>'' //aqui iria vacio porque no hay nada que actualizar
                'codUltimaTransaccion' => '54'
            ]
        Si no es la misma, retornamos
            [
                'sincronizado'=>'0',
                'body'=>'VISTA HTML CON LOS NUEVOS VALORES ACTUALIZADOS'
                'codUltimaTransaccion' => '54'
            ]

    */
    public function getActualizacionPartida($codUltimaTransaccionFrontend){
        $ultimaTransaccionFrontend = TransaccionMonetaria::findOrFail($codUltimaTransaccionFrontend);
        $partida = Partida::findOrFail($ultimaTransaccionFrontend->codPartida);

        $codUltimaTransaccionReal = $partida->getUltimaTransaccion()->codTransaccionMonetaria;
        if($codUltimaTransaccionFrontend == $codUltimaTransaccionReal){ //sincronizado
            $estadoSincronizacion = '1';
            $body = '';
        }else{ //desincronizado
            $jugador = Cuenta::getCuentaLogeada()->getJugadorPorPartida($partida->codPartida);
        
            //lista de las transacciones del jugador
            $listaMisTransacciones = $jugador->getListaTransacciones($partida->codPartida);


            $estadoSincronizacion = '0';
            $body = view('Partidas.Invocables.inv_MisTransacciones',compact('jugador','listaMisTransacciones'));
        }

        $vectorRespuesta = [
            'sincronizado'=> $estadoSincronizacion,
            'body'=> $body,
            'codUltimaTransaccion' => $codUltimaTransaccionReal
        ];
        return json_encode($vectorRespuesta);
    }
  

}
