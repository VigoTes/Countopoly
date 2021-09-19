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


    /* Retorna 
         
        WHITE (255,255,255) 
        o 
        BLACK (0,0,0)
        
    white, si el color tiene a ser oscuro (la suma de sus RGB/3 es < 128)
    black, si el color tiene a ser claro (la suma de sus RGB/3 es < 128)

    
    */
    public function getContrasteRGB(){
        $string = $this->rgb; // "rgb(255,255,255)"
        
        //quitamos los parentesis
        $string = str_replace("rgb","",$string);
        $string = str_replace("(","",$string);
        $string = str_replace(")","",$string);
        Debug::mensajeSimple($string);
        //ahora tendriamos el string '255,255,255'
        $vector = explode(",",$string);
        $valor_R = $vector[0];
        $valor_G = $vector[1];
        $valor_B = $vector[2];

        $promedio = ($valor_R + $valor_G + $valor_B )/ 3;
        
        if($promedio<128){ //significa que el color es oscuro
            return "white";
        }else{
            return "black";
        }


    }
}
