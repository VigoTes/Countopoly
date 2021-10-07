<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NunoMaduro\Collision\Adapters\Phpunit\ConfigureIO;

class Partida extends Model
{
    use Notifiable;

    
    protected $table = "partida";
    protected $primaryKey = "codPartida";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    


    //cambia el token para que todos sepan que la partida ha sufrido algun cambio
    public function cambiarToken(){
        $this->tokenSincronizacion = 
            rand(
                Configuracion::TokenAleatorio_LimiteInferior
                ,
                Configuracion::TokenAleatorio_LimiteSuperior
                );
        $this->save();
        Debug::mensajeSimple('Se actualizó el token:'. $this->tokenSincronizacion);

    }

    public function getEdicion(){
        return Edicion::findOrFail($this->codEdicion);
    }
    public function getEstado(){
        return EstadoPartida::findOrFail($this->codEstadoPartida);
    }

    public function estaJugandose(){
        return $this->verificarEstado('Jugandose');
    }

    public function estaEnEspera(){
        return $this->verificarEstado('En espera');
    }

    public function estaCancelada(){
        return $this->verificarEstado('Cancelada');

    }

    
    private function verificarEstado($nombreEstado){
        return $this->getEstado()->nombre == $nombreEstado;
    }

    public static function getPartidasEnEspera(){
        return Partida::where('codEstadoPartida','=',EstadoPartida::codEnEspera())->get();
    }

    public static function getPartidasEnEsperaYJugandose(){
        return Partida::whereIn('codEstadoPartida',[1,2])
            ->orderBy('codEstadoPartida','ASC')
            ->orderBy('codPartida','DESC')
            ->get();

    }
    
    public static function getPartidasFinalizadas(){
        return Partida::where('codEstadoPartida','=',EstadoPartida::codFinalizada())->get();
    }
    
    public function getUltimaTransaccion(){
        return TransaccionMonetaria::where('codPartida','=',$this->codPartida)->get()->last();

    }

    public function getStringJugadores(){

        $string = "";
        $listaJugadores = Jugador::where('codPartida','=',$this->codPartida)
            ->where('esBanco','!=','1')
            ->get();
        foreach($listaJugadores as $jugador){
                $string .= ",".$jugador->getCuenta()->usuario;
        }
       
        $string = trim($string,',');
        return $string;
    }

    public function getCantJugadoresYMaximo(){
         
        return $this->getCantidadJugadores(). "/4". $this->maxJugadores;
    }
    public function getJugadores(){
        return Jugador::where('codPartida','=',$this->codPartida)->get();
    }
    public function getCantidadJugadores(){
        return count($this->getJugadores());
    }
    
    public function getCuentaHost(){
        return Cuenta::findOrFail($this->codCuentaHost);
    }

    public function elHostEstaLogeado(){
        $cuentaLogeada = Cuenta::getCuentaLogeada();
        return $cuentaLogeada->codCuenta == $this->codCuentaHost;

    }

    public function estoyEnLaPartida(){
        $cuentaLogeada = Cuenta::getCuentaLogeada();
        $listaJug = Jugador::where('codPartida','=',$this->codPartida)
            ->where('codCuenta','=',$cuentaLogeada->codCuenta)
            ->get();

        return count($listaJug)>0;

    }

    public function tieneAJugador($codCuenta){
        $lista = Jugador::where('codCuenta','=',$codCuenta)
        ->where('codPartida',$this->codPartida)
        ->get();

        return count($lista)>0;

    }

    public function sePuedenUnirDespues(){
        return $this->sePuedenUnirDespues == "1";

    }
}
