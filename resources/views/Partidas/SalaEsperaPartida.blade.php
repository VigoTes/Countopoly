@extends('Layout.Plantilla')
@section('titulo')
    Sala de Espera
@endsection

@section('contenido')

<div class="row">
    <div class="col">
        <h1>
            Sala de espera de la partida
        </h1>
    </div>
</div>
<div class="row">

    <div class="col">
        <label for="">
            Tiempo de actualización:
           
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
    {{-- Estas opciones solo le aparecen al dueño de la partida --}}
    @if($partida->elHostEstaLogeado())

        <div class="col">
            <label for="">Edición</label>
            <select class="form-control" name="codEdicion" id="codEdicion" onchange="cambioEdicion()">
                @foreach($listaEdiciones as $edicion)
                    <option value="{{$edicion->codEdicion}}">
                        {{$edicion->nombre}}
                    </option>
                @endforeach
            </select>
        </div>
        

        <div class="col text-right">
            <a href="{{route('Partida.IniciarPartida',$partida->codPartida)}}" class="m-2 btn btn-success" >
                Iniciar Partida
            </a>
            <a href="{{route('Partida.CancelarPartida',$partida->codPartida)}}"  class="m-2 btn btn-danger">
                Cancelar Partida
            </a>
        </div>



    @endif

</div>
<div class="row m-2">
    <div class="col" id="contenedor">
        @include('Partidas.Invocables.inv_SalaEspera')

    </div>
</div>
 
<div class="row">
    <div class="col">
        <a class="btn btn-danger" href="{{route('Partida.SalirmeDePartida',$partida->codPartida)}}">
            <i class="fas fa-backspace"></i>
            Salir de la partida
        </a>
    </div>
    
</div>
 
@endsection

@section('script')
@include('Layout.ValidatorJS')

<script>
     


    relojActivo = true;

    $( document ).ready(function() {
        inicializarReloj(actualizarPartidas,700);

         
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

 