
@php
    $cantidadTransacciones = count($listaMisTransacciones);
    $i = $cantidadTransacciones;
@endphp

<style>
    .cantidadActual{
        width:7rem;
    }
    .inputCantidadActual{
        /* arriba derecha abajo izquierda */
        padding: 6px;
    }
</style>





<table class="table table-sm">
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
                {{$transaccion->getEmisor()->usuario}}
            </td>
            <td>
                {{$transaccion->getReceptor()->usuario}}
            </td>

            <td class="text-center" style="color:{{$transaccion->getColorSegunJugador($jugador->codJugador)}}">
                {{$transaccion->monto}}
            </td>
        </tr>
        @php
            $i = $i-1;
        @endphp
    @endforeach
</table>
