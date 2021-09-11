<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Debug;
use App\Jugador;
use App\Partida;
use App\RespuestaAPI;
use App\TransaccionMonetaria;
use Illuminate\Http\Request;
use App\User;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
use Illuminate\Support\Carbon;
 
use Illuminate\Support\Facades\DB;
class PartidaController extends Controller
{

    //vista sin datos que llamara al invocable
    public function listarPartidasEnEspera(){
        
        return view('Partidas.ListarPartidas');
    }
    //invocable que será llamado cada x segundos
    public function invocarListaPartidasEnEspera(){
        $listaPartidas = Partida::getPartidasEnEspera();
        return view('Partidas.Invocables.inv_ListaPartidas',compact('listaPartidas'));
    }



#region Funcionalidades del HOST 
    

    /* 
    esta funcion se ejecuta cuando le damos a iniciar partida, 
        lo cual inicia automaticamente una partida y te redirije a la sala de esper

    */
    public function abrirPartida(){

        try {


            DB::beginTransaction();
            $cuentaLogeada =  Cuenta::getCuentaLogeada();

            $partida = new Partida();
            $partida->codCuentaHost = $cuentaLogeada->codCuenta; //por ahora, pondremos que siempre sea Vigo el host
            $partida->codEstadoPartida = 1; //por ahora, pondremos que siempre sea Vigo el host
            $partida->save();

            //ahora incluimos en esa partida a el host
            $jugadorHost = new Jugador();
            $jugadorHost->codCuenta = $cuentaLogeada->codCuenta;
            $jugadorHost->codPartida = $partida->codPartida;
            $jugadorHost->montoActual = 0;
            $jugadorHost->save();

            $partida->codJugadorBancario = $jugadorHost->codJugador;
            $partida->save(); //ponemos por defecto que sea el host el bancario

            db::commit();
            //redirije a la sala de espera de la partida
            return redirect()->route('Partida.IngresarSalaEspera',$partida->codPartida)
                ->with('datos','Se ha abierto la sala de espera');

        } catch (\Throwable $th) {
            DB::rollBack();
            Debug::mensajeError('Partida controller', $th);
            return $th;
        }
    }

    public function IniciarPartida($codPartida){
        $partida = Partida::findOrFail($codPartida);
        $partida->codEstadoPartida = 2;
        $partida->save();


        //esta es la cuenta en la partida del jugador que manejará el banco, le creo un jugador porque su monto es infinito
        $jugadorBanco = new Jugador();
        $jugadorBanco->codCuenta = $partida->codJugadorBancario; //el que se seteó en la sala de espera como BANCO
        $jugadorBanco->codPartida = $codPartida;
        $jugadorBanco->montoActual = 99999999;
        $jugadorBanco->save();

        //ahora guardamos en partida el codigo de este jugador bancos
        $partida->codJugadorBanco = $jugadorBanco->codJugador;
        $partida->save();


        $montoInicial = 5000;
        //ahora le damos a cada jugador la cantidad inicial de dinero
        $jugadores = $partida->getJugadores();
        foreach ($jugadores as $jugador){
            $jugador->montoActual = $montoInicial;
            $jugador->save();

            $transaccion = new TransaccionMonetaria();
            $transaccion->codJugadorSaliente = $partida->codJugadorBanco;
            $transaccion->codJugadorEntrante = $jugador->codJugador;
            $transaccion->codPartida = $codPartida;
            $transaccion->codTipoTransaccion = 2; //pago del banco
            $transaccion->fechaHora = Carbon::now();

        }

        return redirect()->route('Partida.EntrarSalaJuego',$codPartida);

    }

    public function CancelarPartida($codPartida){
        $partida = Partida::findOrFail($codPartida);
        $partida->codEstadoPartida = 3;
        $partida->save();

        return redirect()->route('Partida.listarPartidasEnEspera')->with('datos','Se ha cancelado la partida');

    }

    public function hacerBancarioAJugador($codJugador){

        try {
            DB::beginTransaction();
            $jugador = Jugador::findOrFail($codJugador);
            $partida = $jugador->getPartida();
            $partida->codJugadorBancario = $codJugador;
            $partida->save();
            $nombre = $jugador->getNombreUsuario();
            DB::commit();
            return RespuestaAPI::respuestaOk("Se ha actualizado el bancario al jugador '$nombre'");
    
        } catch (\Throwable $th) {
            
            DB::rollBack();
            return RespuestaAPI::respuestaError("Ha ocurrido un error interno:".$th);
        }
        
    }


#endregion



