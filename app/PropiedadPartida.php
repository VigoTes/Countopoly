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
}
