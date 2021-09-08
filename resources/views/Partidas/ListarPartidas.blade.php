

@extends('Layout.Plantilla')
@section('titulo')
    Flujograma
@endsection

@section('contenido')

 
    <div id="contenedor">


    </div>
 
@endsection

@section('script')
@include('Layout.ValidatorJS')

<script>
    inicializarReloj(actualizarPartidas,700);
    
    function actualizarPartidas(){ 
        ruta = "/Partida/getActualizacionListaPartidas/";
        $.get(ruta, function(dataRecibida){
            console.log('DATA RECIBIDA:');
            console.log(dataRecibida);
            contenedor = document.getElementById('contenedor');
            contenedor.innerHTML = dataRecibida;
            
            
        });
    }


</script>
 
@endsection

 