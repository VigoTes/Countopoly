<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntuacionLenguaje extends Model
{
    

    protected $table = "puntuacion_lenguaje";
    protected $primaryKey = "codPuntuacionLenguaje";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    public function getLenguaje(){

        return LenguajeAmor::findOrFail($this->codLenguaje);
    }
    
    
 
}
