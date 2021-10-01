

@extends('Layout.Plantilla')
@section('titulo')
    Partida {{$partida->codPartida}}
@endsection
@php
    $esBancario = $partida->codJugadorBancario == $jugadorLogeado->codJugador;
@endphp

@section('tiempoEspera')
    <div class="loader" id="pantallaCarga"></div>
@endsection


@section('estilos')
<style>

    /* Si la pantalla tiene menos de 700px, se pone un padding más pequeño */
    @media only screen and (max-width: 700px) {
        .cardBodyPadding{
            padding:10px;
             
        }
    }
    
    .montoActual{
        font-size:14pt; 
        font-weight: bold
    }

    /* 
        CODIGO OBTENIDO DE
        https://www.it-swarm-es.com/es/html/tabla-con-encabezado-fijo-y-columna-fija-en-css-puro/1072563817/
    */
    .divTablaFijada { /* Este se pone al div que contiene la tabla */
        max-width: 100%;
        max-height: 300px;
        overflow: scroll;
    }

    /* ESTE ES EL QUE FIJA LA ROW , se le pone al thead*/
    .filaFijada { 
        position: -webkit-sticky; /* for Safari */
        position: sticky;
        top: 0;
    }
    .fondoAzul{
        background-color:#3c8dbc;
    }

    .letrasBlancas{
        color: #fff;
    }


</style>
@endsection

@section('contenido')


@csrf

{{-- CARD DEL JUGADOR --}}
<div class="mt-2 card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
            <i class="fas fa-user"></i>
            {{$jugadorLogeado->getNombreUsuario()}}
            
        </h3>
       
        <div class="card-tools">
            <button type="button" style="" class="btn btn-primary btn-xs"  onclick="clickVerTransparenciaBancaria()"
                data-toggle="modal" data-target="#ModalTransparenciaBanco">
                <i class="fas fa-university"></i>
                
            </button>
        </div>
    </div><!-- /.card-header -->
    <div class="card-body cardBodyPadding">
       
         <div class="row">
             <div class="col">
                 <button class="btn btn-primary btn-sm"   data-toggle="modal" data-target="#ModalEnviarPago">
                    Enviar Pago
                 </button>
             </div>
             <div class="col text-right montoActual">
                <i class="fas fa-cash-register"></i>
                <span id="montoActual"></span>
            </div>
         </div>
        
        <div class="row mt-1 mb-1">
            <div class="col divTablaFijada" id="contenidoMisTransacciones">
                

            </div>
        </div>
        
        <br>
        <div class="row">
            <div class="col">
                <button class="btn btn-primary btn-sm"   data-toggle="modal" data-target="#ModalTransferirPropiedad">
                    Transferir Propiedad
                 </button>
            </div>
        </div>

        <div class="row">
            
            <div class="col" id="contenidoMisPropiedades">
                
            </div>
        
        </div>
        
    </div>
</div>






<div class="row">

    <div class="col">
        {{--  Si este jugador es el bancario, le presentamos su dashboard  --}}
        @if($esBancario)
            @include('Partidas.SalaJuego_Banco')
        @endif

    </div>
</div>
 





{{-- MODAL para ver la tarjeta de una propiedad--}}
<div class="modal fade" id="ModalTarjetaPropiedad" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalTarjetaPropiedad">
                        Tarjeta de Propiedad
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="BodyModalTarjetaPropiedad">
                    
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>
 
                </div>
            
        </div>
    </div>
</div>
      


{{-- MODAL para ver las transacciones del banco --}}
<div class="modal fade" id="ModalTransparenciaBanco" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalTransparenciaBanco">
                        Movimientos del Banco
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="BodyModalTransparenciaBanco">
                    
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>
 
                </div>
            
        </div>
    </div>
</div>
      


{{-- MODAL para enviar PAGO  --}}
<div class="modal fade" id="ModalEnviarPago" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">
                         Enviar Pago
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="">
                    <div class="row">
                        <div class="col">    
            
                            <div class="row">
                                <div class="col">
                                    <label  for="" >
                                        Destinatario:
                                    </label>

                                    <select   class="form-control m-1" name="codJugadorDestino" id="codJugadorDestino">
                                        <option value="0">- Jugadores -</option>
                                        @foreach ($listaJugadores as $jugador)
                                            @if($jugador->codJugador != $jugadorLogeado->codJugador)
                                                <option value="{{$jugador->codJugador}}">
                                                    {{$jugador->getNombreUsuario()}}
                                                </option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>

                                 
                            </div>
                            
                            
                            <div class="row">
                                <div class="col">
                                    
                                    <label for="">Concepto</label>
                                    
                                    <select  style="" class="form-control" name="codTipoTransaccion" id="codTipoTransaccion">
                                        <option value="0">- Tipo Pago - </option>
                                        @foreach ($listaTipoTransaccion as $tipoTransaccion)
                                            <option value="{{$tipoTransaccion->codTipoTransaccion}}">
                                                {{$tipoTransaccion->conceptoEmisor}}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                    
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Monto:</label>
                                    <input  style="" placeholder ="Monto pago..." type="number" class="text-right form-control" 
                                        step="01" id="monto" name="monto" value="0">
                                
                                </div>

                            </div>
                            <div class="row mt-1">
                                <div class="col text-right">
                                    <button style="" onclick="clickRealizarPago()" type="button" class="btn btn-primary m-1">
                                        <i class="fas fa-hand-holding-usd"></i>
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </div>    
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <button id="botonSalirModalEnviarPago" type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>
 
                </div>
            
        </div>
    </div>
