<option value="0">- Mis Propiedades -</option>
@foreach ($listaMisPropiedades as $propiedadPartida)    
    <option value="{{$propiedadPartida->codPropiedadPartida}}">
        {{$propiedadPartida->getPropiedad()->nombre}}
    </option>
@endforeach

