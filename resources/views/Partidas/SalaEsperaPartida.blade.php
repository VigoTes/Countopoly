@extends('Layout.Plantilla')
@section('titulo')
    Sala de Espera
@endsection

@section('estilos')

<style>
    /* Si la pantalla tiene menos de 700px, se pone un padding más pequeño */
    @media only screen and (max-width: 700px) {
        .cardBodyPadding{
            padding:10px;        
        }
    }
</style>
@endsection
@section('contenido')

 

<div class="mt-2 card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <b class="card-title">
             Sala de Espera - Partida 
             <b>
                {{$partida->codPartida}}
             </b>
             
        </b>
        <div class="card-tools">

        </div>
    </div><!-- /.card-header -->
    <div class="card-body cardBodyPadding">

        <div class="row">
            
            <div class="col">
                <label for="">
                    Mi tiempo de actualización:
                
                </label>
                <button type="" class="btn btn-primary btn-xs">
                    <i class="fas fa-question" onclick="mostrarInformacionTiempoActualizacion()"></i>

                </button>

                <div class="slidecontainer">
                    <input type="range" step="0.01" min="0.5" max="8" value="{{$jugador->tiempoActualizacion}}" class="slider" 
                        id="tiempoActualizacion" name="tiempoActualizacion" onchange="changeTiempoActualizacion()" >

                    <span id="verTiempoActualizacion"></span>
                </div>

            </div>
        </div>
        {{-- Tabla de jugadores --}}
        <div class="row m-2">
            <div class="col" id="contenedor">
                @include('Partidas.Invocables.inv_SalaEspera')

            </div>
        </div>


    </div>
</div>

