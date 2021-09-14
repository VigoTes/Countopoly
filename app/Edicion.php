<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edicion extends Model
{
    protected $table = "edicion";
    protected $primaryKey = "codEdicion";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    public function getPropiedades(){
        return Propiedad::where('codEdicion','=',$this->codEdicion)->get();

    }
    
    public function tienePartidas(){
        $lista = Partida::where('codEdicion','=',$this->codEdicion)->get();
        return count($lista)>0;
    }
}
