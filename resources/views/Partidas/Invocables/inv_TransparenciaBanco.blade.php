<div class="row">
    
    <label>
        Salidas de dinero del banco
    </label>
    @php
        $codJugadorBanco = $partida->codJugadorBanco;
    @endphp
    
</div>
<div class="row">
    <p class="fontSize8">Manejado por: {{$jugadorBancario->getNombreUsuario()}}</p>


</div>

<div class="row">
    <div class="col text-center">
        Pozo de la partida:
        <b>
            {{$partida->pozo}}
    
        </b>
    </div>
   
    
</div>

 
<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>
                Orden
            </th>
            <th>
                Hora
            </th>
            <th>
                Jugador
            </th>
            <th>
                Concepto
            </th>
            <th>
                Monto
            </th>

        </tr>

    </thead>
    <tbody>
        @php
            $i=count($transacciones);
        @endphp
        @foreach ($transacciones as $transaccion)
            <tr>
                <td class="text-center">
                    {{$i}}
                </td>
                <td class="text-center fontSize9">
                    {{$transaccion->getFechaHora()}}
                </td>
                <td class="text-center">
                    {{$transaccion->getReceptor()->usuario}}
                </td>
                <td class="text-center">
                    {{$transaccion->getConceptoEmisor()}}
                </td>
                <td class="text-right" style="color:{{$transaccion->getColorSegunJugador($codJugadorBanco)}}">
                    {{$transaccion->getMonto()}}
                </td>
            </tr>
        @php
            $i--;
        @endphp
        @endforeach

    </tbody>

</table>