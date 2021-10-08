<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
            <i class="fas fa-university"></i>
            Banco
        </h3>
        <div class="card-tools">

        </div>
    </div><!-- /.card-header -->
    <div class="card-body cardBodyPadding">
        <div class="row">
            
            <div class="col">    
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBancoEnviarPago">
                    <i class="fas fa-hand-holding-usd"></i>

                    Pago
                 </button>


                 <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEnviarPozo">
                    <i class="fas fa-hand-holding-usd"></i>

                    Pozo
                 </button>

                 <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEnviarPagoSalida">
                    <i class="fas fa-play"></i>
                    go
                 </button>
                 

            </div>  
            <div class="col text-right montoActual">
                <i class="fas fa-cash-register"></i>
                <span id="banco_montoActual"></span>
            </div>
           
        </div>

        <div class="row">
            {{-- TABLA DE LAS TRANSACCIONES DEL BANCO --}}
            <div class="col divTablaFijada" id="banco_Transacciones">
                
            </div>
        
        </div>

        <br>
        <div class="row">

            {{-- FORM DE LAS TRANSFERENCIAS DE PROPIEDAD DEL BANCO --}}
            <div class="col">    
                <button class="btn btn-success btn-sm"   data-toggle="modal" data-target="#ModalBancoTransferirPropiedad">
                    
                    <i class="fas fa-random"></i>
                    Transferir propiedad
                 </button>
                
                
            </div> 

        </div>
        <div class="row">
            {{-- TABLA DE LAS PROPIEDADES DEL BANCO --}}
            <div class="col" id="banco_propiedades">

            </div>
        </div>
    </div><!-- /.card-body -->
</div>









