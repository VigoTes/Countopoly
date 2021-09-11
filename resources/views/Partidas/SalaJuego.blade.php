

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
        {{$partida->getStringJugadores()}}
    </div>
    
</div>
<div class="row m-2">
    

    <div clas="col" id="contenidoMisTransacciones">

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

    inicializarReloj(actualizarTransacciones,500);
    
    function actualizarTransacciones(){ 
        ruta = "/Partida/getActualizacionPartida/" + codUltimaTransaccion ;
        $.get(ruta, function(dataRecibida){
            console.log('DATA RECIBIDA:');
            console.log(dataRecibida);
            
            objetoRespuesta = JSON.parse(dataRecibida);
            if(objetoRespuesta.sincronizado == '1'){ //SINCRONIZADO
                console.log("El Contenido ya está sincronizado.");
            }else{ //DESINCRONIZADO
                console.log("Sincronizando el contenido...");
                contenedor = document.getElementById('contenidoMisTransacciones');
                contenedor.innerHtml = objetoRespuesta.body;
            }
            codUltimaTransaccion = objetoRespuesta.codUltimaTransaccion;
            console.log('Ciclo de sincronización completada. Ultima tr=' + codUltimaTransaccion );
        });
    }

</script>
@endsection

 

















