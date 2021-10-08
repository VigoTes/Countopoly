

@extends('Layout.Plantilla')
@section('titulo')
    Flujograma
@endsection

@section('contenido')
@include('Layout.MensajeEmergenteDatos')


<div class="row">
    <div class="col">

    </div>
    <div class="col text-right">
        <a href="{{route('Partida.abrirPartida')}}" class="m-2 btn-xs btn btn-success" >
            Nueva Partida

        </a>
    </div>

</div>
<div class="row">
    <div class="col" id="contenedor">
        {{-- Para que aparezcan las partidas antes de empezar a actualizarse --}}
        @include('Partidas.Invocables.inv_ListaPartidas')
    </div>
</div>
 
 
@endsection

@section('script')
@include('Layout.ValidatorJS')

<script>

    $( document ).ready(function() {


        inicializarReloj(actualizarPartidas,700);
            
    });

    function actualizarPartidas(){ 
        ruta = "/Partida/getActualizacionListaPartidas/";
        $.get(ruta, function(dataRecibida){
            console.log('DATA RECIBIDA:');
            //console.log(dataRecibida);
            contenedor = document.getElementById('contenedor');
            contenedor.innerHTML = dataRecibida;
            
            
        });
    }


</script>
 
@endsection

 