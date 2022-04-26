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
                
             </b>
             
        </b>
        <div class="card-tools">

        </div>
    </div><!-- /.card-header -->
    <div class="card-body cardBodyPadding">

        <div class="row">
            
            <div class="col">
                 <button type="button" onClick="crearNuevaOrden()">
                    Crear nueva orden
                 </button>
                 <input type="color" name="color" id="color">

            </div>
        </div>
          

    </div>
</div>
 

{{-- Boton de salir --}}
<div class="row">
    <div class="col">
        <a class="btn btn-danger" href="">
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
         
    });


    function crearNuevaOrden(){

        ruta = "/Proyecciones/AgregarOrden";
        datos = {
            codProyeccion: {{$proyeccion->codProyeccion}},
            valores: document.getElementById('color').value,
            codTipoOrden:1
        };

        $.get(ruta,datos, function(dataRecibida){
            console.log('DATA RECIBIDA:',dataRecibida);
            
        });

    }
     
 
</script>
 
@endsection

 