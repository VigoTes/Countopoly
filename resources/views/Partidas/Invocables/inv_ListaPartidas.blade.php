
<table class="table table-sm">
    <thead>
        <tr>
            <th class="text-center" >
                Item
            </th>
            <th class="text-center">
                Cuenta
            </th>
            <th>
                Jugadores
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
                {{$partida->getStringJugadoresYmaximo()}}
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