    public function IngresarSalaEspera ($codPartida){
        $partida = Partida::findOrFail($codPartida);
        $cuentaLogeada = Cuenta::getCuentaLogeada();
        if(!$partida->tieneAJugador($cuentaLogeada->codCuenta)){
            $jugadorHost = new Jugador();
            $jugadorHost->codCuenta = $cuentaLogeada->codCuenta;
            $jugadorHost->codPartida = $partida->codPartida;
            $jugadorHost->montoActual = 0;
            $jugadorHost->save();
        }

        return view('Partidas.SalaEsperaPartida',compact('partida'));
    }

    public function SalirmeDePartida($codPartida){
        $partida = Partida::findOrFail($codPartida);
        $cuentaLogeada = Cuenta::getCuentaLogeada();

        if($partida->codCuentaHost == $cuentaLogeada->codCuenta){ //si soy el host, la partida se cancela
            $partida->codEstadoPartida = 4;
            $partida->save();    
            $mensaje = "Como eras el host, la partida también se ha cancelado.";
        }else{ //si soy usuario normal, nomas me salgo
            Jugador::where('codPartida','=',$codPartida)->where('codCuenta','=',$cuentaLogeada->codCuenta)->delete();
            $mensaje = "";
        }

        return redirect()->route('Partida.listarPartidasEnEspera')->with('datos',"Te has salido de la partida. $mensaje");
    }

    
    

    //despliega la vista de la sala del juego
    public function entrarSalaJuego($codPartida){
        $partida = Partida::findOrFail($codPartida);
        $listaJugadores = Jugador::where('codPartida','=',$codPartida)->get();

        return view('Partidas.SalaJuego',compact('partida','listaJugadores'));
    }
    


    /* 
        funcion que se llama desde JS cada 0.5 segundos para actualizar la vista

        Se le envía por parametro GET el código de la última transaccion monetaria de la que nuestro usuario tiene registro
        Si es la misma  que la que tenemos en backend, retornamos 
            [
                'sincronizado'=>'1',
                'body'=>'' //aqui iria vacio porque no hay nada que actualizar
                'codUltimaTransaccion' => '54'
            ]
        Si no es la misma, retornamos
            [
                'sincronizado'=>'0',
                'body'=>'VISTA HTML CON LOS NUEVOS VALORES ACTUALIZADOS'
                'codUltimaTransaccion' => '54'
            ]

    */
    public function getActualizacionPartida($codUltimaTransaccionFrontend){
        $ultimaTransaccionFrontend = TransaccionMonetaria::findOrFail($codUltimaTransaccionFrontend);
        $partida = Partida::findOrFail($ultimaTransaccionFrontend->codPartida);

        $codUltimaTransaccionReal = $partida->getUltimaTransaccion()->codTransaccionMonetaria;
        if($codUltimaTransaccionFrontend == $codUltimaTransaccionReal){ //sincronizado
            $estadoSincronizacion = '1';
            $body = '';
        }else{ //desincronizado
            $jugador = Cuenta::getCuentaLogeada()->getJugadorPorPartida($partida->codPartida);
            
            //lista de las transacciones del jugador
            $listaMisTransacciones = $jugador->getListaTransacciones($partida->codPartida);


            $estadoSincronizacion = '0';
            $body = view('Partidas.Invocables.inv_MisTransacciones',compact('jugador','listaMisTransacciones'));
        }

        $vectorRespuesta = [
            'sincronizado'=> $estadoSincronizacion,
            'body'=> $body,
            'codUltimaTransaccion' => $codUltimaTransaccionReal
        ];
        return json_encode($vectorRespuesta);
    }
  

    /* 
        funcion que se llama desde JS cada 0.5 segundos para actualizar la vista
        retorna la tabla de usuarios de la partida y la configuracion de la partida
    */
    public function getActualizacionSalaEspera($codPartida){

        $partida = Partida::findOrFail($codPartida);
        $cuentaLogeada = Cuenta::getCuentaLogeada();
        
        $listaJugadores = Jugador::where('codPartida','=',$codPartida)->get();

        return view('Partidas.Invocables.inv_SalaEspera',compact('listaJugadores','partida','cuentaLogeada'));
    }
}
