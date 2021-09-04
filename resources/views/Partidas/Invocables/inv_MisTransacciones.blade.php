
@php
    $cantidadTransacciones = count($listaMisTransacciones);
    $i = $$cantidadTransacciones;
@endphp


Cantidad actual en caja: {{$jugador->montoActual}}

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


    @foreach($listaMisTransacciones as $transaccion)
        <tr>
            <td class="text-center">
                {{$i}}            
            </td>
            <td class="text-center">
                {{$transaccion->getConcepto()}}
            </td>
            <td>
                {{$transaccion->getEmisor()->nombreUsuario}}
            </td>
            <td>
                {{$transaccion->getReceptor()->nombreUsuario}}
            </td>

            <td class="text-center" style="background-color:{{$transaccion->getColorSegunLogeado()}}">
                {{$transaccion->monto}}
            </td>
        </tr>
        @php
            $i = $i-1;
        @endphp
    @endforeach
</table>