</div>
      


{{-- MODAL para TRANSFERIR PROPIEDAD  --}}
<div class="modal fade" id="ModalTransferirPropiedad" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">
                         Transferir Propiedad
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="">
                    <div class="row">
                        <div class="col">
                            <label for="">
                                Destinatario
                            </label>
                            <select  class="form-control m-1" name="codJugadorATransferirPropiedad" id="codJugadorATransferirPropiedad">
                                <option value="0">- Jugadores -</option>
                                @foreach ($listaJugadores as $jugador)
                                    @if($jugador->codJugador != $jugadorLogeado->codJugador)
                                        <option value="{{$jugador->codJugador}}">
                                            {{$jugador->getNombreUsuario()}}
                                        </option>
                                    @endif
                                    
                                @endforeach
                            </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                            <label for="">
                                Propiedad
                            </label>
                            <select  class="form-control m-1" name="codPropiedadPartida" id="codPropiedadPartida">
                                <option value="0">- Propiedades - </option>
                                @foreach ($listaMisPropiedades as $miPropiedad)
                                    <option value="{{$miPropiedad->codPropiedadPartida}}">
                                        {{$miPropiedad->getPropiedad()->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col text-right">
 
                            <button  onclick="clickTransferirPropiedad()" type="button" class="mt-2 ml-2 btn btn-primary">
                                Transferir 
                                
                                <i class="fas fa-random"></i>
                            </button>
 
                        </div>
                     </div>
                      
                </div>
                <div class="modal-footer">
                    <button id="" type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>
 
                </div>
            
        </div>
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

    $( document ).ready(function() {
        
         
        actualizarTransacciones();

        $(".loader").fadeOut("slow");

    });


    inicializarReloj(actualizarTransacciones,{{$jugadorLogeado->tiempoActualizacion*1000}});
    
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

                document.getElementById('montoActual').innerHTML = objetoRespuesta.montoActual;
                

                @if ($esBancario)
                    contenidoPropiedadesDelBanco =     document.getElementById('banco_propiedades');
                    contenidoPropiedadesDelBanco.innerHTML = objetoRespuesta.banco_misPropiedades;

                    contenidoTransaccionesDelBanco =     document.getElementById('banco_Transacciones');
                    contenidoTransaccionesDelBanco.innerHTML = objetoRespuesta.banco_misTransacciones;
                
                    document.getElementById('banco_montoActual').innerHTML = objetoRespuesta.banco_montoActual;

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
            if(objetoRespuesta.ok=='1'){
                limpiarCamposPago();
                banco_limpiarCamposPago();
                actualizarTransacciones();
                
                cerrarModalEnviarPago();
                cerrarModalBancoEnviarPago();
            }
                
            

        });

    }

    function cerrarModalEnviarPago(){
        /*  */
        document.getElementById('botonSalirModalEnviarPago').click();
        
    }

    function cerrarModalBancoEnviarPago(){

        document.getElementById('botonSalirModalBancoEnviarPago').click();
        
        
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
                actualizarTransacciones();

                @if ($esBancario)
                    actualizarSelectMisPropiedadesBanco();

                @endif

            }
                
        });

    }


    function actualizarSelectMisPropiedades(){
          
        ruta = "/Partida/getPropiedadesDeJugador/{{$jugadorLogeado->codJugador}}";
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




    /* TARJETA DE PROPIEDAD */
    function clickAbrirTarjetaPropiedad(codPropiedad){
        document.getElementById('BodyModalTarjetaPropiedad').innerHTML = "";
        ruta = "/Partida/getTarjetaPropiedad/" + codPropiedad;
        $.get(ruta,function(dataRecibida){
            //console.log('DATA RECIBIDA:');
            objetoRespuesta = JSON.parse(dataRecibida);
            
             
            document.getElementById('TituloModalTarjetaPropiedad').innerHTML = "Título de Propiedad";

            document.getElementById('BodyModalTarjetaPropiedad').innerHTML = objetoRespuesta.bodyModal;


        });

    }

    function clickVerTransparenciaBancaria(){
        document.getElementById('BodyModalTransparenciaBanco').innerHTML = "";
        ruta = "/Partida/getTransparenciaBancaria/{{$partida->codPartida}}";
        $.get(ruta,function(dataRecibida){
            //console.log('DATA RECIBIDA:');
            //objetoRespuesta = JSON.parse(dataRecibida);
            
             
             
            document.getElementById('BodyModalTransparenciaBanco').innerHTML = dataRecibida;


        });

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

        function actualizarSelectMisPropiedadesBanco(){
          
          ruta = "/Partida/getPropiedadesDeJugador/{{$partida->codJugadorBanco}}";

          $.get(ruta,function(htmlRecibido){
              console.log('DATA RECIBIDA:');
              console.log(htmlRecibido);
              document.getElementById('banco_codPropiedadPartida').innerHTML = htmlRecibido;
          });
  
      }
        function banco_limpiarCamposPago(){
            document.getElementById('banco_monto').value = "";
            document.getElementById('banco_codJugadorDestino').value = "0";

        }


    @endif



</script>
@endsection

 

















