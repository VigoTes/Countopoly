<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTransaccionMonetaria extends Model
{
    protected $table = "tipo_transaccion_monetaria";
    protected $primaryKey = "codTipoTransaccion";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    
    const codDadivaInicial = 6;
    const codPagoImpuestos = 2 ;

    const codSalidaGo = 3;
    const codCobroDelPozo = 8; //cuando un jugador cae en para libre y se le da el pozo
}
