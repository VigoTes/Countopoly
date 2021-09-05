
<div id="contenedor">


</div>

<script>
    
    inicializarReloj(actualizarPartidas,700);
    
    function actualizarPartidas(){ 
        ruta = "/Partida/getActualizacionListaPartidas/";
        $.get(ruta, function(dataRecibida){
            console.log('DATA RECIBIDA:');
            console.log(dataRecibida);
            contenedor = document.getElementById('contenidoMisTransacciones');
            contenedor.innerHtml = objetoRespuesta.body;
            
            
        });
    }


</script>

PARA LA LIBRERIA VALIDATOR JS LLAMAR DE TODAS MIS APLICACIONES MEDIANTE UNA API CON JSON 