@if($partida->elHostEstaLogeado())
            
    {{-- OPCIONES DEL ADMIN --}}
    <div class="mt-2 card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <b class="card-title">
                Opciones de administrador
            </b>
            <div class="card-tools">

            </div>
        </div><!-- /.card-header -->
        <div class="card-body cardBodyPadding">

            <div class="row">
                <div class="col">
                    <label for="descripcion">Descripción de la partida</label>
                     
                    <div class="input-group mb-3">
                        <input id="descripcion" name="descripcion" type="text" class="form-control" placeholder="Descripción de la partida..." >
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="" onclick="cambioDescripcion()">
                              Actualizar
                            </button>
                        </div>
                    </div>

                </div>

            </div>
             
            <div class="row mt-2">

                <div class="col">
                    <label for="codEdicion">Edición</label>
                    <select class="form-control" name="codEdicion" id="codEdicion" onchange="cambioEdicion()">
                        @foreach($listaEdiciones as $edicion)
                            <option value="{{$edicion->codEdicion}}">
                                {{$edicion->nombre}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
            </div>
          
            <div class="row mt-2">

                
                <div class="col text-center">
                    
                    <a href="{{route('Partida.CancelarPartida',$partida->codPartida)}}"  class="btn btn-danger">
                        Cerrar Sala
                    </a>
                </div>
                <div class="col text-center">
                    <a href="{{route('Partida.IniciarPartida',$partida->codPartida)}}" class="btn btn-success" >
                        Iniciar
                    </a>
                </div>
            </div>
            
        </div>
    </div>


@endif


{{-- Boton de salir --}}
<div class="row">
    <div class="col">
        <a class="btn btn-danger" href="{{route('Partida.SalirmeDePartida',$partida->codPartida)}}">
            <i class="fas fa-backspace"></i>
            Salir
        </a>
    </div>
    
</div>
 
@endsection

@section('script')
@include('Layout.ValidatorJS')

<script>
     


    relojActivo = true;

    /* Falta implementar aqui tambien el token */
    $( document ).ready(function() {
        inicializarReloj(actualizarPartidas,1500);

    });

    contenidoActual = "";
    function actualizarPartidas(){ 
        ruta = "/Partida/getActualizacionSalaEspera/{{$partida->codPartida}}";

        if(relojActivo)
            $.get(ruta, function(dataRecibida){
                //console.log('DATA RECIBIDA:');
                //console.log(dataRecibida);
                contenedor = document.getElementById('contenedor');
                objetoRespuesta = JSON.parse(dataRecibida);
                htmlRecibido = objetoRespuesta.html;

                if(contenidoActual!=htmlRecibido){ //si es diferente, actualizamos.
                    console.log('Actualizando...');
                    contenedor.innerHTML = htmlRecibido;
                    contenidoActual = htmlRecibido;
                }else{ //si es igual, no hay por que actualizar
                    
                }
                
                redireccionó = verificarRedireccion(objetoRespuesta);
                if(redireccionó){
                    relojActivo = false;   
                }
            });
    }

    var slider = document.getElementById("tiempoActualizacion");
    var output = document.getElementById("verTiempoActualizacion");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
        output.innerHTML = this.value + " segundos";
    }

    function mostrarInformacionTiempoActualizacion(){
        alertaMensaje("Tiempo de actualización","Es el periodo de tiempo que tardará en actualizarse "+
        "su tablero de juego, para conexiones lentas le recomendamos valores mayores a 3, ","info")

    }

    function changeTiempoActualizacion(){

        nuevoValor = slider.value;
        console.log('Enviando actualización de mi tiempoActualizacion "'+nuevoValor+'" al servidor...');

        ruta = "/Partida/cambiarMiTiempoActualizacionJugador/";
        datos = {
            codJugador : {{$jugador->codJugador}},
            nuevoTiempoActualizacion : nuevoValor
        };

        $.get(ruta,datos, function(dataRecibida){
            console.log('DATA RECIBIDA:');
            objetoRespuesta = JSON.parse(dataRecibida);
            console.log(objetoRespuesta);
            //alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);

        
        });


    }


    @if($partida->elHostEstaLogeado())
        
        function hacerBancario(codJugador){
            ruta = "/Partida/HacerBancarioAJugador/" + codJugador;
            $.get(ruta, function(dataRecibida){
                console.log('DATA RECIBIDA:');
                console.log(dataRecibida);

                objetoRespuesta = JSON.parse(dataRecibida);
                alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);

            });

        }

        function cambioEdicion(){
            codEdicion = document.getElementById('codEdicion').value;
            ruta = "/Partida/CambiarEdicion/";
            datos = {
                codEdicion : codEdicion,
                codPartida : {{$partida->codPartida}}
            };
            
            $.get(ruta, datos, function(dataRecibida){
                console.log('DATA RECIBIDA:');
                console.log(dataRecibida);
                
                objetoRespuesta = JSON.parse(dataRecibida);
                alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);

            });

        }
        function cambioDescripcion(){
            descripcion = document.getElementById('descripcion').value;
            ruta = "/Partida/CambiarDescripcion/";
            datos = {
                descripcion : descripcion,
                codPartida : {{$partida->codPartida}}
            };
            
            $.get(ruta, datos, function(dataRecibida){
                console.log('DATA RECIBIDA:');
                console.log(dataRecibida);
                
                objetoRespuesta = JSON.parse(dataRecibida);
                alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);

            });


        }

        codJugadorAExpulsar = 0;
        function clickExpulsarJugador(codJugador){
            codJugadorAExpulsar = codJugador;
            confirmarConMensaje("Confirmacion","¿Desea expulsar al jugador?",'warning',ejecutarExpulsarJugador)

        }

        function ejecutarExpulsarJugador(){
            ruta = "/Partida/ExpulsarJugador/" + codJugadorAExpulsar;
            $.get(ruta, function(dataRecibida){
                console.log('DATA RECIBIDA:');
                console.log(dataRecibida);

                objetoRespuesta = JSON.parse(dataRecibida);
                alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);
            });

        }
    @endif
</script>
 
@endsection

 