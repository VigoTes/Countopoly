<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LenguajeAmor extends Model
{
    

    protected $table = "lenguaje_amor";
    protected $primaryKey = "codLenguaje";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    
    
 
}