{{-- MODAL para enviar PAGO DESDE EL BANCO  --}}
<div class="modal fade" id="ModalBancoEnviarPago" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">
                         Enviar Pago
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="">
                    <div class="row">
                        <div class="col">    
            
                            <div class="row">
                                <div class="col">
                                    <label  for="" >
                                        Destinatario:
                                    </label>
                                    <select  class="form-control m-1" name="banco_codJugadorDestino" id="banco_codJugadorDestino">
                                        <option value="0">- Jugadores -</option>
                                        @foreach ($listaJugadores as $jugador)
                                            @if($jugador->codJugador != $partida->codJugadorBanco)
                                                <option value="{{$jugador->codJugador}}">
                                                    {{$jugador->getNombreUsuario()}}
                                                </option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>

                                 
                            </div>
                            
                            
                            <div class="row">
                                <div class="col">
                                    
                                    <label for="">Concepto</label>
                                                    
                                    <select  class="form-control m-1" name="banco_codTipoTransaccion" id="banco_codTipoTransaccion">
                                        <option value="0">- Tipo Pago - </option>
                                        @foreach ($listaTipoTransaccion_banco as $tipoTransaccion)
                                            <option value="{{$tipoTransaccion->codTipoTransaccion}}">
                                                {{$tipoTransaccion->conceptoEmisor}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                    
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Monto:</label>
                                    <input  placeholder ="Monto pago..." type="number" class="text-right form-control m-1" 
                                        step="01" id="banco_monto" name="banco_monto" value="">
                                

                                
                                </div>

                            </div>
                            <div class="row mt-1">
                                <div class="col text-right">
                                    


                                    <button onclick="banco_clickRealizarPago()" type="button" class="mt-2 ml-2 btn btn-primary">
                                        <i class="fas fa-hand-holding-usd"></i>
                                        Enviar Pago
                                    </button>

                                    
                                </div>
                            </div>
                        </div>    
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <button id="botonSalirModalBancoEnviarPago" type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>
 
                </div>
            
        </div>
    </div>
</div>




{{-- MODAL para TRANSFERIR PROPIEDAD DESDE EL BANCO  --}}
<div class="modal fade" id="ModalBancoTransferirPropiedad" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">
                         Transferir Propiedad
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="">
                    <div class="row">
                        <div class="col">
                            <label for="">
                                Destinatario
                            </label>
                           
                            <select class="form-control m-1" name="banco_codJugadorATransferirPropiedad" id="banco_codJugadorATransferirPropiedad">
                                <option value="0">- Jugadores -</option>
                                @foreach ($listaJugadores as $jugador)
                                    @if($jugador->codJugador != $partida->codJugadorBanco)
                                        <option value="{{$jugador->codJugador}}">
                                            {{$jugador->getNombreUsuario()}}
                                        </option>
                                    @endif
                                    
                                @endforeach
                            </select>
        

                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                            <label for="">
                                Propiedad
                            </label>
                           
                            <select  class="form-control m-1" name="banco_codPropiedadPartida" id="banco_codPropiedadPartida">
                                <option value="0">- Propiedades -</option>
                                @foreach ($banco_listaMisPropiedades as $miPropiedad)
                                    <option value="{{$miPropiedad->codPropiedadPartida}}" style="color:black; background-color:{{$miPropiedad->getPropiedad()->getColor()->rgb}}">
                                        {{$miPropiedad->getPropiedad()->nombre}}
                                    </option>
                                @endforeach
                            </select>
                            
        
                        </div>
                     </div>
                     <div class="row">
                        <div class="col text-right">
  
                            <button  onclick="banco_clickTransferirPropiedad()" type="button" class="mt-2 ml-2 btn btn-primary">
                                Transferir <i class="fas fa-random"></i>
                            </button>
 
                        </div>
                     </div>
                      
                </div>
                <div class="modal-footer">
                    <button id="botonCerrarModalBancoTransferirPropiedad" type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>
 
                </div>
            
        </div>
    </div>
</div>
      
{{-- MODAL para ENVIAR EL DINERO DEL POZO DESDE EL BANCO  --}}
<div class="modal fade" id="ModalEnviarPozo" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">
                         Enviar dinero del pozo
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="">
                    <div class="row">
                        <div class="col">
                            <label for="">
                                Destinatario
                            </label>
                           
                            <select class="form-control m-1" name="banco_codJugadorAEnviarPozo" id="banco_codJugadorAEnviarPozo">
                                <option value="0">- Jugadores -</option>
                                @foreach ($listaJugadores as $jugador)
                                    @if($jugador->codJugador != $partida->codJugadorBanco)
                                        <option value="{{$jugador->codJugador}}">
                                            {{$jugador->getNombreUsuario()}}
                                        </option>
                                    @endif
                                    
                                @endforeach
                            </select>
        

                        </div>
                        <div class="w-100">

                        </div>
                        <div class="col">
                            <label for="">
                                Monto
                            </label>
                            <input type="text" id="frmEnviarPozo_monto" class="text-right form-control" readonly value="{{$partida->pozo}}">

                        </div>
                     </div>
                    
                     <div class="row">
                        <div class="col text-right">
  
                            <button  onclick="banco_clickEnviarPozo()" type="button" class="mt-2 ml-2 btn btn-primary">
                                Enviar <i class="fas fa-random"></i>
                            </button>
 
                        </div>
                     </div>
                      
                </div>
                <div class="modal-footer">
                    <button id="botonCerrarEnviarPozo" type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>
 
                </div>
            
        </div>
    </div>
</div>
      
{{-- MODAL para HACER UN PAGO RAPIDO POR SALIDA  --}}
<div class="modal fade" id="ModalEnviarPagoSalida" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-sm">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">
                         Enviar pago SALIDA
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="">
                    <div class="row">
                        <div class="col">
                            <label for="">
                                Destinatario
                            </label>
                           
                            <select class="form-control m-1" name="banco_codJugadorAEnviarSalida" id="banco_codJugadorAEnviarSalida">
                                <option value="0">- Jugadores -</option>
                                @foreach ($listaJugadores as $jugador)
                                    @if($jugador->codJugador != $partida->codJugadorBanco)
                                        <option value="{{$jugador->codJugador}}">
                                            {{$jugador->getNombreUsuario()}}
                                        </option>
                                    @endif
                                    
                                @endforeach
                            </select>
        

                        </div>
                        
                        
                     </div>
                    
                     <div class="row">
                        <div class="col text-right">
  
                            <button  onclick="banco_clickEnviarPagoSalida()" type="button" class="mt-2 ml-2 btn btn-primary">
                                Enviar <i class="fas fa-random"></i>
                            </button>
 
                        </div>
                     </div>
                      
                </div>
                <div class="modal-footer">
                    <button id="botonCerrarEnviarSalida" type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>
 
                </div>
            
        </div>
    </div>
</div>
      



