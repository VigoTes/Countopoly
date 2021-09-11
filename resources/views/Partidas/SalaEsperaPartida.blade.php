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
         
    </div>

    {{-- Estas opciones solo le aparecen al dueño de la partida --}}
    @if($partida->elHostEstaLogeado())
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


    $( document ).ready(function() {
        inicializarReloj(actualizarPartidas,700);
        
    });
    contenidoActual = "";
    
    function actualizarPartidas(){ 
        ruta = "/Partida/getActualizacionSalaEspera/{{$partida->codPartida}}";
        $.get(ruta, function(dataRecibida){
            //console.log('DATA RECIBIDA:');
            //console.log(dataRecibida);
            contenedor = document.getElementById('contenedor');
            if(contenidoActual!=dataRecibida){ //si es diferente, actualizamos. Si
                console.log('Actualizando...');
                contenedor.innerHTML = dataRecibida;
                contenidoActual = dataRecibida;
            }else{
                 
            }
                
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
    @endif
</script>
 
@endsection

 