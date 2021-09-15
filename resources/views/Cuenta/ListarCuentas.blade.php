
@extends ('Layout.Plantilla')
@section('titulo')
  Listar cuentas
@endsection


@section('contenido')
 
<div style="text-align: center">
    <h2> Listar cuentas </h2>
    <br>
    
    <div class="row">
        <div class="col-md-2">
            <button type="button" data-toggle="modal" data-target="#ModalCuenta" class="btn btn-primary" onclick="limpiarModal()"> 
                <i class="fas fa-plus"> </i> 
                Registrar cuenta
            </button>
        </div>
        <div class="col-md-10">
            
        </div>
    </div>
    
    @include('Layout.MensajeEmergenteDatos')
      
    <table class="table table-sm" style="font-size: 10pt; margin-top:10px;">
        <thead class="thead-dark">
            <tr>
                <th>COD</th>
                <th>Nombre usuario</th>
                <th>Tipo de cuenta</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        
        @foreach($listaCuentas as $itemCuenta)
            <tr>
                <td>
                    {{$itemCuenta->codCuenta}}
                </td>
                <td>{{$itemCuenta->usuario}}</td>
                
                <td>
                    {{$itemCuenta->getTipoCuenta()->nombre}}
                </td>

                <td>
                    <button type="button" data-toggle="modal" data-target="#ModalCuenta" onclick="clickEditar({{$itemCuenta->codCuenta}})"
                        class="btn btn-warning btn-xs btn-icon icon-left">
                        <i class="fas fa-edit"></i>
                        Editar
                    </button>
                    <button type="button" class="btn btn-danger btn-xs btn-icon icon-left" 
                            onclick="clickEliminarCuenta({{$itemCuenta->codCuenta}})">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
 
</div>


{{-- Este modal sirve tanto para agregar como para editar --}}
<div class="modal fade" id="ModalCuenta" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCuenta"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Cuenta.AgregarEditarCuenta')}}" method="POST" id="frmCuenta" name="frmCuenta">
                        
                        @csrf
                        {{-- Si se creará uno nuevo, está en 0, si se va a editar tiene el codigo del obj a editar --}}
                        <input type="{{App\Configuracion::getInputTextOHidden()}}" name="codCuenta" id="codCuenta" value="0">

                        <div class="row">
                            <div class="col">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="usuario" id="usuario">
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="">Contraseña</label>
                                <input type="password" class="form-control" name="contraseña" id="contraseña">
                            </div>
                            <div class="col">
                                <label for="">Contraseña</label>
                                <input type="password" class="form-control" name="contraseñaRepetida" id="contraseñaRepetida">
                            </div>
                            
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="">Descripción</label>
                                <select class="form-control" name="codTipoCuenta" id="codTipoCuenta">
                                    <option value="0"></option>
                                    @foreach($listaTipoCuenta as $tipoCuenta)
                                        <option value="{{$tipoCuenta->codTipoCuenta}}">
                                            {{$tipoCuenta->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            
                        </div>
                        
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>

                    <button type="button" class="btn btn-primary"   onclick="clickGuardarCuenta()">
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

    var listaCuentas = 
    @php
        echo json_encode($listaCuentas);
    @endphp

    function clickGuardarCuenta(){
        msj = validarFormulario();
        if(msj!=''){
            alerta(msj);
            return;
        }
        
        confirmarConMensaje('Confirmacion','¿Desea crear la cuenta?','warning',ejecutarSubmit);
    }
    function ejecutarSubmit(){
        document.frmCuenta.submit();
    }

    function validarFormulario(){
        limpiarEstilos(
            ['usuario','contraseña','contraseñaRepetida']);
        msj = "";

        msj = validarTamañoMaximoYNulidad(msj,'usuario',100,'Nombre de usuario');
        msj = validarTamañoMaximoYNulidad(msj,'contraseña',200,'Contraseña');
        msj = validarTamañoMaximoYNulidad(msj,'contraseñaRepetida',200,'Contraseña Repetida');
        msj = validarContenidosIguales(msj,'contraseña','contraseñaRepetida','Las contraseñas deben coincidir');

        return msj;

    }


    codCuentaAEliminar = 0;
    function clickEliminarCuenta(codCuenta){
        codCuentaAEliminar = codCuenta;
        confirmarConMensaje("Confirmación","¿Desea eliminar el cuenta?","warning",ejecutarEliminarCuenta);
    }
    function ejecutarEliminarCuenta(){
        window.location.href='/Cuenta/'+codCuentaAEliminar+'/eliminar';
    }
    

    function limpiarModal(){

        document.getElementById('TituloModalCuenta').innerHTML = "Nueva Cuenta";

        document.getElementById('codCuenta').value = "0";
        document.getElementById('usuario').value = "";
        document.getElementById('contraseña').value = "";
        document.getElementById('contraseñaRepetida').value = "";
        document.getElementById('codTipoCuenta').value = "";

    }
    function clickEditar(codCuenta){
        cuenta = listaCuentas.find(element => element.codCuenta == codCuenta);

        document.getElementById('TituloModalCuenta').innerHTML = "Editar Cuenta";

        document.getElementById('codCuenta').value = cuenta.codCuenta;
        document.getElementById('usuario').value = cuenta.usuario;
        document.getElementById('contraseña').value = "";
        document.getElementById('contraseñaRepetida').value = "";
        document.getElementById('codTipoCuenta').value = cuenta.codTipoCuenta;

    }

</script>

@endsection