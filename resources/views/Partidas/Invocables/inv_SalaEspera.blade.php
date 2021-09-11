
{{-- 
    Esta minivista la llaman todos los jugadores,
    
    --}}

<div class="row">

    <div class="col">
         
    </div>

</div>
<div class="row">
    <table class="table table-sm">
        <thead class="header">
            <th>
                Nro
            </th>
            <th>
                Jugador
            </th>
            @if($partida->elHostEstaLogeado())
                     
            <th>
                Opciones
            </th>
            @endif
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($listaJugadores as $jugador)
                <tr>
                    <td>
                        {{$i}}
                        
                        @if($jugador->codCuenta == $partida->codCuentaHost)
                            <b>[Host]</b>
                        @endif

                        @if($jugador->codJugador == $partida->codJugadorBancario)
                            <b>[BANCO]</b>
                        @endif
                    </td>
                    <td>
                        
                        {{$jugador->getCuenta()->usuario}}
                    </td>

                    @if($partida->elHostEstaLogeado()) {{-- OPCIOENS PARA EL HOST DE LA PARTIDA --}}
                    <td>
                        @if($jugador->codCuenta != $cuentaLogeada->codCuenta)
                            <button type="button" class="btn btn-danger">
                                Expulsar 
                                <i class="fas fa-ban"></i>
                            </button>
                        @endif

                        @if($jugador->codJugador != $partida->codJugadorBancario)
                            <button type="button" class="btn btn-info" onclick="hacerBancario({{$jugador->codJugador}})">
                                
                                Hacer bancario
                            </button>
                        @endif

                    </td>
                    @endif

                    
                </tr>    
            @php
                $i++;
            @endphp
            @endforeach 

        </tbody>
    </table>
    
    

</div>