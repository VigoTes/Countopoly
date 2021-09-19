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
        Dependiendo de si el jugador pasado como parametro es el emisor o receptor, 
                                    retorna color roojo y verde respectivamente
    
        Si no es ninguno de los dos, retorna negro
    */
    public function getColorSegunJugador($codJugador){ 
        if($codJugador == $this->codJugadorSaliente)
            return "red";
        if($codJugador == $this->codJugadorEntrante)
            return "green";
        
        return "black";

    }


    /* Retorna el otro jugador, segun el codJugadorLogeado que le mandes (siempre será uno de los 2) */
    public function getOtroJugadorSegunLogeado($codJugadorLogeado){
        if($codJugadorLogeado == $this->codJugadorSaliente)
            return Jugador::findOrFail($this->codJugadorEntrante);
        if($codJugadorLogeado == $this->codJugadorEntrante)
            return Jugador::findOrFail($this->codJugadorSaliente);
        
        return "";


    }

    public function getConcepto(){
        $cuentaLogeada = Cuenta::getCuentaLogeada();
        $jugadorLogeado  = $cuentaLogeada->getJugadorPorPartida($this->codPartida);
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
