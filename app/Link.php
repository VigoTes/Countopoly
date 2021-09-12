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
        
        $fechaActual = new DateTime();
        $fechaDesbloqueo= new DateTime($this->fechaDesbloqueo);
        
        if($fechaActual<$fechaDesbloqueo){
            return false;            
        }
        return true;

    }

    public function getFechaDesbloqueo(){
        return Fecha::formatoParaVistas($this->fechaDesbloqueo);
    }
}
