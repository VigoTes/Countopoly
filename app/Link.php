<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "link";
    protected $primaryKey = "codLink";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
}
