

@extends('Layout.Plantilla')
@section('titulo')
    Partida {{$partida->codPartida}}
@endsection

@section('contenido')

<div class="row">
    <div class="col">
        <h1>
            Partida {{$partida->codPartida}}
        </h1>
    </div>
</div>
<div class="row">


    <div class="col">    
        
    <label  for="" >Pagar a:</label>
        <div class="row">
            <input  style="width:30%" placeholder ="Monto pago..." type="number" class="text-right form-control m-1" step="01" id="monto" name="monto" value="0">
            <select  style="width:40%" class="form-control m-1" name="codJugadorDestino" id="codJugadorDestino">
                <option value="0">- Jugadores -</option>
                @foreach ($listaJugadores as $jugador)
                    @if($jugador->codJugador != $jugadorLogeado->codJugador)
                        <option value="{{$jugador->codJugador}}">
                            {{$jugador->getNombreUsuario()}}
                        </option>
                    @endif
                    
                @endforeach
            </select>

            <select  style="width:40%" class="form-control m-1" name="codTipoTransaccion" id="codTipoTransaccion">
                <option value="0">- Tipo Pago - </option>
                @foreach ($listaTipoTransaccion as $tipoTransaccion)
                    <option value="{{$tipoTransaccion->codTipoTransaccion}}">
                        {{$tipoTransaccion->conceptoEmisor}}
                    </option>
                @endforeach
            </select>
            

            <button style="height:70%" onclick="clickRealizarPago()" type="button" class="mt-2 ml-2 btn btn-primary btn-sm">
                <i class="fas fa-hand-holding-usd"></i>
                Pagar
            </button>
        </div>
        
    </div>    
</div>
{{-- 
<div class="row">
    
    <div class="col">
        Jugadores de la partida:
        {{$partida->getStringJugadores()}}
    </div>
</div>
 --}}

<div class="row">
    <div class="col" id="contenidoMisTransacciones">
        
    </div>
</div>
 
 
@endsection

@section('script')
@include('Layout.ValidatorJS')
<script>
    /* 
        Funcion que actualiza el contenido de la pagina a la ultima transaccion
    */
    codUltimaTransaccion = 0;
    debugear = false;

    inicializarReloj(actualizarTransacciones,800);
    
    function actualizarTransacciones(){ 
        ruta = "/Partida/getActualizacionPartida/";
        datosEnviados = {
            codUltimaTransaccion : codUltimaTransaccion,
            codPartida:{{$partida->codPartida}}
        };


        $.get(ruta,datosEnviados, function(dataRecibida){
             
            //console.log('DATA RECIBIDA:');
            //console.log(dataRecibida);
             
            objetoRespuesta = JSON.parse(dataRecibida);
            if(objetoRespuesta.sincronizado == '1'){ //SINCRONIZADO
                console.log("El Contenido ya está sincronizado.");
            }else{ //DESINCRONIZADO
                console.log("Sincronizando el contenido...");
                contenedor = document.getElementById('contenidoMisTransacciones');
                contenedor.innerHTML = objetoRespuesta.body;
            }
            codUltimaTransaccion = objetoRespuesta.codUltimaTransaccion;
            console.log('Ciclo de sincronización completada. Ultima tr=' + codUltimaTransaccion );
        });
    }

    function validarPago(){
        limpiarEstilos(['codJugadorDestino','monto']);
        msjError="";
        msjError = validarSelect(msjError,'codJugadorDestino','0',"Jugador receptor del pago");
        msjError = validarPositividadYNulidad(msjError,'monto',"Monto a enviar");
        return msjError;
    }

    function clickRealizarPago(){
        msjError = validarPago();
        if(msjError!=""){
            alerta(msjError);
            return;
        }

        //                  titulo,         texto,                  tipoMensaje,    nombreFuncionAEjecutar
        confirmarConMensaje("Confirmacion","¿Seguro que quiere pagar?",'warning',ejecutarRealizarPago);
    }

    function ejecutarRealizarPago(){
        ruta = "/Partida/realizarPago/";
        montoEnviado = document.getElementById('monto').value;
        codJugadorDestino = document.getElementById('codJugadorDestino').value;
        codTipoTransaccion = document.getElementById('codTipoTransaccion').value;

        datosEnviados = {
            montoEnviado : montoEnviado ,
            codJugadorDestino: codJugadorDestino,
            codPartida : {{$partida->codPartida}},
            codTipoTransaccion : codTipoTransaccion

        };
        $.get(ruta,datosEnviados, function(dataRecibida){
            console.log('DATA RECIBIDA:');
            
            objetoRespuesta = JSON.parse(dataRecibida);
            console.log(objetoRespuesta);
            alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);
            if(objetoRespuesta.ok=='1')
                limpiarCampos();
            

        });

    }

    function limpiarCampos(){
        document.getElementById('monto').value = "";
        document.getElementById('codJugadorDestino').value = "0";

    }

</script>
@endsection

 

















