<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Cuenta extends Authenticatable
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
    
    public function getTipoCuenta(){
        return TipoCuenta::findOrFail($this->codTipoCuenta);
    }

    public static function getCuentaLogeada(){
        $codCuenta = Auth::id();
        if(is_null($codCuenta))
            return "Ninguna cuenta logeada";

        return Cuenta::findOrFail($codCuenta);
    }
    
    public function getAuthPassword()
	{
		return $this->password;
	}
    public function getAuthIdentifier()
	{
		return $this->getKey();
	}


    public function getJugadorPorPartida($codPartida){
        return Jugador::where('codPartida','=',$codPartida)->where('codCuenta','=',$this->codCuenta)->get()[0];
    }

}
