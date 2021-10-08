<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Debug;
use App\Edicion;
use App\Jugador;
use App\Partida;
use App\PropiedadPartida;
use App\RespuestaAPI;
use App\TipoTransaccionMonetaria;
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
        
        $listaPartidas = Partida::getPartidasEnEsperaYJugandose();
        return view('Partidas.ListarPartidas',compact('listaPartidas'));
    }
    //invocable que será llamado cada x segundos
    public function invocarListaPartidasEnEspera(){
        $listaPartidas = Partida::getPartidasEnEsperaYJugandose();
        return view('Partidas.Invocables.inv_ListaPartidas',compact('listaPartidas'));
    }



#region Funcionalidades del HOST 
    

    /* 
    esta funcion se ejecuta cuando le damos a iniciar partida, (desde el listar partidas)
        lo cual inicia automaticamente una partida y te redirije a la sala de esper

    */
    public function abrirPartida(){

        try {


            DB::beginTransaction();
            $cuentaLogeada =  Cuenta::getCuentaLogeada();

            $partida = new Partida();
            $partida->codCuentaHost = $cuentaLogeada->codCuenta; //por ahora, pondremos que siempre sea Vigo el host
            $partida->codEstadoPartida = 1; //por ahora, pondremos que siempre sea Vigo el host
            $partida->codEdicion = 1;
            $partida->dineroInicial = 5000;
            $partida->sePuedenUnirDespues = 0;
            $partida->pagoSalida = 200;
            $partida->pozo = 0;
            
            $partida->cambiarToken();
            $partida->save();
            
            //ahora incluimos en esa partida a el host
            $jugadorHost = new Jugador();
            $jugadorHost->codCuenta = $cuentaLogeada->codCuenta;
            $jugadorHost->codPartida = $partida->codPartida;
            $jugadorHost->montoActual = 0;
            $jugadorHost->tiempoActualizacion= 2;
            
            $jugadorHost->esBanco =0; //Esto se refiere a que este jugador no es el Banco (aunque será el bancario)
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
            throw $th;
            return $th;
        }
    }

    public function IniciarPartida($codPartida){

        try {
            DB::beginTransaction();
            $partida = Partida::findOrFail($codPartida);
            $partida->codEstadoPartida = 2;
            $partida->save();

            //esta es la cuenta en la partida del jugador que manejará el banco, le creo un jugador porque su monto es infinito
            $jugadorBanco = new Jugador();
            $jugadorBanco->codCuenta = 0; //el que se seteó en la sala de espera como BANCO
            $jugadorBanco->codPartida = $codPartida;
            $jugadorBanco->montoActual = 99999999;
            $jugadorBanco->esBanco = 1;
            $jugadorBanco->tiempoActualizacion = 0;
            
            $jugadorBanco->save();

            //ahora guardamos en partida el codigo de este jugador banco
            $partida->codJugadorBanco = $jugadorBanco->codJugador;
            $partida->save();

            $montoInicial = $partida->dineroInicial;
            //ahora le damos a cada jugador la cantidad inicial de dinero
            $jugadores = $partida->getJugadores();
            foreach ($jugadores as $jugador){
                if($jugador->codJugador != $partida->codJugadorBanco){ //si no es el banco, le seteamos sus datos
                    $jugador->montoActual = $montoInicial;
                    $jugador->save();
                    
                    $transaccion = new TransaccionMonetaria();
                    $transaccion->codJugadorSaliente = $partida->codJugadorBanco;
                    $transaccion->codJugadorEntrante = $jugador->codJugador;
                    $transaccion->codPartida = $codPartida;
                    $transaccion->codTipoTransaccion = 6; //pago Inicial
                    $transaccion->fechaHora = Carbon::now();
                    $transaccion->monto = $montoInicial;
                    $transaccion->save();
                }
            }

            //Ahora creamos las instancias de propiedad_partida de la partida, inicialmente todas estas las tendrá el Jugador Banco
            $edicion = $partida->getEdicion();
            $listaPropiedadesExistentes = $edicion->getPropiedades();
            foreach ($listaPropiedadesExistentes as $propiedad) {
                Debug::mensajeSimple('haciendo ');
                $propPartida = new PropiedadPartida();
                $propPartida->codJugadorDueño = $partida->codJugadorBanco; //por defecto las propiedades las tiene el banco al iniciar
                $propPartida->codPropiedad = $propiedad->codPropiedad;
                $propPartida->codPartida = $partida->codPartida;
                
                $propPartida->save();
            }
            db::commit();
            return redirect()->route('Partida.EntrarSalaJuego',$codPartida);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
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

    public function cambiarMiTiempoActualizacionJugador(Request $request){

        try {
            DB::beginTransaction();
            $jugador = Jugador::findOrFail($request->codJugador);
            $jugador->tiempoActualizacion = $request->nuevoTiempoActualizacion;
            $jugador->save();
            $nuevoValor = $request->nuevoTiempoActualizacion;

            DB::commit();
            return RespuestaAPI::respuestaOk("Se ha cambiado su tiempo de actualización a $nuevoValor");
        } catch (\Throwable $th) {
            Debug::mensajeError('Partida controller cambiarMitIEMPO', $th);
            DB::rollBack();
            return RespuestaAPI::respuestaError("Ha ocurrido un error inesperado");
        }

    }


    //Funcion para que el banco, en la partida, le envie el dinero a quien cayó en partida libre
    public function enviarPozo(Request $request){
        try {
            DB::beginTransaction();
            $jugadorDestino = Jugador::findOrFail($request->codJugadorDestino);
            $partida = Partida::findOrFail($request->codPartida);

            $jugadorEmisor = Cuenta::getCuentaLogeada()->getJugadorPorPartida($request->codPartida); 
            if($jugadorEmisor->codJugador != $partida->codJugadorBancario){ //si el jugador logeado no es el bancario en su partida
                return RespuestaAPI::respuestaError("Solo el banco puede gestionar el pozo de la partida.");
            }

            $monto = $partida->pozo;

            if($monto==0){
                return RespuestaAPI::respuestaError("No hay dinero en el pozo de la partida.");
            }
            $transaccion = new TransaccionMonetaria();
            $transaccion->codJugadorSaliente = $partida->codJugadorBanco;
            $transaccion->codJugadorEntrante = $jugadorDestino->codJugador;

            $transaccion->codPartida = $request->codPartida;
            $transaccion->codTipoTransaccion = TipoTransaccionMonetaria::codCobroDelPozo;

            $transaccion->fechaHora = Carbon::now();
            $transaccion->monto = $monto;
            $transaccion->save();

            $jugadorEntrante = Jugador::findOrFail($request->codJugadorDestino);
            $jugadorEntrante->montoActual = $jugadorEntrante->montoActual + $monto;
             
            $jugadorEntrante->save();
            $partida->pozo = 0;
            $partida->save();
            
            $partida->cambiarToken();
            $nombreJugadorReceptor = $jugadorEntrante->getNombreUsuario();

            DB::commit();
            return RespuestaAPI::respuestaOk("Se ha enviado el pozo al jugador $nombreJugadorReceptor");
        } catch (\Throwable $th) {
            Debug::mensajeError('enviarPozo', $th);
            DB::rollBack();
            return RespuestaAPI::respuestaError("Ha ocurrido un error inesperado");
        }

    }

    

    //cUANDO EXPULSAMOS A UN JUGADOR DE LA SALA DE ESPERA
    public function ExpulsarJugador($codJugador){
        try {
            DB::beginTransaction();
            $jugador = Jugador::findOrFail($codJugador);
            $nombre = $jugador->getNombreUsuario();

            $partida = Partida::findOrFail($jugador->codPartida);
            if($partida->codJugadorBancario == $codJugador){
                return RespuestaAPI::respuestaError("El jugador que desea expulsar es el bancario, por favor seleccione otro bancario antes de expulsarlo.");
            }

            $jugador->delete();
            
            DB::commit();
            return RespuestaAPI::respuestaOk("Se ha expulsado al jugador '$nombre'");
    
        } catch (\Throwable $th) {
            
            DB::rollBack();
            return RespuestaAPI::respuestaError("Ha ocurrido un error interno:".$th);
        }
        
    }

    //El jugador expulsado llega a esta ruta 
    public function FuiExpulsadoYEstoyRetornandoAlListar($codPartida){
        Debug::mensajeSimple('si llega');
        $cuentaLogeada = Cuenta::getCuentaLogeada();
        Jugador::where('codPartida','=',$codPartida)
            ->where('codCuenta','=',$cuentaLogeada->codCuenta)
            ->delete();

        return redirect()->route('Partida.listarPartidasEnEspera')
            ->with('datos','El host te ha expulsado de la partida.');
    
    }

    public function CambiarEdicion(Request $request){
        try {
            db::beginTransaction();
            $partida = Partida::findOrFail($request->codPartida);
            $partida->codEdicion = $request->codEdicion;
            $partida->save();
            $nuevaEdicion = $partida->getEdicion()->nombre;

            db::commit();
            return RespuestaAPI::respuestaOk("Se ha cambiado la edición a la '$nuevaEdicion' exitosamente.");
            
        } catch (\Throwable $th) {
            db::rollBack();
            Debug::mensajeError('Partida Controller: CambiarEdicion ', $th );

            return RespuestaAPI::respuestaError("Ha ocurrido un error interno.");
        }

    }
    public function CambiarPagoSalida(Request $request){
        try {
            db::beginTransaction();
            $partida = Partida::findOrFail($request->codPartida);
            $partida->pagoSalida = $request->pagoSalida;
            $partida->save();

            $nuevoPago = $partida->pagoSalida;

            db::commit();
            return RespuestaAPI::respuestaOk("Se ha cambiado el pago por pasar por GO a '$nuevoPago' exitosamente.");
            
        } catch (\Throwable $th) {
            db::rollBack();
            Debug::mensajeError('Partida Controller: CambiarPagoSalida ', $th );

            return RespuestaAPI::respuestaError("Ha ocurrido un error interno.");
        }

    }


    public function CambiarDineroInicial(Request $request){
        try {
            db::beginTransaction();
            $partida = Partida::findOrFail($request->codPartida);
            $partida->dineroInicial = $request->dineroInicial;
            $partida->save();
            $dineroInicial = $request->dineroInicial;

            db::commit();
            return RespuestaAPI::respuestaOk("Se ha cambiado la cantidad de dinero inicial a '$dineroInicial'.");
            
        } catch (\Throwable $th) {
            db::rollBack();
            Debug::mensajeError('Partida Controller: CambiarDineroInicial', $th );

            return RespuestaAPI::respuestaError("Ha ocurrido un error interno.");
        }

    }


    public function CambiarSePuedenUnirDespues(Request $request){
        try {
            db::beginTransaction();
            $partida = Partida::findOrFail($request->codPartida);
            $partida->sePuedenUnirDespues = $request->sePuedenUnirDespues;
            $partida->save();
            
            $no = "";
            if($request->sePuedenUnirDespues == "0")
                $no = "no";

            db::commit();
            return RespuestaAPI::respuestaOk("Ya $no se pueden unir a la partida mientras se está jugando");
            
        } catch (\Throwable $th) {
            db::rollBack();
            Debug::mensajeError('Partida Controller: CambiarDineroInicial', $th );

            return RespuestaAPI::respuestaError("Ha ocurrido un error interno.");
        }

    }
     


    public function CambiarDescripcion(Request $request){
        try {
            db::beginTransaction();
            $partida = Partida::findOrFail($request->codPartida);
            $partida->descripcion = $request->descripcion;
            $partida->save();
            $nuevaDesc = $request->descripcion;
             
            db::commit();
            return RespuestaAPI::respuestaOk("Se ha cambiado la descripción a '$nuevaDesc' exitosamente.");
            
        } catch (\Throwable $th) {
            db::rollBack();
            Debug::mensajeError('Partida Controller: ', $th );

            return RespuestaAPI::respuestaError("Ha ocurrido un error interno.");
        }

    }



#endregion


    //Te crea un nuevo jugador para ti y te retorna la vista de la sala de espera
    public function IngresarSalaEspera ($codPartida){
        $partida = Partida::findOrFail($codPartida);
        $cuentaLogeada = Cuenta::getCuentaLogeada();
        $listaEdiciones = Edicion::All();

        if(!$partida->tieneAJugador($cuentaLogeada->codCuenta)){
            $jugador = new Jugador();
            $jugador->codCuenta = $cuentaLogeada->codCuenta;
            $jugador->codPartida = $partida->codPartida;
            $jugador->montoActual = 0;
            $jugador->esBanco = 0;
            $jugador->tiempoActualizacion= 2;
            $jugador->save();
        }else{
            $jugador = $cuentaLogeada->getJugadorPorPartida($codPartida);
        }
        $listaJugadores = Jugador::where('codPartida','=',$codPartida)->get();


        return view('Partidas.SalaEsperaPartida',compact('jugador','partida','listaJugadores','cuentaLogeada','listaEdiciones'));
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
        
        try {
            $partida = Partida::findOrFail($codPartida);
            
            $listaJugadores = Jugador::where('codPartida','=',$codPartida)->get();
            
            $cuentaLogeada = Cuenta::getCuentaLogeada();
            $jugadorLogeado = $cuentaLogeada->getJugadorPorPartida($codPartida);
            $listaMisPropiedades = $jugadorLogeado->getPropiedades();
            
            
            $listaTipoTransaccion = TipoTransaccionMonetaria::where('soloPuedeEnviarElBanco','=','0')->get();

            
            $listaTipoTransaccion_banco = TipoTransaccionMonetaria::
                 //where('soloPuedeEnviarElBanco','=','1')->
                  where('codTipoTransaccion','!=',TipoTransaccionMonetaria::codDadivaInicial)
                  ->where('codTipoTransaccion','!=',TipoTransaccionMonetaria::codCobroDelPozo)
                
                ->get();
             
            $jugadorBanco = Jugador::findOrFail($partida->codJugadorBanco);
            
            $banco_listaMisPropiedades = $jugadorBanco->getPropiedades();


            return view('Partidas.SalaJuego',compact('partida','listaJugadores','jugadorLogeado','listaTipoTransaccion',
                'listaMisPropiedades','listaTipoTransaccion_banco','banco_listaMisPropiedades'));

        } catch (\Throwable $th) {
            throw $th;
            Debug::mensajeError('entrar sala juego',$th);

        }
    
    }
    


    /* Funcion para que un usuario entre a una partida que ya se inicio */
    /* Crea una instancia de jugador, se le da su pago inicial y este ingresa a la partida */
    public function entrarAPartidaYaIniciada($codPartida){
        try {
            DB::beginTransaction();
            $partida = Partida::findOrFail($codPartida);

            if($partida->estoyEnLaPartida()){
                return redirect()->route('Partida.EntrarSalaJuego',$codPartida);
            }

            
            $cuentaLogeada = Cuenta::getCuentaLogeada();
            
            $jugador = new Jugador();
            $jugador->codCuenta = $cuentaLogeada->codCuenta;
            $jugador->codPartida = $partida->codPartida;
            $jugador->montoActual = 0;
            $jugador->esBanco = 0;
            $jugador->tiempoActualizacion= 2;
            $jugador->save();


            //ahora le damos al jugador la cantidad inicial de dinero
            $jugador->montoActual = $partida->dineroInicial;
            $jugador->save();

            $transaccion = new TransaccionMonetaria();
            $transaccion->codJugadorSaliente = $partida->codJugadorBanco;
            $transaccion->codJugadorEntrante = $jugador->codJugador;
            $transaccion->codPartida = $codPartida;
            $transaccion->codTipoTransaccion = 6; //pago Inicial
            $transaccion->fechaHora = Carbon::now();
            $transaccion->monto = $partida->dineroInicial;
            $transaccion->save();

            DB::commit();

            return redirect()->route('Partida.EntrarSalaJuego',$codPartida);
        } catch (\Throwable $th) {
            db::rollBack();
            throw $th;
            Debug::mensajeError('entrarAPartidaYaIniciada ',$th);
        }


    }





    public function realizarPago(Request $request){
        
        try{

            db::beginTransaction();

            $cuentaLogeada = Cuenta::getCuentaLogeada();
            $partida = Partida::findOrFail($request->codPartida);

            if($request->banco=='1')//si se envió como pago del banco 
                $jugadorLogeado = Jugador::findOrFail($partida->codJugadorBanco);
            else //jugador normal
                $jugadorLogeado = $cuentaLogeada->getJugadorPorPartida($request->codPartida);

            if($jugadorLogeado->montoActual < $request->montoEnviado){
                return RespuestaAPI::respuestaError("No dispone de fondos suficientes.");
            }

            if($request->codTipoTransaccion == TipoTransaccionMonetaria::codPagoImpuestos){ //si es un pago de impuestos
                if($request->codJugadorDestino != $partida->codJugadorBanco ) //si no va destinado al banco, error
                    return RespuestaAPI::respuestaError("El pago de impuestos solo puede ser hecho al banco.");
            
                //si sí va al banco, añadimos el monto al pozo actual de la partida
                $partida->pozo = $partida->pozo + $request->montoEnviado;
                $partida->save();

                //seguimos como si nada
            }

            $transaccion = new TransaccionMonetaria();
            $transaccion->codJugadorSaliente = $jugadorLogeado->codJugador;
            $transaccion->codJugadorEntrante = $request->codJugadorDestino;
            $transaccion->codPartida = $request->codPartida;
            $transaccion->codTipoTransaccion = $request->codTipoTransaccion;
            $transaccion->fechaHora = Carbon::now();
            $transaccion->monto = $request->montoEnviado;
            $transaccion->save();

            $jugadorEntrante = Jugador::findOrFail($request->codJugadorDestino);
            $jugadorEntrante->montoActual = $jugadorEntrante->montoActual + $request->montoEnviado;
            $jugadorLogeado->montoActual = $jugadorLogeado->montoActual - $request->montoEnviado;

            $jugadorEntrante->save();
            $jugadorLogeado->save();

            $partida = $jugadorLogeado->getPartida();
            $partida->cambiarToken();

            DB::commit();
            return RespuestaAPI::respuestaOk("Se ha realizado el pago exitosamente.");


        } catch (\Throwable $th) {
            db::rollBack();
            throw $th;
            return RespuestaAPI::respuestaError("Ha ocurrido un error interno $th.");
            Debug::mensajeError('realizarPago ',$th);
        }

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
    public function getActualizacionPartida(Request $request){
        

        //$ultimaTransaccionFrontend = TransaccionMonetaria::findOrFail($request->codUltimaTransaccion);
        
        $partida = Partida::findOrFail($request->codPartida);
        $tokenSincronizacionActual = $partida->tokenSincronizacion;

        $banco_misPropiedades = "";
        $banco_misTransacciones = "";
        $misTransacciones = '';
        $misPropiedades = '';
        $montoActual = '';
        $banco_montoActual = '';
        $codUltimaTransaccionRecibiDinero = '';
        $codUltimaTransaccionRecibiDineroBanco = '';
        $imagenMonedas = "";
        $imagenMonedasBanco = "";
        $pozoPartida = $partida->pozo;
        
        //error_log('                    Rqeust:'.$request->tokenSincronizacion." real:".$tokenSincronizacionActual);

        if($request->tokenSincronizacion !=0 //primera iteracion
            && $request->tokenSincronizacion == $tokenSincronizacionActual){ //sincronizado
            $estadoSincronizacion = '1';
           
            //Debug::mensajeSimple('sincro');
        }else{ //desincronizado
            $jugador = Cuenta::getCuentaLogeada()->getJugadorPorPartida($partida->codPartida); //jugador
            Debug::mensajeSimple('Sincronizando...');
            //lista de las transacciones del jugador

            
            
            $listaMisTransacciones = $jugador->getListaTransacciones($partida->codPartida);
            $listaMisPropiedades = $jugador->getPropiedades();
            $estadoSincronizacion = '0';

            $montoActual = $jugador->getMontoActualFormateado();

            $misTransacciones = (string) view('Partidas.Invocables.inv_MisTransacciones',compact('jugador','listaMisTransacciones'));
            $misPropiedades = (string ) view('Partidas.Invocables.inv_MisPropiedades',compact('jugador','listaMisPropiedades'));
            
            $miles =  (int) ($jugador->montoActual / 1000);
            $imagenMonedas = (string) view('Partidas.Invocables.inv_imagenMonedas',compact('miles'));
            
            $codUltimaTransaccionRecibiDinero = $jugador->getCodUltimaTransaccionQueRecibioDinero();

            if($request->banco=='1') // también se está solicitnado la información del banco
            {
                /* TODA ESTA INFO ES DEL BANCO, NO DEL JUGADOR BANCARIO */
                $jugadorBanco = Jugador::findOrFail($partida->codJugadorBanco);
                $jugador = $jugadorBanco; //Para que a la vista le llegue esa variable
                $listaMisTransacciones = $jugador->getListaTransacciones($partida->codPartida); 
                $listaMisPropiedades = $jugador->getPropiedades();

                $banco_montoActual = $jugador->getMontoActualFormateado();
                $banco_misTransacciones = (string) view('Partidas.Invocables.inv_MisTransacciones',compact('jugador','listaMisTransacciones'));
                $banco_misPropiedades = (string ) view('Partidas.Invocables.inv_MisPropiedades',compact('jugador','listaMisPropiedades'));
                
                $miles =  (int) ($jugador->montoActual / 1000);
                $imagenMonedasBanco = (string) view('Partidas.Invocables.inv_imagenMonedas',compact('miles'));

                //aqui el error
               
                $codUltimaTransaccionRecibiDineroBanco = $jugador->getCodUltimaTransaccionQueRecibioDinero();


            }   
            //Debug::mensajeSimple($body);
             
        }

        $vectorRespuesta = [
            'sincronizado'=> $estadoSincronizacion,
            'misTransacciones' => $misTransacciones,
            'misPropiedades' => $misPropiedades,
            'banco_misTransacciones' => $banco_misTransacciones,
            'banco_misPropiedades' => $banco_misPropiedades,
            'tokenSincronizacion' => $tokenSincronizacionActual,
            'montoActual' => $montoActual,
            'banco_montoActual' => $banco_montoActual,
            'codUltimaTransaccionRecibiDinero' => $codUltimaTransaccionRecibiDinero,
            'codUltimaTransaccionRecibiDineroBanco' => $codUltimaTransaccionRecibiDineroBanco,
            'imagenMonedas' => $imagenMonedas,
            'imagenMonedasBanco' => $imagenMonedasBanco,
            'pozoPartida' => $pozoPartida
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

        //si la partida tiene al jugador
        if($partida->tieneAJugador($cuentaLogeada->codCuenta)){
            $jugador = $cuentaLogeada->getJugadorPorPartida($codPartida);

            $html = (string) view('Partidas.Invocables.inv_SalaEspera',compact('listaJugadores','partida','cuentaLogeada'));
            
            $rutaRedireccion = "";

            //si ya se está jugando, redireccionamos al link de la sala de juego
            if($partida->estaJugandose())
                $rutaRedireccion = route('Partida.EntrarSalaJuego',$partida->codPartida);
            if($partida->estaCancelada())
                $rutaRedireccion = route('Partida.SalirmeDePartida',$partida->codPartida);
            
        }else{
            $html = "";
            $rutaRedireccion = route('Partida.FuiExpulsadoYEstoyRetornandoAlListar',$partida->codPartida);
        }

        $vector = [
            'html' => $html,
            'rutaRedireccion' => $rutaRedireccion
        ];
        return json_encode($vector); 
    }


    /* retorna el body de un modal con todas las salidas de dinero del banco */
    public function getTransparenciaBancaria($codPartida){
        $partida = Partida::findOrFail($codPartida);
        $jugadorBancario = Jugador::findOrFail($partida->codJugadorBancario);
        $transacciones = TransaccionMonetaria::where('codJugadorSaliente','=',$partida->codJugadorBanco)
            ->orderBy('fechaHora','DESC')
            ->get();

        return view('Partidas.Invocables.inv_TransparenciaBanco',compact('partida','transacciones','jugadorBancario'));
    }


    public function getTransaccionMonetariaDetalles(Request $request){
        
        $transaccion =  TransaccionMonetaria::findOrFail($request->codTransaccionMonetaria);
        $jugador =  Jugador::findOrFail($request->codJugador);


        return view('Partidas.Invocables.inv_DetalleTransaccionMonetaria',compact('transaccion','jugador'));
    }

}
