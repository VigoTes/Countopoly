

<div class="row">
    
    <div class="col">
        <label for="">
            Emisor: 
        </label>
        <input type="text" class="form-control text-center"  readonly value="{{$transaccion->getEmisor()->usuario}}">
    </div>
    <div class="w-100"></div>
    <div class="col">
        <label for="">
            Receptor:
        </label>
        <input type="text" class="form-control text-center" readonly value="{{$transaccion->getReceptor()->usuario}}">
    </div>
    <div class="w-100"></div>
    <div class="col">
        <label for="">
            Monto:
        </label>

        {{-- Aqui faltaria la logica en caso de que el mismo jugador sea el bancario y el que recibio/envio dinero --}}
        <input type="text" style="color: {{$transaccion->getColorSegunJugador($jugador->codJugador)}}" 
            class="form-control text-right" readonly value="{{$transaccion->getMonto()}}">
    </div>
    <div class="w-100"></div>
    <div class="col">
        <label for="">
            Concepto:
        </label>
        <input type="text" class="form-control text-center" readonly value="{{$transaccion->getConcepto()}}">
    </div>
    <div class="w-100"></div>
    
    <div class="col">
        <label for="">
            Fecha y hora:
        </label>
        <input type="text" class="form-control text-center" readonly value="{{$transaccion->getFechaHora()}}">
    </div>
     
      
     
    
</div>
 
