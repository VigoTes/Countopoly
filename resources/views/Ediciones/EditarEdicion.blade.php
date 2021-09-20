

@extends('Layout.Plantilla')
@section('titulo')
    Editar Edición
@endsection

@section('estilos')
<style>
    .contenedor{
        border-radius: 10px;
        background-color: rgb(226, 226, 226);
        padding: 10px;
    }
</style>
@endsection

@section('contenido')
@include('Layout.MensajeEmergenteDatos')
<form id="frmEdicion" name="frmEdicion" action="{{route('Edicion.ActualizarNombre')}}" method="POST" > 
    @csrf
    <input type="hidden" name="codEdicion" value="{{$edicion->codEdicion}}">
    <div class="row">

        <div class="col">
            <label for="">Nombre de la edición</label>
            <input class="form-control" type="text" id="nombreEdicion" name="nombreEdicion" value="{{$edicion->nombre}}">
        </div>
        <div class="col">
            <button type="button" onclick="clickActualizarNombre()" class="mt-4 btn btn-success">
                <i class="fas fa-save"></i>
                Actualizar nombre
            </button>
        </div>
        <div class="col">

        </div>


    </div>

</form>
<div class="row">


    <div class="col text-right">
        <button onclick="limpiarModal()" class="m-2 btn btn-success" 
        data-toggle="modal" data-target="#ModalPropiedad">
            Agregar Propiedad
        </button>
    </div>

</div>
<div class="row m-2">
     <table class="table table-sm fontSize9">
        <thead>
            <tr>
                <th>codPropiedad</th>
                <th>nombre</th>
                <th>lado</th>
                <th>precioCompra</th>
               
                <th>Tipo Propiedad</th>

                <th>Alquiler Normal</th>
                <th>Alquiler 1c</th>
                <th>Alquiler 2c</th>
                <th>Alquiler 3c</th>
                <th>Alquiler 4c</th>
                <th>Alquiler Hotel</th>
                <th>Valor Hipotecable</th>
                <th>Costo por casa</th>
                <th>Costo por hotel</th>
                <th>Color</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaPropiedades as $propiedad )
                    
                <tr style="background-color: {{$propiedad->color_rgb}}">
                    
                    <td>
                        {{$propiedad->codPropiedad}}
                    </td>
                    <td>
                        {{$propiedad->nombre}}
                    </td>
                    <td>
                        {{$propiedad->lado}}
                    </td>
                    <td>
                        {{$propiedad->precioCompra}}
                    </td>
                     
                    <td>
                        {{$propiedad->getTipoPropiedad()->nombre}}
                    </td>


                    <td>
                        {{$propiedad->alquiler_normal}}
                    </td>
                    <td>
                        {{$propiedad->alquiler_1casas}}
                    </td>
                    <td>
                        {{$propiedad->alquiler_2casas}}
                    </td>
                    <td>
                        {{$propiedad->alquiler_3casas}}
                    </td>
                    <td>
                        {{$propiedad->alquiler_4casas}}
                    </td>
                    <td>
                        {{$propiedad->alquiler_hotel}}
                    </td>
                    <td>
                        {{$propiedad->valorHipotecable}}
                    </td>
                    <td>
                        {{$propiedad->costo_casa}}
                    </td>
                    <td>
                        {{$propiedad->costo_hotel}}
                    </td>
                    
                    
                    
                    
                    
                    

                    <td>
                        {{$propiedad->getColor()->nombre}}
                        <div class="" style="background-color: {{$propiedad->getColor()->rgb}}; width:15px; height:15px; border-radius: 7px;">
                        </div>
                    </td>                    
                    
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" 
                        data-target="#ModalPropiedad" onclick="clickEditarPropiedad({{$propiedad->codPropiedad}})"> 
                        <i class="fas fa-pen"></i>
                        
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="clickEliminarPropiedad({{$propiedad->codPropiedad}})">
                            <i class="fas fa-trash"></i>

                        </button>
 
                    </td>
                
                </tr>
                
            @endforeach
        </tbody>
     </table>
</div>
 

