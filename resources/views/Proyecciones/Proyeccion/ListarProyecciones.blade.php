

@extends('Layout.Plantilla')
@section('titulo')
    Listar Proyeccions
@endsection

@section('contenido')
@include('Layout.MensajeEmergenteDatos')

<div class="row">
    <div class="col">

    </div>
    <div class="col text-right">
        <button onclick="limpiarModal()" class="m-2 btn btn-success" 
        data-toggle="modal" data-target="#ModalProyeccion"
        >
            
            Crear Proyeccion
        </button>
    </div>

</div>
<div class="row m-2">
     <table class="table table-sm">
        <thead>
            <tr>
                <th>idDB</th>
                <th>codigo</th>
                <th>nombre</th>
                <th>fechaHora proyeccion</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($listaProyecciones as $proyeccion )
                    
                <tr>
                    
                    <td>
                        {{$proyeccion->codProyeccion}}
                    </td>
                    <td>
                        {{$proyeccion->codigo}}
                    </td>
                    <td>
                        {{$proyeccion->nombre}}
                    </td>
                    <td>
                        {{$proyeccion->fechaHoraProyeccion}}
                    </td>
                 
                    
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" 
                        data-target="#ModalProyeccion" onclick="clickEditarProyeccion({{$proyeccion->codProyeccion}})"> 
                        <i class="fas fa-pen"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="clickEliminarProyeccion({{$proyeccion->codProyeccion}})">
                            <i class="fas fa-trash"></i>

                        </button>
                        <a class="btn btn-primary" href="{{route('PROY.Proyeccion.Visualizar',$proyeccion->codigo)}}">
                            Visualizar
                        </a>
                        <a class="btn btn-primary" href="{{route('PROY.Proyeccion.Panel',$proyeccion->codigo)}}">
                            Panel de control
                        </a>
                        
                    </td>
                
                </tr>
                
            @endforeach
        </tbody>
     </table>
</div>
 

{{-- Este modal sirve tanto para agregar como para editar --}}
<div class="modal fade" id="ModalProyeccion" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalProyeccion"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('PROY.Proyeccion.agregarEditar')}}" method="POST" id="frmProyeccion" name="frmProyeccion">
                        
                        @csrf
                        {{-- Si se creará uno nuevo, está en 0, si se va a editar tiene el codigo del obj a editar --}}
                        <input type="{{App\Configuracion::getInputTextOHidden()}}" name="codProyeccion" id="codProyeccion" value="0">

                        <div class="row">
                           
                            <div class="col">
                                <label for="">Nombre de la proyeccion</label>
                                <input type="text"  class="form-control" name="nombre" id="nombre">
                            </div>
                            
                            <div class="col">
                                <label for="">Fecha hora de la proyeccion</label>
                                 
                            
                                <div class="input-group date form_date " data-date-format="dd/mm/yyyy" data-provide="datepicker">
                                    {{-- INPUT PARA EL CBTE DE LA FECHA --}}
                                    <input type="text" style="text-align: center" class="form-control" name="fechaHoraProyeccion" id="fechaHoraProyeccion"
                                            value="{{ Carbon\Carbon::now()->format('d/m/Y') }}" style="font-size: 10pt;"> 
                                    
                                    <div class="input-group-btn">                                        
                                        <button class="btn btn-primary date-set btn-sm" type="button">
                                            <i class="fas fa-calendar fa-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>

                    <button type="button" class="btn btn-primary"   onclick="clickGuardarProyeccion()">
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

    
    var listaProyecciones= @php echo json_encode($listaProyecciones); @endphp;

    function limpiarModal(){
        document.getElementById('TituloModalProyeccion').innerHTML = "Crear Proyeccion";
        

        document.getElementById('codProyeccion').value = "0"
      
        document.getElementById('nombre').value = "";
     
        
        
        
    }


    
    function clickGuardarProyeccion(){
        msjError = validarfrmProyeccion();;
        if(msjError!=""){
            alerta(msjError);
            return;
        }

        document.frmProyeccion.submit();

    }

    function validarfrmProyeccion(){
        msj="";

    
        msj = validarTamañoMaximoYNulidad(msj,'nombre',1500,'Nombre de la imagen');
       

        return msj;

    }

    
    function clickEditarProyeccion(codProyeccion){
        obj = listaProyecciones.find(element => element.codProyeccion == codProyeccion);

        document.getElementById('TituloModalProyeccion').innerHTML = "Editar Proyeccion";
        
        document.getElementById('codProyeccion').value = obj.codProyeccion;

  
        document.getElementById('nombre').value = obj.nombre;
      
        
    }

    codProyeccionAEliminar = 0;
    function clickEliminarProyeccion(codProyeccion){
        obj = listaProyecciones.find(element => element.codProyeccion == codProyeccion);
        codProyeccionAEliminar = codProyeccion;
        confirmarConMensaje("Confirmación",'¿Desea eliminar la proyeccion # "'+obj.codProyeccion+'" ?',"warning",ejecutarEliminacionProyeccion);
    }

    function ejecutarEliminacionProyeccion(){
        location.href = "/QRs/eliminarProyeccion/" + codProyeccionAEliminar;

    }


</script>

@endsection