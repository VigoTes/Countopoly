<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoPartida extends Model
{
    
    protected $table = "estado_partida";
    protected $primaryKey = "codEstadoPartida";
    public $timestamps = false;  //para que no trabaje con los campos fecha 

    public static function codEnEspera(){
        return 1;
    }

}
