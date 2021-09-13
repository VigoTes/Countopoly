<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTransaccionMonetaria extends Model
{
    protected $table = "tipo_transaccion_monetaria";
    protected $primaryKey = "codTipoTransaccion";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    

    
}
