<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Partida extends Model
{
    use Notifiable;

    
    protected $table = "partida";
    protected $primaryKey = "codPartida";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    public function getEstado(){
        return EstadoPartida::findOrFail($this->codEstado);
    }

    public function estaJugandose(){
        return $this->verificarEstado('Jugando');
    }
    private function verificarEstado($nombreEstado){
        return $this->getEstado()->nombre == $nombreEstado;
    }

    public static function getPartidasEnEspera(){
        return Partida::where('codEstadoPartida','=',EstadoPartida::codEnEspera())->get();

    }
    
    public static function getPartidasFinalizadas(){
        return Partida::where('codEstadoPartida','=',EstadoPartida::codFinalizada())->get();
    }
    
    public function getUltimaTransaccion(){
        return TransaccionMonetaria::where('codPartida','=',$this->codPartda)->last();

    }

    public function getStringJugadores(){

        $string = "";
        $listaJugadores = Jugador::where('codPartida','=',$this->codPartida)->get();
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

    

    public function tieneAJugador($codCuenta){
        $lista = Jugador::where('codCuenta','=',$codCuenta)
        ->where('codPartida',$this->codPartida)
        ->get();

        return count($lista)>0;

    }
}
