<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    protected $table = "propiedad";
    protected $primaryKey = "codPropiedad";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    public function getEdicion(){
        return Edicion::findOrFail($this->codEdicion);
    }

    public function getColor(){
        return Color::findOrFail($this->codColor);
    }

    public function getTipoPropiedad(){
        return TipoPropiedad::findOrFail($this->codTipoPropiedad);
    }

    public function esTren(){

        return $this->verificarTipoPropiedad('Tren');
    }
    public function esNormal(){
        return $this->verificarTipoPropiedad('Normal');

    }
    public function esServicio(){
        return $this->verificarTipoPropiedad('Servicio');
    }

    private function verificarTipoPropiedad($nombre){
        $tipo = $this->getTipoPropiedad();
        return $nombre == $tipo->nombre;
    }


}
/* 






*/