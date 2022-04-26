<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body id="main">
    
    <div >
         
        
        
        <span id="debugger">
             
        </span>
        
        
    </div>

</body>
</html>
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
@include('Layout.ValidatorJS')

<script>

    tokenSincronizacion = 0;
    listaOrdenesPendientes = [];

    $( document ).ready(function() {
        
         
        inicializarReloj(actualizarOrdenes,{{$proyeccion->tiempoActualizacion*1000}});
        inicializarReloj(ejecutarOrdenesPendientes,{{$proyeccion->tiempoActualizacion*1000}});
        
        
    });



    function actualizarOrdenes(){

        ruta = "/Proyecciones/{{$proyeccion->codProyeccion}}/retornarOrdenesPendientes/" + tokenSincronizacion;
        datosEnviados = {
            tokenSincronizacion : tokenSincronizacion,
            codProyeccion:{{$proyeccion->codProyeccion}}
        };


        $.get(ruta,datosEnviados, function(dataRecibida){
            
            objetoRespuesta = dataRecibida;
            if(objetoRespuesta.sincronizado == '1'){ //SINCRONIZADO
                //console.log("El Contenido ya está sincronizado.");
            }else{ //DESINCRONIZADO
                
                console.log("Sincronizando el contenido -> nuevasOrdenes:",dataRecibida);
                tokenSincronizacion = objetoRespuesta.nuevoToken;
                listaOrdenesPendientes = listaOrdenesPendientes.concat(objetoRespuesta.listaOrdenes);
                
                //console.log("listaOrdenesPendientes:",listaOrdenesPendientes)
                actualizarDebugger();
            }
        
        });

    }


    function ejecutarOrdenesPendientes(){
        
        for (let index = 0; index  < listaOrdenesPendientes.length; index++) {
            
            var ordenAEjecutar = listaOrdenesPendientes.shift();
            
            ejecutarOrden(ordenAEjecutar);
            actualizarDebugger();
        }

    }

    function ejecutarOrden(orden){
        console.log("Ejecutando orden:",orden)
        document.getElementById("main").appendChild
        var img = document.createElement("img");
        img.src = "/img/CheemsError.png";
        img.className="cheems leftToRightAnimation"
        main.appendChild(img); 

        setTimeout(function(){
            main.removeChild(img);
        }, 3000);
        


    }

    function actualizarDebugger(){

        var cad = "";
        listaOrdenesPendientes.forEach(element => {
            cad += element.codOrden + " / " + element.valores + "<br>";
        });
        //document.getElementById('debugger').innerHTML = cad; 
            

    }

 </script>

 <style>
     html{
         
     }



     .cheems{
        width: 200px;
        height: 200px;
        position: absolute;
        background-color: red
     }

     .leftToRightAnimation{
        animation-duration: 8s;
        animation-name: slidein;
        animation-iteration-count: 1;
     } 



     @keyframes slidein {
        from {
            margin-left: 130%;
            margin-top: auto;
             
        }

        to {
            margin-left: -300%;
            margin-top:auto;
        }
    }
 </style>