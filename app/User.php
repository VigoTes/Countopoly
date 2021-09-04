<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "cuenta";
    protected $primaryKey = "codCuenta";
    public $timestamps = false;  //para que no trabaje con los campos fecha 


    protected $fillable = [
       'email', 'password'
    ];

    
}
