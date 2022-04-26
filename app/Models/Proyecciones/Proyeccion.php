<?php

namespace App\Models\Proyecciones;

use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    protected $table = "proy-proyeccion";
    protected $primaryKey = "codProyeccion";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
     
    const tamañoCodigos = 4;

    public static function generarNuevoToken(){
        return rand(1000,9999); //token de 4 digitos
    }

    //este es alfanumerico
    public static function generarNuevoCodigo(){
        return Proyeccion::generateRandomString(static::tamañoCodigos);        
    }

    private static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public static function buscarPorCodigo($codigo){
        return Proyeccion::where('codigo',$codigo)->first();

    }
}
