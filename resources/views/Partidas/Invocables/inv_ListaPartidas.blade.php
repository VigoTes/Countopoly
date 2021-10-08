
<table class="table table-sm fontSize9">
    <thead>
        <tr>
            <th class="text-center" >
                #
            </th>
            <th class="text-center">
                Host
            </th>
            <th>
                Desc
            </th>
            <th>
                Jugadores
            </th>
            <th>
                Estado
            </th>
            <th>
                Opciones
            </th>
        </tr>
    </thead>

    @php
        $i=1;
    @endphp
    @foreach($listaPartidas as $partida)

        @php

            /* Solo se muestra un boton si
                - Se puede ingresar a la sala de espera
                - Se puede ingresar a la partida aunque ya esté en curso (no soy parte aun)
                - Soy parte de la partida y esta ya está en curso 
                
            */
            $mostrarBoton = false;
            
            if($partida->estaEnEspera()){
                $mostrarBoton = true;
                $ruta = route('Partida.IngresarSalaEspera',$partida->codPartida);
                $tipoBoton = "primary";
                $icono = "fas fa-hourglass-half";
                $msj = "Entrar";
            }else{
                if($partida->estaJugandose()){ //si ya está en curso hay 3 casos
                    if($partida->estoyEnLaPartida()){ //estoy en la partida
                        $mostrarBoton = true;
                        $tipoBoton = "success";
                        $icono = " ";
                        $ruta = route('Partida.EntrarSalaJuego',$partida->codPartida);
                        $msj = "Entrar";
                    }else{ //no estoy en la partida
                        if($partida->sePuedenUnirDespues()){ //me puedo unir aunque se esté jugando
                            $mostrarBoton = true;
                            $tipoBoton = "primary";
                            $icono = " ";
                            $ruta = route('Partida.entrarAPartidaYaIniciada',$partida->codPartida);                           
                            $msj = "Unirme";
                        } //ya está en curso, no estoy y no me puedo unir boton 
                    }
                }
            }
                
        
            
        @endphp

        <tr>
            <td class="text-center">
                {{$partida->codPartida}}
            </td>
            <td class="text-center">
                {{$partida->getCuentaHost()->usuario}}
            </td>
            <td>
                {{$partida->descripcion}}
            </td>
            <td>
                {{$partida->getStringJugadores()}}
            </td>
            <td class="text-center">

                {{$partida->getEstado()->nombre}}

                <i class="{{$icono}}"></i>
                {{$partida->getCantJugadoresYMaximo()}}

            </td>
            <td>
                @if($mostrarBoton)
                    <a href="{{$ruta}}" class="btn-xs btn btn-{{$tipoBoton}}">
                        {{$msj}}
                    </a>  
                @endif
            </td>
        </tr>
        @php
            $i = $i-1;
        @endphp
    @endforeach
</table>
