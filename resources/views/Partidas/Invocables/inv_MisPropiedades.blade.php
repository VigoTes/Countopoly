
<h3>
    Mis propiedades:
</h3>

<table class="table table-sm">
    <thead>
        <tr>
            <th class="" >
                Item
            </th>
            <th class="">
                Propiedad
            </th>
            <th>
                Valor Compra
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($listaMisPropiedades as $propiedadPartida)
        
        <tr>
            <td>
                1
            </td>
            <td  >
                {{$propiedadPartida->getPropiedad()->nombre}}

                <div class="" style="background-color: {{$propiedadPartida->getPropiedad()->getColor()->rgb}}; width:50px; height:15px; border-radius: 7px;">
                </div>
            </td>
            <td>
                {{$propiedadPartida->getPropiedad()->precioCompra}}
            </td>
        </tr>   
        @endforeach
    </tbody>
</table>
 