{{-- Este modal sirve tanto para agregar como para editar --}}
<div class="modal fade" id="ModalPropiedad" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalPropiedad"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Edicion.agregarEditarPropiedad')}}" method="POST" id="frmPropiedad" name="frmPropiedad">
                        
                        @csrf
                        {{-- Si se creará uno nuevo, está en 0, si se va a editar tiene el codigo del obj a editar --}}
                        <input type="{{App\Configuracion::getInputTextOHidden()}}" name="codPropiedad" id="codPropiedad" value="0">
                        <input type="{{App\Configuracion::getInputTextOHidden()}}" name="codEdicion" id="codEdicion" value="{{$edicion->codEdicion}}">
                        
                        
                        <div class="row contenedor">
                            <div class="col">
                                <label for="">nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="">lado (1-4)</label>
                                <input type="number" min="1" max="4" step="1" class="form-control" name="lado" id="lado">
                            </div>
                             

                            <div class="col">
                                <label for="">precioCompra</label>
                                <input type="number" class="form-control" name="precioCompra" id="precioCompra">
                            </div>
                             

                            <div class="col">
                                <label for="">Valor hipotecable</label>
                                <input type="number" class="form-control" name="valorHipotecable" id="valorHipotecable">
                            </div>
                            <div class="w-100"></div>

                            <div class="col">
                                <label for="">Costo x Casa</label>
                                <input type="number" class="form-control" name="costo_casa" id="costo_casa">
                            </div>
                             
                            <div class="col">
                                <label for="">Costo de Hotel</label>
                                <input type="number" class="form-control" name="costo_hotel" id="costo_hotel">
                            </div>
                            <div class="w-100"></div>



                            <div class="col">
                                <label for="">Color</label>
                                
                                <select class="form-control" name="codColor" id="codColor">
                                    <option value="0">- Color -</option>
                                    @foreach ($listaColores as $color)
                                        <option style="background-color: {{$color->rgb}}" value="{{$color->codColor}}">
                                            {{$color->nombre}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col">
                                <label for="">Tipo Propiedad</label>
                                <select class="form-control" name="codTipoPropiedad" id="codTipoPropiedad">
                                    <option value="0">- Tipo -</option>
                                    @foreach ($listaTipoPropiedades as $tipoPropiedad)
                                        <option  value="{{$tipoPropiedad->codTipoPropiedad}}">
                                            {{$tipoPropiedad->nombre}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <label for="">
                            Alquileres:
                        </label>
                        <div class="row contenedor">
                            
                            
                              
                            <div class="col">
                                <label for="">Normal</label>
                                <input type="number" class="form-control" name="alquiler_normal" id="alquiler_normal">
                            </div>
                             
                            <div class="col">
                                <label for="">1 Casa</label>
                                <input type="number" class="form-control" name="alquiler_1casas" id="alquiler_1casas">
                            </div>
                            
                            <div class="col">
                                <label for="">2 Casas</label>
                                <input type="number" class="form-control" name="alquiler_2casas" id="alquiler_2casas">
                            </div>
                            
                            <div class="col">
                                <label for="">3 casas</label>
                                <input type="number" class="form-control" name="alquiler_3casas" id="alquiler_3casas">
                            </div>
                            <div class="w-100"></div>
                            
                            <div class="col">
                                <label for="">4 casas</label>
                                <input type="number" class="form-control" name="alquiler_4casas" id="alquiler_4casas">
                            </div>
                           
                            <div class="col">
                                <label for="">Hotel</label>
                                <input type="number" class="form-control" name="alquiler_hotel" id="alquiler_hotel">
                            </div>
                            
                             

                              

                        </div>
                        
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>

                    <button type="button" class="btn btn-primary"   onclick="clickGuardarPropiedad()">
                        Guardar <i class="fas fa-save"></i>
                    </button>
                </div>
            
        </div>
    </div>
</div>
      

@endsection

@section('script')
@include('Layout.ValidatorJS')


<script>

    function clickActualizarNombre(){
        msj = validarFrmEdicion();
        if(msj!=""){
            alerta(msj);
            return;
        }

        document.frmEdicion.submit();
    }

    function validarFrmEdicion(){
        msj = "";
        msj = validarTamañoMaximoYNulidad(msj,'nombreEdicion',50,'Nombre de la edición');
        return msj;
    }

/* 

*/

    
    var listaPropiedades= @php echo json_encode($listaPropiedades); @endphp;

    function limpiarModal(){
        document.getElementById('TituloModalPropiedad').innerHTML = "Crear Propiedad";
        
        document.getElementById('codPropiedad').value = "0"

        document.getElementById('nombre').value = "";
        document.getElementById('lado').value = "";
        document.getElementById('precioCompra').value = "";
        
        document.getElementById('codColor').value = "0";
        document.getElementById('codTipoPropiedad').value = "0";

        document.getElementById('alquiler_normal').value = "";
        document.getElementById('alquiler_1casas').value = "";
        document.getElementById('alquiler_2casas').value = "";
        document.getElementById('alquiler_3casas').value = "";
        document.getElementById('alquiler_4casas').value = "";
        document.getElementById('alquiler_hotel').value = "";
        document.getElementById('valorHipotecable').value = "";
        document.getElementById('costo_casa').value = "";
        document.getElementById('costo_hotel').value = "";
        
    }


    
    function clickGuardarPropiedad(){
        msjError = validarfrmPropiedad();;
        if(msjError!=""){
            alerta(msjError);
            return;
        }

        document.frmPropiedad.submit();

    }

    function validarfrmPropiedad(){
        msj="";

        msj = validarTamañoMaximoYNulidad(msj,'nombre',100,'Nombre de la propiedad');
        msj = validarSelect(msj,'codColor',"0",'Nombre del color');
        msj = validarPositividadYNulidad(msj,'precioCompra','Precio de compra');
        msj = validarNulidad(msj,'precioCompra','Precio de compra');
        msj = validarSelect(msj,'codTipoPropiedad',"0",'Tipo de Propiedad');
        
        msj = validarPositividadYNulidad(msj,'alquiler_normal','alquiler_normal');
        msj = validarPositividadYNulidad(msj,'alquiler_1casas','alquiler_1casas');
        msj = validarPositividadYNulidad(msj,'alquiler_2casas','alquiler_2casas');
        msj = validarPositividadYNulidad(msj,'alquiler_3casas','alquiler_3casas');
        msj = validarPositividadYNulidad(msj,'alquiler_4casas','alquiler_4casas');
        msj = validarPositividadYNulidad(msj,'alquiler_hotel','alquiler_hotel');
        msj = validarPositividadYNulidad(msj,'valorHipotecable','valorHipotecable');
        msj = validarPositividadYNulidad(msj,'costo_casa','costo_casa');
        msj = validarPositividadYNulidad(msj,'costo_hotel','costo_hotel');


        return msj;

    }

    
    function clickEditarPropiedad(codPropiedad){
        obj = listaPropiedades.find(element => element.codPropiedad == codPropiedad);

        document.getElementById('TituloModalPropiedad').innerHTML = "Editar Propiedad";
        
        document.getElementById('codPropiedad').value = obj.codPropiedad;

        document.getElementById('nombre').value = obj.nombre;
        document.getElementById('lado').value = obj.lado;
        document.getElementById('precioCompra').value = obj.precioCompra;
        document.getElementById('codColor').value = obj.codColor;
        document.getElementById('codTipoPropiedad').value = obj.codTipoPropiedad;

        document.getElementById('alquiler_normal').value = obj.alquiler_normal;
        document.getElementById('alquiler_1casas').value = obj.alquiler_1casas;
        document.getElementById('alquiler_2casas').value = obj.alquiler_2casas;
        document.getElementById('alquiler_3casas').value = obj.alquiler_3casas;
        document.getElementById('alquiler_4casas').value = obj.alquiler_4casas;
        document.getElementById('alquiler_hotel').value = obj.alquiler_hotel;
        document.getElementById('valorHipotecable').value = obj.valorHipotecable;
        document.getElementById('costo_casa').value = obj.costo_casa;
        document.getElementById('costo_hotel').value = obj.costo_hotel;
        
        
         
    }

    codPropiedadAEliminar = 0;
    function clickEliminarPropiedad(codPropiedad){
        obj = listaPropiedades.find(element => element.codPropiedad == codPropiedad);
        codPropiedadAEliminar = codPropiedad;
        confirmarConMensaje("Confirmación",'¿Desea eliminar la propiedad "'+obj.codPropiedad+'" ?',"warning",ejecutarEliminacionPropiedad);
    }

    function ejecutarEliminacionPropiedad(){
        location.href = "/Edicion/eliminarPropiedad/" + codPropiedadAEliminar;

    }


</script>

@endsection