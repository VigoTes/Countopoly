
<table class="table table-sm">
    <thead>
        <tr>
            <th class="text-center" >
                #Partida
            </th>
            <th class="text-center">
                Host
            </th>
            <th>
                Descripción
            </th>
            <th>
                Jugadores
            </th>
            <th>
                Estado
            </th>
            <th>
                Limite
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
            <td>
                {{$partida->getCantJugadoresYMaximo()}}
            </td>
            <td>
                {{$partida->getEstado()->nombre}}
            </td>
            <td>
                @php

                    if($partida->estaEnEspera()){
                        $ruta = route('Partida.IngresarSalaEspera',$partida->codPartida);
                        $tipoBoton = "primary";
                        $icono = "fas fa-hourglass-half";
                        $msj = "Sala de espera";
                    }
                        
                    if($partida->estaJugandose()){
                        $ruta = route('Partida.EntrarSalaJuego',$partida->codPartida);
                        $tipoBoton = "success";
                        $icono = "fas fa-sign-in-alt";
                        $msj = "Entrar a sala de Juego";
                    }
                        
                @endphp
                @if($partida->estaJugandose() && $partida->estoyEnLaPartida() || $partida->estaEnEspera())
                        
                    <a href="{{$ruta}}" class="btn btn-{{$tipoBoton}}">
                        <i class="{{$icono}}"></i>
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
