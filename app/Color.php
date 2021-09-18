<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    

    protected $table = "color";
    protected $primaryKey = "codColor";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    const opacity = 0.9;

    public function tienePropiedades(){
        $lista = Propiedad::where('codColor','=',$this->codColor)->get();
        return count($lista)>0;
    }

    public function getRGBTransparente(){
        // rgb(153, 0, 255)
        
    }
}
