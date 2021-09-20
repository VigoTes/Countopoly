{{-- ESTE ES EL CONTENIDO DEL MODAL TarjetaPropiedad --}}

<style>
    .tituloCuadradoPropiedad{
        border:solid 1px;
        border-width: 3px;
        border-radius: 7px;
        border-color:rgb(37, 37, 37);
    }

    .tituloDeLaTarjeta{
        font-size: 18pt;
    }

    .textoTituloDePropiedad{
        padding:0px;
    }

</style>


<div class="text-center">

    <div class="row tituloCuadradoPropiedad" 
        style="
            background-color: {{$propiedad->getColor()->rgb}}; 
            color:{{$propiedad->getColor()->getContrasteRGB()}}
            "
            
        >

        <div class="col textoTituloDePropiedad">
            Titulo de propiedad
        </div>
        <div class="w-100"></div>

        <div class="col tituloDeLaTarjeta textoTituloDePropiedad">
            {{$propiedad->nombre}}
            <i class="{{$propiedad->getTipoPropiedad()->claseIcono}}"></i>
        </div>

    </div>
    
    
    

    @if($propiedad->esNormal())
       
        {{-- PROPIEDAD DE TIPO NORMAL --}}
        <div class="">
            <div class="row">
                <div class="col text-center">
                    ALQUILER:
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
            

 
    @endif


    @if($propiedad->esTren())
        
        <style>
            .izqTren{
                width: 60%;
                text-align: left;
            }
            .derTren{
                width: 30%;
                text-align: right;
            }
        </style>
        {{-- PROPIEDAD DE TIPO TREN O FERROCARRIL --}}
        <div class="m-1">
            <div class="row">
                <div class="col text-center">
                    ALQUILER:
                    <b>
                        {{$propiedad->alquiler_normal}}
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="izqTren">
                    Al poseer 2 ferrocarriles:
                </div>
                <div class="derTren">
                    {{$edicion->alquiler2trenes}}
                </div>
            </div>
            <div class="row">
                <div class="izqTren">
                    Al poseer 3 ferrocarriles:
                </div>
                <div class="derTren">
                    {{$edicion->alquiler3trenes}}
                </div>
            </div>
            <div class="row">
                <div class="izqTren">
                    Al poseer 4 ferrocarriles:
                </div>
                <div class="derTren">
                    {{$edicion->alquiler4trenes}}
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

        </div>

    @endif

    @if($propiedad->esServicio())
        
        {{-- PROPIEDAD DE TIPO SERVICIO  --}}
        <p class="text-justify">
            <br>
            De poseer una sola "Utilidad", cóbrese un alquiler que corresponde al lance de los dados multiplicado por 
            <b>
                4 {{$edicion->servicios_multiplicador1propiedad}}
            </b>
            
            .
            <br>
            <br>
            De poseer ambas "Utilidades", multiplíquese el lance por 
            <b>
                10 {{$edicion->servicios_multiplicador2propiedades}}
            </b>
        
            .
        </p>

        <div class="row">
            <div class="col">
                Valor Hipotecable: 
                <b>
                    {{$propiedad->valorHipotecable}}
                </b>
                
            </div>
        </div>


    @endif



</div>








