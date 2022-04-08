<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    

    protected $table = "persona";
    protected $primaryKey = "codPersona";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    const max = 16;
    
    public function getPuntuaciones(){
        return PuntuacionLenguaje::where('codPersona',$this->codPersona)->get();
    }


    function calcularCompatibilidad($persona2){
        $persona1 = $this;

        $lenguajes = LenguajeAmor::All();
        $p1_a_p2 = 0;
        $p2_a_p1 = 0;
        
        foreach ($lenguajes as $leng) {
            $objPuntuacion_persona1 = $persona1->getPuntuacionObj($leng);
            $objPuntuacion_persona2 = $persona2->getPuntuacionObj($leng);
            
            
            $p1_a_p2 += Persona::functionCompatibilidad($objPuntuacion_persona1->puntajeDar,$objPuntuacion_persona2->puntajeRecibir);
            $p2_a_p1 += Persona::functionCompatibilidad($objPuntuacion_persona2->puntajeDar,$objPuntuacion_persona1->puntajeRecibir);
            error_log($objPuntuacion_persona1);
            error_log($objPuntuacion_persona2);
        }

        $puntajeTotal = $p1_a_p2 + $p2_a_p1;

        return [
            'p1_a_p2'=> $p1_a_p2,
            'p2_a_p1'=> $p2_a_p1,
            'puntajeTotal'=> $puntajeTotal
        ];
    }


    function getPuntuacionObj($lenguaje){
        return PuntuacionLenguaje::where('codPersona',$this->codPersona)->where('codLenguaje',$lenguaje->codLenguaje)->get()[0];
    }

    //le llegan el puntaje de dar1 y recibir1 
    static function functionCompatibilidad($x,$y){
        $max = static::max;
        $val = ($x+$y)*( $max - pow( abs($x-$y),2 ) );
        error_log("x= $x       y=$y          res=$val");
        return $val;
    }
 
}
