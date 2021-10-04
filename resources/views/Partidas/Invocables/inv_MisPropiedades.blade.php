<style>
    .dorado{
        color:rgb(192, 173, 0);
        
    }


    .flotandoIzquierda{
        z-index: 5;
        float: right;
        margin-right: 0.5em;
        margin-top: 0.5em;
    }

 
    
    .contenedorMisPropiedades{
        background-color: rgb(211, 211, 211);
        border-radius: 10px;
    }

    /* div que contiene todo */
    .carta{
      width: 8rem;
      padding:0.3rem;
      text-align: center;
      
      cursor: pointer;
  
      /* Borde */
      border-radius: 10px;
      border:solid;
      border-width: 2px;
      color:rgb(51, 51, 51);
      border-color: rgb(158, 158, 158);
      
    }
    .carta:hover{
      color:rgb(238, 238, 238);
      background-color:rgb(122, 122, 122);
    }
  
    /* <p> donde esta el nombre */
    .nombrePropiedad{
        width:100%;
        height: 3rem;
        
        font-weight: bold;
        font-size:12pt;
    }
  
    .divCircular{
        width:100%;      
        border-radius: 10px;
    }
  
    .iconoTotalmenteNegro{
      color:black;
    }
     
</style>

<div class="row m-1 contenedorMisPropiedades">


    @foreach ($listaMisPropiedades as $propiedadPartida)
        
        {{-- Cada DIV es una carta propiedad --}}
        <div class="m-1 carta" style="border-color: {{$propiedadPartida->getPropiedad()->getColor()->rgb}}" 
            data-toggle="modal" data-target="#ModalTarjetaPropiedad" onclick="clickAbrirTarjetaPropiedad({{$propiedadPartida->codPropiedad}})">
            

            <div class="divCircular" style="background-color: {{$propiedadPartida->getPropiedad()->getColor()->rgb}}">
                <i class="iconoTotalmenteNegro {{$propiedadPartida->getPropiedad()->getTipoPropiedad()->claseIcono}}" ></i>


                @if($propiedadPartida->jugadorTieneTodoElColor($jugador->codJugador))
                    <i class="flotandoIzquierda fas fa-star dorado fontSize7"></i>
                @endif
            </div>

            <p class="nombrePropiedad">
                {{$propiedadPartida->getPropiedad()->nombre}}
                
                
            </p>
            
            
        </div> 
    @endforeach
</div>

{{-- Para el banco no mostraré el mensaje --}}
@if($jugador->getPartida()->codJugadorBanco != $jugador->codJugador)
    <span class="fontSize7">
        <i class="fas fa-star dorado"></i> Tiene todas las propiedades del color
    </span>
@endif

