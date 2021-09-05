<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        return Partida::where('codEstado','=',EstadoPartida::codEnEspera())->get();

    }
    
    public static function getPartidasFinalizadas(){
        return Partida::where('codEstado','=',EstadoPartida::codFinalizada())->get();
    }
    
    public function getUltimaTransaccion(){
        return TransaccionPartida::where('codPartida','=',$this->codPartda)->last();

    }

    public function getStringJugadoresYmaximo(){
        return $this->cantJugadores. "/". $this->maxJugadores;
    }
    
}
