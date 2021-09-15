<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    
    protected $table = "tipo_cuenta";
    protected $primaryKey = "codTipoCuenta";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
}
