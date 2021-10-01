<option value="0">- Mis Propiedades -</option>
@foreach ($listaMisPropiedades as $propiedadPartida)    
    @php
        $color = $propiedadPartida->getPropiedad()->getColor();
        $colorLetras = $color->getContrasteRGB();
        $colorFondo = $color->rgb; 
    @endphp
    <option value="{{$propiedadPartida->codPropiedadPartida}}" style="background-color: {{$colorFondo}}; color: {{$colorLetras}}">
        {{$propiedadPartida->getPropiedad()->nombre}}
    </option>
@endforeach

