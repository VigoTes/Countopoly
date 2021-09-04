<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        if(Cuenta::getJugadorLogeado() == $this->codJugadorEmisor)
            return "red";
        if(Cuenta::getJugadorLogeado() == $this->codJugadorE)
            return "green";
        
        return "black";

    }    
}
