<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TransaccionMonetaria extends Model
{
    
    protected $table = "transaccion_monetaria";
    protected $primaryKey = "codTransaccionMonetaria";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    

    public function getPartida(){
        return Partida::findOrFail($this->codPartida);
    }
    

    /* 
        Dependiendo de si el jugador logeado es el emisor o receptor, 
                                    retorna color roojo y verde respectivamente
    
        Si no es ninguno de los dos, retorna negro
    */
    public function getColorSegunLogeado(){
        $codJugadorLogeado = Jugador::getJugadorLogeado()->codJugador;
        if($codJugadorLogeado == $this->codJugadorSaliente)
            return "red";
        if($codJugadorLogeado == $this->codJugadorEntrante)
            return "green";
        
        return "black";

    }    
    public function getConcepto(){
        $jugadorLogeado = Jugador::getJugadorLogeado();
        $tipoTransaccion = TipoTransaccionMonetaria::findOrFail($this->codTipoTransaccion);

        if($this->codJugadorSaliente == $jugadorLogeado->codJugador)
            return $tipoTransaccion->conceptoEmisor;
        else
            return $tipoTransaccion->conceptoReceptor;
        
    }

    public function getEmisor(){
        return Cuenta::findOrFail(Jugador::findOrFail($this->codJugadorSaliente)->codCuenta);

    }


    public function getReceptor(){
        return Cuenta::findOrFail(Jugador::findOrFail($this->codJugadorEntrante)->codCuenta);
    }
}
