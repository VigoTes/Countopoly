<div class="row">
    
    <label>
        Salidas de dinero del banco
    </label>
    
    
</div>
<div class="row">
    <p class="fontSize8">Manejado por: {{$jugadorBancario->getNombreUsuario()}}</p>
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
                <td>
                    {{$i}}
                </td>
                <td class="text-center fontSize9">
                    {{$transaccion->getFechaHora()}}
                </td>
                <td>
                    {{$transaccion->getReceptor()->usuario}}
                </td>
                <td>
                    {{$transaccion->getConceptoEmisor()}}
                </td>
                <td>
                    {{$transaccion->monto}}
                </td>
            </tr>
        @php
            $i--;
        @endphp
        @endforeach

    </tbody>

</table>