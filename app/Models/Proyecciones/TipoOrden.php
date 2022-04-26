<?php

namespace App\Models\Proyecciones;

use Illuminate\Database\Eloquent\Model;

class TipoOrden extends Model
{
    protected $table = "proy-tipo_orden";
    protected $primaryKey = "codTipoOrden";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
     
}
