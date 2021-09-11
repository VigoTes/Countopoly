
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
                Jugadores
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
                {{$partida->getStringJugadores()}}
            </td>
            <td>
                {{$partida->getCantJugadoresYMaximo()}}
            </td>
            <td>
                <a href="{{route('Partida.IngresarSalaEspera',$partida->codPartida)}}" class="btn btn-success">
                    Ingresar
                </a>
            </td>
        </tr>
        @php
            $i = $i-1;
        @endphp
    @endforeach
</table>
