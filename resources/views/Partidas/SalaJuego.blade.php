

@extends('Layout.Plantilla')
@section('titulo')
    Partida {{$partida->codPartida}}
@endsection
@php
    $esBancario = $partida->codJugadorBancario == $jugadorLogeado->codJugador;
@endphp



@section('contenido')
@csrf
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

<div class="row">


    <div class="col">    
        
        <label  for="" >Transferir propiedad a:</label>
        <div class="row">
            <select  style="width:40%" class="form-control m-1" name="codJugadorATransferirPropiedad" id="codJugadorATransferirPropiedad">
                <option value="0">- Jugadores -</option>
                @foreach ($listaJugadores as $jugador)
                    @if($jugador->codJugador != $jugadorLogeado->codJugador)
                        <option value="{{$jugador->codJugador}}">
                            {{$jugador->getNombreUsuario()}}
                        </option>
                    @endif
                    
                @endforeach
            </select>

            <select  style="width:40%" class="form-control m-1" name="codPropiedadPartida" id="codPropiedadPartida">
                <option value="0">- Propiedades - </option>
                @foreach ($listaMisPropiedades as $miPropiedad)
                    <option value="{{$miPropiedad->codPropiedadPartida}}">
                        {{$miPropiedad->getPropiedad()->nombre}}
                    </option>
                @endforeach
            </select>
            

            <button style="height:70%" onclick="clickTransferirPropiedad()" type="button" class="mt-2 ml-2 btn btn-primary btn-sm">
                <i class="fas fa-hand-holding-usd"></i>
                Transferir
            </button>
        </div>
        
    </div>    
</div>
<div class="row">

    <div class="col" id="contenidoMisPropiedades">
        
    </div>

</div>
<br>
<br>
<div class="row">

    <div class="col">
        {{--  Si este jugador es el bancario, le presentamos su dashboard  --}}
        @if($esBancario)
            @include('Partidas.SalaJuego_Banco')
        @endif

    </div>
</div>
 
@endsection

