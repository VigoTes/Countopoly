{{-- ESTE ES EL CONTENIDO DEL MODAL TarjetaPropiedad --}}

<style>
    .tituloCuadradoPropiedad{
        border:solid 1px;
        border-width: 3px;
    }

    .tituloDeLaTarjeta{
        font-size: 18pt;
    }

    .textoTituloDePropiedad{
        padding:0px;
    }
</style>

<div class="text-center">

    <div class="row tituloCuadradoPropiedad" style="background-color: {{$propiedad->getColor()->rgb}}">

        <div class="col textoTituloDePropiedad">
            Titulo de propiedad
        </div>
        <div class="w-100"></div>

        <div class="col tituloDeLaTarjeta textoTituloDePropiedad">
            {{$propiedad->nombre}}
        </div>

    </div>

    <div class="row">
        <div class="col text-center">
            ALQUILER 
            <b>
                {{$propiedad->alquiler_normal}}
            </b>
        </div>
       
    </div>

    <div class="row">
        <div class="col">
            Con 1 Casa:
        </div>
        <div class="col">
            <b>
                {{$propiedad->alquiler_1casas}} 
            </b>
            
        </div>
    </div>

    <div class="row">
        <div class="col">
            Con 2 Casa:
        </div>
        <div class="col">
            <b>
                {{$propiedad->alquiler_2casas}} 
            </b>
            
        </div>
    </div>

    <div class="row">
        <div class="col">
            Con 3 Casa:
        </div>
        <div class="col">
            <b>
                {{$propiedad->alquiler_3casas}} 
            </b>
           
        </div>
    </div>

    <div class="row">
        <div class="col">
            Con 4 Casa:
        </div>
        <div class="col">
            <b>
                {{$propiedad->alquiler_4casas}} 
            </b>
           
        </div>
    </div>

    <div class="row">
        <div class="col">
            Con HOTEL:
            <b>
                {{$propiedad->alquiler_hotel}}
            </b>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            Valor Hipotecable: 
            <b>
                {{$propiedad->valorHipotecable}}
            </b>
            
        </div>
    </div>
    <div class="row">
        <div class="col">
            Las casas cuestan 
            <b>
                {{$propiedad->costo_casa}} 
            </b>
            cada una.
       
        </div>
         
    </div>
    <div class="row">
        <div class="col">
            Los hoteles 
            <b>

                {{$propiedad->costo_hotel}}
            
            </b>
            
            más 4 casas.
    
        </div>
        
    </div>
    
    
</div>