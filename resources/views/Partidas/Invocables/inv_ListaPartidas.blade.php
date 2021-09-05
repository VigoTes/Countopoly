
<table>
    <thead>
        <tr>
            <th class="text-center" >
                Item
            </th>
            <th class="text-center">
                Concepto
            </th>
            <th>
                Emisor
            </th>
            <th>
                Receptor
            </th>
            <th class="text-center">
                Monto
            </th>
        </tr>
    </thead>


    @foreach($listaPartidas as $partida)
        <tr>
            <td class="text-center">
                {{$partida->codPartida}}
            </td>
            <td class="text-center">
                {{$partida->getCuentaHost()->nombre}}
            </td>
            <td>
                {{$partida->getStringJugadoresYmaximo(}}
            </td>

            <td>
                <a href="" class="btn btn-success">
                    Ingresar
                </a>
            </td>

        </tr>
        @php
            $i = $i-1;
        @endphp
    @endforeach
</table>
