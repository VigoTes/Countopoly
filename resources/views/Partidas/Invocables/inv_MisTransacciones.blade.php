
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





<table class="table table-sm table-hover table-striped">
    <thead class="filaFijada fondoAzul letrasBlancas">
        <tr>
            <th class="text-center" >
                Item
            </th>
            <th class="text-center">
                Concepto
            </th>
            <th>
                Jugador
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
                {{$transaccion->getOtroJugadorSegunLogeado($jugador->codJugador)->getNombreUsuario()}}
            </td>
            

            <td class="text-center" style="color:{{$transaccion->getColorSegunJugador($jugador->codJugador)}}">
                <b>
                    {{$transaccion->getMonto()}}
                </b>
                
            </td>
        </tr>
        @php
            $i = $i-1;
        @endphp
    @endforeach
</table>
