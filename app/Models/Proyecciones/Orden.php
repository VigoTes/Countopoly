<?php

namespace App\Models\Proyecciones;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = "proy-orden";
    protected $primaryKey = "codOrden";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
     
}
