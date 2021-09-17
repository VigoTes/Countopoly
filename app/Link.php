<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "link";
    protected $primaryKey = "codLink";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    

    public function sePuedeVer(){
        
        $fechaActual = new DateTime("now");
        $fechaDesbloqueo= new DateTime($this->fechaDesbloqueo);
        Debug::mensajeSimple('fechaDesbloqueo: '.json_encode($fechaDesbloqueo));
        Debug::mensajeSimple('fechaActual: '.json_encode($fechaActual));
        
        if($fechaActual<$fechaDesbloqueo){
            Debug::mensajeSimple('es menor');
            return false;            
        }


        Debug::mensajeSimple('es mayor');
        return true;

    }

    public function getFechaDesbloqueo(){
        return Fecha::formatoParaVistas($this->fechaDesbloqueo);
    }



    public function getDescripcion(){
        
        $c = substr_count($this->descripcion,"\n");
        $desc = str_replace("\n",'<br>',$this->descripcion);
        Debug::mensajeSimple($c);
        return $desc;
    }
}