@section('script')
@include('Layout.ValidatorJS')
<script>
    /* 
        Funcion que actualiza el contenido de la pagina a la ultima transaccion
    */
    tokenSincronizacion = 0;
     
    debugear = false;

    inicializarReloj(actualizarTransacciones,800);
    
    function actualizarTransacciones(){ 
        ruta = "/Partida/getActualizacionPartida/";
        datosEnviados = {
            tokenSincronizacion : tokenSincronizacion,
            codPartida:{{$partida->codPartida}}
            @if ($esBancario)
                ,banco:'1'
            @endif
        };


        $.get(ruta,datosEnviados, function(dataRecibida){
             
            //console.log('DATA RECIBIDA:');
            //console.log(dataRecibida);
             
            objetoRespuesta = JSON.parse(dataRecibida);
            if(objetoRespuesta.sincronizado == '1'){ //SINCRONIZADO
                console.log("El Contenido ya está sincronizado.");
            }else{ //DESINCRONIZADO
                console.log("Sincronizando el contenido...");
                console.log(objetoRespuesta);
                contenidoMisTransacciones = document.getElementById('contenidoMisTransacciones');
                contenidoMisTransacciones.innerHTML = objetoRespuesta.misTransacciones;

                contenidoMisPropiedades = document.getElementById('contenidoMisPropiedades');
                contenidoMisPropiedades.innerHTML = objetoRespuesta.misPropiedades;

                @if ($esBancario)
                    contenidoPropiedadesDelBanco =     document.getElementById('banco_propiedades');
                    contenidoPropiedadesDelBanco.innerHTML = objetoRespuesta.banco_misPropiedades;

                    contenidoTransaccionesDelBanco =     document.getElementById('banco_Transacciones');
                    contenidoTransaccionesDelBanco.innerHTML = objetoRespuesta.banco_misTransacciones;
                

                @endif

                
                actualizarSelectMisPropiedades();
            }
            tokenSincronizacion = objetoRespuesta.tokenSincronizacion;
            console.log('Ciclo de sincronización completada. Token=' + tokenSincronizacion );
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
        confirmarConMensaje("Confirmacion","¿Seguro que quiere pagar?",'warning',jugadorNormal_ejecutarRealizarPago);
    }

    function jugadorNormal_ejecutarRealizarPago(){

        montoEnviado = document.getElementById('monto').value;
        codJugadorDestino = document.getElementById('codJugadorDestino').value;
        codTipoTransaccion = document.getElementById('codTipoTransaccion').value;
        

        ejecutarRealizarPago(false,montoEnviado,codJugadorDestino,codTipoTransaccion);
    }


    function ejecutarRealizarPago(esBanco,montoEnviado,codJugadorDestino,codTipoTransaccion){
        banco = "";
        if(esBanco) 
            banco="1"; 

        ruta = "/Partida/realizarPago/";
        
        datosEnviados = {
            montoEnviado : montoEnviado ,
            codJugadorDestino: codJugadorDestino,
            codPartida : {{$partida->codPartida}},
            codTipoTransaccion : codTipoTransaccion,
            banco: banco
        };
        $.get(ruta,datosEnviados, function(dataRecibida){
            console.log('DATA RECIBIDA:');
            
            objetoRespuesta = JSON.parse(dataRecibida);
            console.log(objetoRespuesta);
            alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);
            if(objetoRespuesta.ok=='1')
                limpiarCamposPago();
            

        });

    }

    function limpiarCamposPago(){
        document.getElementById('monto').value = "";
        document.getElementById('codJugadorDestino').value = "0";

    }



    /* TRANSACCIONES DE PROPIEDADES */
    function clickTransferirPropiedad(){
        msjError = validarTransferirPropiedad();
        if(msjError!=""){
            alerta(msjError);
            return;
        }

        //                  titulo,         texto,                  tipoMensaje,    nombreFuncionAEjecutar
        confirmarConMensaje("Confirmacion","¿Seguro que desea transferir la propiedad?",'warning',jugadorNormal_ejecutarTransferirPropiedad);
    }

    function validarTransferirPropiedad(){
        limpiarEstilos(['codJugadorATransferirPropiedad','codPropiedadPartida']);
        msjError="";
        msjError = validarSelect(msjError,'codJugadorATransferirPropiedad','0',"Jugador a transferir la propiedad");
        msjError = validarSelect(msjError,'codPropiedadPartida','0',"Propiedad a transferir");
        
        return msjError;

    }

    function jugadorNormal_ejecutarTransferirPropiedad(){

        codPropiedadPartida = document.getElementById('codPropiedadPartida').value;
        codJugadorATransferirPropiedad = document.getElementById('codJugadorATransferirPropiedad').value;
        ejecutarTransferirPropiedad(false,codPropiedadPartida,codJugadorATransferirPropiedad);
    }


    function ejecutarTransferirPropiedad(esBanco,codPropiedadPartida,codJugadorATransferirPropiedad){
        banco = "";
        if(esBanco) 
            codJugadorEmisor = {{$partida->codJugadorBanco}};
        else
            codJugadorEmisor = {{$jugadorLogeado->codJugador}};

        ruta = "{{route('Partida.transferirPropiedad')}}";

        
        token = document.getElementsByName('_token')[0].value;


        datosEnviados = {
            _token : token,
            codJugadorEmisor : codJugadorEmisor,
            codPropiedadPartida : codPropiedadPartida,
            codJugadorReceptor : codJugadorATransferirPropiedad
        };

        $.post(ruta,datosEnviados, function(dataRecibida){
            console.log('DATA RECIBIDA:');
            
            objetoRespuesta = JSON.parse(dataRecibida);
            console.log(objetoRespuesta);
            alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);
            if(objetoRespuesta.ok=='1'){
                limpiarCamposTransaccionPropiedad();
                actualizarSelectMisPropiedades();
            }
                
        });

    }


    function actualizarSelectMisPropiedades(){

        ruta = "/Partida/getPartidasDeJugador/{{$partida->codPartida}}";

        $.get(ruta,function(htmlRecibido){
            console.log('DATA RECIBIDA:');
            console.log(htmlRecibido);
            document.getElementById('codPropiedadPartida').innerHTML = htmlRecibido;
        });

    }

    function limpiarCamposTransaccionPropiedad(){
        document.getElementById('codJugadorATransferirPropiedad').value = "0";
        document.getElementById('codPropiedadPartida').value = "0";
    }


    /* Si este jugador es el bancario, le presentamos su dashboard */
    @if($esBancario)

        function banco_validarPago(){
            limpiarEstilos(['banco_codJugadorDestino','banco_monto']);
            msjError="";
            msjError = validarSelect(msjError,'banco_codJugadorDestino','0',"Jugador receptor del pago");
            msjError = validarPositividadYNulidad(msjError,'banco_monto',"Monto a enviar");

            return msjError;
        }


        function banco_clickRealizarPago(){
            msjError = banco_validarPago();
            if(msjError!=""){
                alerta(msjError);
                return;
            }

            //                  titulo,         texto,                  tipoMensaje,    nombreFuncionAEjecutar
            confirmarConMensaje("Confirmacion","¿Seguro que quiere pagar?",'warning',banco_ejecutarRealizarPago);

        }

        function banco_ejecutarRealizarPago(){
            montoEnviado = document.getElementById('banco_monto').value;
            codJugadorDestino = document.getElementById('banco_codJugadorDestino').value;
            codTipoTransaccion = document.getElementById('banco_codTipoTransaccion').value;
            

            ejecutarRealizarPago(true,montoEnviado,codJugadorDestino,codTipoTransaccion);
    
        }


        function banco_clickTransferirPropiedad(){
            msjError = banco_validarTransferirPropiedad();
            if(msjError!=""){
                alerta(msjError);
                return;
            }

            //                  titulo,         texto,                  tipoMensaje,    nombreFuncionAEjecutar
            confirmarConMensaje("Confirmacion","¿Seguro que desea transferir la propiedad?",'warning',banco_ejecutarTransferirPropiedad);

        }

        function banco_ejecutarTransferirPropiedad(){

            
            codPropiedadPartida = document.getElementById('banco_codPropiedadPartida').value;
            codJugadorATransferirPropiedad = document.getElementById('banco_codJugadorATransferirPropiedad').value;
            ejecutarTransferirPropiedad(true,codPropiedadPartida,codJugadorATransferirPropiedad);

        }
        
        function banco_validarTransferirPropiedad(){
            
            limpiarEstilos(['banco_codJugadorATransferirPropiedad','banco_codPropiedadPartida']);
            msjError="";
            msjError = validarSelect(msjError,'banco_codJugadorATransferirPropiedad','0',"Jugador a transferir la propiedad");
            msjError = validarSelect(msjError,'banco_codPropiedadPartida','0',"Propiedad a transferir");
            
            return msjError;
        }

    @endif



</script>
@endsection

 

















