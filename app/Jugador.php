<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Jugador extends Model
{
    //EL JUGADOR ES LA INSTANCIA QUE SE CREA UNA CUENTA UANDO ESTA EN UNA PARTIDA
    
    protected $table = "jugador";
    protected $primaryKey = "codJugador";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    

    public function getPartida(){
        return Partida::findOrFail($this->codPartida);
    }


    /* 
    Retorna el jugador asociado a la cuenta que está logeada
    si no está jugando en una partida activa, arroja una exception
    */
    public function getJugadorLogeado(){

        $cuenta = Cuenta::getCuentaLogeada();
        $ultimoJugadorDeCuenta = Jugador::where('codCuenta','=',$cuenta->codCuenta)->last();
        if(!$ultimoJugadorDeCuenta->getPartida()->estaJugandose())
            throw new Exception("La cuenta logeada no está jugando ninguna partida", 1);
        
        return $ultimoJugadorDeCuenta;

    }
    

    //obtiene la lista de transacciones en las que este jugador es emisor o receptor de dinero
    public function getListaTransacciones(){
        return TransaccionMonetaria::
              where('codJugadorEmisor','=',$this->codJugador)
            ->orWhere('codJugadorEmisor','=',$this->codJugador)->get();

    }
    
}
