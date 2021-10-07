<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Jugador extends Model
{
    //EL JUGADOR ES LA INSTANCIA QUE SE CREA UNA CUENTA UANDO ESTA EN UNA PARTIDA
    
    protected $table = "jugador";
    protected $primaryKey = "codJugador";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
    

    public function getMontoActualFormateado(){
        $num = $this->montoActual;
        
        return number_format($num, 0, ',', ' ');
        //Formateamos para que no muestre decimales (pq no existen)
        // y que separe los millares por espacios

    }
    public function getPartida(){
        return Partida::findOrFail($this->codPartida);
    }


    public function getCuenta(){
        return Cuenta::findOrFail($this->codCuenta);
    }

    public function getNombreUsuario(){
        return $this->getCuenta()->usuario;
    }

    /* 
        Retorna el jugador asociado a la cuenta que está logeada
        si no está jugando en una partida activa, arroja una exception

        LO COMENTÉ PORQUE ESTA FUNCION NO DEBERIA EXISTIR, PQ PARA UNA MISMA CUENTA PUEDEN HABER MUCHOS JUGADORES LOGEADOS
        en su remplazo, se debe usar Cuenta::getCuentaLogeada()->getJugadorPorPartida($codPartida)
    */
    
    /* public static function getJugadorLogeado(){

        $cuenta = Cuenta::getCuentaLogeada();
        $ultimoJugadorDeCuenta = Jugador::where('codCuenta','=',$cuenta->codCuenta)->get()->last();
        if(!$ultimoJugadorDeCuenta->getPartida()->estaJugandose())
            throw new Exception("La cuenta logeada no está jugando ninguna partida", 1);
        
        return $ultimoJugadorDeCuenta;

    } */
    

    //obtiene la lista de transacciones en las que este jugador es emisor o receptor de dinero
    public function getListaTransacciones(){
        return TransaccionMonetaria::
              where('codJugadorSaliente','=',$this->codJugador)
            ->orWhere('codJugadorEntrante','=',$this->codJugador)
            ->orderBy('codTransaccionMonetaria','DESC')->get();

    }
    
    public function getPropiedades(){
        return PropiedadPartida::where('codJugadorDueño','=',$this->codJugador)->get();

    }



    /* No necesariamente un jugador habrá recibido dinero en un momento dado, */
    public function getCodUltimaTransaccionQueRecibioDinero(){
        $listaTran = TransaccionMonetaria::where('codJugadorEntrante','=',$this->codJugador)
            ->orderBy('fechaHora','DESC') //primero saldrá la mas reciente
            ->get();
        if(count($listaTran)==0)
            return 0;
        

        return $listaTran[0]->codTransaccionMonetaria;

    }

    
}
