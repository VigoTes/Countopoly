<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPropiedad extends Model
{
    
    protected $table = "tipo_propiedad";
    protected $primaryKey = "codTipoPropiedad";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
}
