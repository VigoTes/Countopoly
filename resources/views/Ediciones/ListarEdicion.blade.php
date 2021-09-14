

@extends('Layout.Plantilla')
@section('titulo')
    Editar Edición
@endsection

@section('contenido')
@include('Layout.MensajeEmergenteDatos')

<div class="row">
    <div class="col">

    </div>
    <div class="col text-right">
        <button onclick="limpiarModal()" class="m-2 btn btn-success" 
        data-toggle="modal" data-target="#ModalPropiedad"
        >
            Agregar Edición
        </button>
    </div>

</div>
<div class="row m-2">
     <table class="table table-sm">
        <thead>
            <tr>
                <th>codEdicion</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaEdiciones as $edicion )
                    
                <tr>
                    
                    <td>
                        {{$edicion->codEdicion}}
                    </td>
                    <td>
                        {{$edicion->nombre}}
                    </td>
                    
                    <td>
                        <a href="{{route('Edicion.Editar',$edicion->codEdicion)}}" class="btn btn-info btn-sm"> 
                            <i class="fas fa-pen"></i>
                            
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="clickEliminarEdicion({{$edicion->codEdicion}})">
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
                    <form action="{{route('Edicion.agregarEditarPropiedad')}}" method="POST" id="frmEdicion" name="frmEdicion">
                        
                        @csrf
                        {{-- Si se creará uno nuevo, está en 0, si se va a editar tiene el codigo del obj a editar --}}
                        <input type="{{App\Configuracion::getInputTextOHidden()}}" name="codEdicion" id="codEdicion" value="0">

                        <div class="row">
                            <div class="col">
                                <label for="">String del código QR</label>
                                <input type="text" class="form-control" name="stringCodigoQR" id="stringCodigoQR">
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="">Fecha desbloqueo</label>
                                <input type="text" placeholder="AAAA-MM-DD" class="form-control" name="fechaDesbloqueo" id="fechaDesbloqueo">
                            </div>

                            <div class="col">
                                <label for="">Nombre de la imagen</label>
                                <input type="text"  class="form-control" name="nombreImagen" id="nombreImagen">
                            </div>
                            <div class="col">
                                <label for="">Tamaño de la Imagen (0-100)</label>
                                <input type="text"  class="form-control" name="tamañoImagen" id="tamañoImagen">
                            </div>
                            
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="6"
                                ></textarea>
                            </div>
                            
                            
                            
                        </div>
                        
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>

                    <button type="button" class="btn btn-primary"   onclick="clickGuardarEdicion()">
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

    
    var listaEdiciones= @php echo json_encode($listaEdiciones); @endphp;

    function limpiarModal(){
        document.getElementById('TituloModalPropiedad').innerHTML = "Crear Edicion";
        

        document.getElementById('codEdicion').value = "0"
        document.getElementById('stringCodigoQR').value = "";
        document.getElementById('fechaDesbloqueo').value = "";
        document.getElementById('nombreImagen').value = "";
        document.getElementById('descripcion').value = "";
        document.getElementById('tamañoImagen').value = "";

        
    }


    
    function clickGuardarEdicion(){
        msjError = validarfrmEdicion();;
        if(msjError!=""){
            alerta(msjError);
            return;
        }

        document.frmEdicion.submit();

    }

    function validarfrmEdicion(){
        msj="";

        msj = validarTamañoMaximoYNulidad(msj,'stringCodigoQR',100,'Valor del código QR');
        msj = validarTamañoMaximoYNulidad(msj,'nombreImagen',1500,'Nombre de la imagen');
        msj = validarTamañoMaximoYNulidad(msj,'descripcion',400,'Descripción');
        msj = validarNulidad(msj,'fechaDesbloqueo','Fecha de desbloqueo');         
        msj = validarPositividad(msj,'tamañoImagen','Tamaño de la imagen');

        return msj;

    }

    
    function clickEditarEdicion(codEdicion){
        obj = listaEdiciones.find(element => element.codEdicion == codEdicion);

        document.getElementById('TituloModalPropiedad').innerHTML = "Editar Edicion";
        
        document.getElementById('codEdicion').value = obj.codEdicion;

        document.getElementById('stringCodigoQR').value = obj.stringCodigoQR;
        document.getElementById('fechaDesbloqueo').value = obj.fechaDesbloqueo;
        document.getElementById('nombreImagen').value = obj.nombreImagen;
        document.getElementById('descripcion').value = obj.descripcion;
        document.getElementById('tamañoImagen').value = obj.tamañoImagen;
        
         
    }

    codEdicionAEliminar = 0;
    function clickEliminarEdicion(codEdicion){
        obj = listaEdiciones.find(element => element.codEdicion == codEdicion);
        codEdicionAEliminar = codEdicion;
        confirmarConMensaje("Confirmación",'¿Desea eliminar la eidicón "'+obj.nombre+'" ?',"warning",ejecutarEliminacionEdicion);
    }

    function ejecutarEliminacionEdicion(){
        location.href = " " + codEdicionAEliminar;

    }


</script>

@endsection