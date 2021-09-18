<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
            <i class="fas fa-university"></i>
            Banco
        </h3>
        <div class="card-tools">

        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            

            {{-- Form de PAGAR COMO  BANCO --}}
            <div class="col">    
                <label  for="" >Pagar a:</label>
                <div class="row">
                    <input  style="width:30%" placeholder ="Monto pago..." type="number" class="text-right form-control m-1" 
                        step="01" id="banco_monto" name="banco_monto" value="0">
                    <select  style="width:40%" class="form-control m-1" name="banco_codJugadorDestino" id="banco_codJugadorDestino">
                        <option value="0">- Jugadores -</option>
                        @foreach ($listaJugadores as $jugador)
                            @if($jugador->codJugador != $partida->codJugadorBanco)
                                <option value="{{$jugador->codJugador}}">
                                    {{$jugador->getNombreUsuario()}}
                                </option>
                            @endif
                            
                        @endforeach
                    </select>

                    <select  style="width:40%" class="form-control m-1" name="banco_codTipoTransaccion" id="banco_codTipoTransaccion">
                        <option value="0">- Tipo Pago - </option>
                        @foreach ($listaTipoTransaccion_banco as $tipoTransaccion)
                            <option value="{{$tipoTransaccion->codTipoTransaccion}}">
                                {{$tipoTransaccion->conceptoEmisor}}
                            </option>
                        @endforeach
                    </select>
                    

                    <button style="height:70%" onclick="banco_clickRealizarPago()" type="button" class="mt-2 ml-2 btn btn-primary btn-sm">
                        <i class="fas fa-hand-holding-usd"></i>
                        Pagar
                    </button>
                </div>
                
            </div>   
        </div>

        <div class="row">
            {{-- TABLA DE LAS TRANSACCIONES DEL BANCO --}}
            <div class="col" id="banco_Transacciones">
                
            </div>
        
        </div>
        <div class="row">

            {{-- FORM DE LAS TRANSFERENCIAS DE PROPIEDAD DEL BANCO --}}
            <div class="col">    
                <label  for="" >Transferir propiedad a:</label>
                <div class="row">
                    <select  style="width:40%" class="form-control m-1" name="banco_codJugadorATransferirPropiedad" id="banco_codJugadorATransferirPropiedad">
                        <option value="0">- Jugadores -</option>
                        @foreach ($listaJugadores as $jugador)
                            @if($jugador->codJugador != $partida->codJugadorBanco)
                                <option value="{{$jugador->codJugador}}">
                                    {{$jugador->getNombreUsuario()}}
                                </option>
                            @endif
                            
                        @endforeach
                    </select>

                    <select  style="width:40%" class="form-control m-1" name="banco_codPropiedadPartida" id="banco_codPropiedadPartida">
                        <option value="0">- Propiedades -</option>
                        @foreach ($banco_listaMisPropiedades as $miPropiedad)
                            <option value="{{$miPropiedad->codPropiedadPartida}}" style="color:black; background-color:{{$miPropiedad->getPropiedad()->getColor()->rgb}}">
                                {{$miPropiedad->getPropiedad()->nombre}}
                            </option>
                        @endforeach
                    </select>
                    

                    <button style="height:70%" onclick="banco_clickTransferirPropiedad()" type="button" class="mt-2 ml-2 btn btn-primary btn-sm">
                        <i class="fas fa-hand-holding-usd"></i>
                        Transferir
                    </button>
                </div>
                
            </div> 

        </div>
        <div class="row">
            {{-- TABLA DE LAS PROPIEDADES DEL BANCO --}}
            <div class="col" id="banco_propiedades">

            </div>
        </div>
    </div><!-- /.card-body -->
</div>