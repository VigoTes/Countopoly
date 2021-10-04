<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropiedadPartida extends Model
{
    
    protected $table = "propiedad_partida";
    protected $primaryKey = "codPropiedadPartida";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    
    public function getPropiedad(){

        return Propiedad::findOrFail($this->codPropiedad);
        
    }

    public function getPartida(){
        return Partida::findOrFail($this->codPartida);
        
    }

    public function getJugador(){
        return Jugador::findOrFail($this->codJugadorDueño);
    }

    public function jugadorTieneTodoElColor($codJugador){
        $jugador = Jugador::findOrFail($codJugador);
        $partida =  $jugador->getPartida();

        /* PARA EL JUGADOR BANCO NO LE DEBE APARECER ESTO pq no puede construir xd*/
        if($partida->codJugadorBanco == $codJugador)
            return false;

        $propiedad = $this->getPropiedad();
        $propiedadesDelColor = Propiedad::where('codColor','=',$propiedad->codColor)
            ->where('codEdicion','=',$propiedad->codEdicion)
            ->get();

        $vectorCodPropiedadesColor = [];
        foreach($propiedadesDelColor as $prop){
            $vectorCodPropiedadesColor[] = $prop->codPropiedad;
        }


        //obtenemos de esta partida, la relacion de propiedades de ese color y sus dueños
        $propiedadesPartidaDelColor = PropiedadPartida::whereIn('codPropiedad',$vectorCodPropiedadesColor)
            ->where('codPartida','=',$partida->codPartida)
            ->get();

        foreach($propiedadesPartidaDelColor as $propPartida){
            if($propPartida->codJugadorDueño != $codJugador) //si de alguna de las propiedades no es dueño, retornamos false
                return false; 
        }

        return true;
        


    }
}
