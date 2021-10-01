{{-- 
<b>
    Mis propiedades:
</b>
 --}}
<div class="row mt-1 mb-1 contenedorMisPropiedades">


    @foreach ($listaMisPropiedades as $propiedadPartida)
        
        {{-- Cada DIV es una carta propiedad --}}
        <div class="m-1 carta" style="border-color: {{$propiedadPartida->getPropiedad()->getColor()->rgb}}" 
            
            data-toggle="modal" data-target="#ModalTarjetaPropiedad" onclick="clickAbrirTarjetaPropiedad({{$propiedadPartida->codPropiedad}})">
            
            <div class="divCircular" style="background-color: {{$propiedadPartida->getPropiedad()->getColor()->rgb}}">
                <i class="iconoTotalmenteNegro {{$propiedadPartida->getPropiedad()->getTipoPropiedad()->claseIcono}}" ></i>
            </div>

            <p class="nombrePropiedad" onclick="">
                {{$propiedadPartida->getPropiedad()->nombre}}
            </p>
        </div> 
    @endforeach
</div>

<style>
    
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