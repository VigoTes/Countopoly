

@extends('Layout.Plantilla')
@section('titulo')
    Listar Links
@endsection

@section('contenido')
@include('Layout.MensajeEmergenteDatos')

<div class="row">
    <div class="col">

    </div>
    <div class="col text-right">
        <button onclick="limpiarModal()" class="m-2 btn btn-success" 
        data-toggle="modal" data-target="#ModalLink"
        >
            
            Crear Link
        </button>
    </div>

</div>
<div class="row m-2">
     <table class="table table-sm">
        <thead>
            <tr>
                <th>codLink</th>
                <th>stringCodigoQR</th>
                <th>fechaDesbloqueo</th>
                <th>nombreImagen</th>
                <th>Descripción</th>
                <th>Tamaño IMG (0-100)</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaLinks as $link )
                    
                <tr>
                    
                    <td>
                        {{$link->codLink}}
                    </td>
                    <td>
                        {{$link->stringCodigoQR}}
                    </td>
                    <td>
                        {{$link->fechaDesbloqueo}}
                    </td>
                    <td>
                        {{$link->nombreImagen}}
                    </td>
                    <td>
                        {{$link->descripcion}}
                    </td>
                    <td>
                        {{$link->tamañoImagen}}
                    </td>
                    
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" 
                        data-target="#ModalLink" onclick="clickEditarLink({{$link->codLink}})"> 
                        <i class="fas fa-pen"></i>
                        
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="clickEliminarLink({{$link->codLink}})">
                            <i class="fas fa-trash"></i>

                        </button>

                        <a class="btn btn-primary" href="{{route('Link.Ver',$link->stringCodigoQR)}}">
                            Ver
                        </a>
                    </td>
                
                </tr>
                
            @endforeach
        </tbody>
     </table>
</div>
 

{{-- Este modal sirve tanto para agregar como para editar --}}
<div class="modal fade" id="ModalLink" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalLink"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Link.agregarEditarLink')}}" method="POST" id="frmLink" name="frmLink">
                        
                        @csrf
                        {{-- Si se creará uno nuevo, está en 0, si se va a editar tiene el codigo del obj a editar --}}
                        <input type="{{App\Configuracion::getInputTextOHidden()}}" name="codLink" id="codLink" value="0">

                        <div class="row">
                            <div class="col">
                                <label for="">String del código QR</label>
                                <input type="text" class="form-control" name="stringCodigoQR" id="stringCodigoQR">
                            </div>
                            <div class="col">
                                <label for="">Alineamiento</label>
                                <input type="text" class="form-control" name="alineamiento" id="alineamiento" placeholder="center">
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

                    <button type="button" class="btn btn-primary"   onclick="clickGuardarLink()">
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

    
    var listaLinks= @php echo json_encode($listaLinks); @endphp;

    function limpiarModal(){
        document.getElementById('TituloModalLink').innerHTML = "Crear Link";
        

        document.getElementById('codLink').value = "0"
        document.getElementById('stringCodigoQR').value = "";
        document.getElementById('fechaDesbloqueo').value = "";
        document.getElementById('nombreImagen').value = "";
        document.getElementById('descripcion').value = "";
        document.getElementById('tamañoImagen').value = "";
        document.getElementById('alineamiento').value = "";
        
        
        
    }


    
    function clickGuardarLink(){
        msjError = validarfrmLink();;
        if(msjError!=""){
            alerta(msjError);
            return;
        }

        document.frmLink.submit();

    }

    function validarfrmLink(){
        msj="";

        msj = validarTamañoMaximoYNulidad(msj,'stringCodigoQR',100,'Valor del código QR');
        msj = validarTamañoMaximoYNulidad(msj,'nombreImagen',1500,'Nombre de la imagen');
        msj = validarTamañoMaximoYNulidad(msj,'descripcion',1800,'Descripción');
        msj = validarTamañoMaximoYNulidad(msj,'alineamiento',20,'alineamiento');
        
        msj = validarNulidad(msj,'fechaDesbloqueo','Fecha de desbloqueo');         
        msj = validarPositividad(msj,'tamañoImagen','Tamaño de la imagen');

        return msj;

    }

    
    function clickEditarLink(codLink){
        obj = listaLinks.find(element => element.codLink == codLink);

        document.getElementById('TituloModalLink').innerHTML = "Editar Link";
        
        document.getElementById('codLink').value = obj.codLink;

        document.getElementById('stringCodigoQR').value = obj.stringCodigoQR;
        document.getElementById('fechaDesbloqueo').value = obj.fechaDesbloqueo;
        document.getElementById('nombreImagen').value = obj.nombreImagen;
        document.getElementById('descripcion').value = obj.descripcion;
        document.getElementById('tamañoImagen').value = obj.tamañoImagen;
        document.getElementById('alineamiento').value = obj.alineamiento;
        
    }

    codLinkAEliminar = 0;
    function clickEliminarLink(codLink){
        obj = listaLinks.find(element => element.codLink == codLink);
        codLinkAEliminar = codLink;
        confirmarConMensaje("Confirmación",'¿Desea eliminar el link # "'+obj.codLink+'" ?',"warning",ejecutarEliminacionLink);
    }

    function ejecutarEliminacionLink(){
        location.href = "/QRs/eliminarLink/" + codLinkAEliminar;

    }


</script>

@endsection