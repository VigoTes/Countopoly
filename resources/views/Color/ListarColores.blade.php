

@extends('Layout.Plantilla')
@section('titulo')
    Colores
@endsection

@section('contenido')
@include('Layout.MensajeEmergenteDatos')

<div class="row">
    
    

    <div class="col text-right">
        <button onclick="limpiarModal()" class="m-2 btn btn-success" 
        data-toggle="modal" data-target="#ModalColor">
            Agregar Color
        </button>
    </div>

</div>
<div class="row m-2">
     <table class="table table-sm">
        <thead>
            <tr>
                <th>codColor</th>
                <th>nombre</th>
                <th>rgb</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaColores as $color )
                    
                <tr style="background-color: {{$color->color_rgb}}">
                    
                    <td>
                        {{$color->codColor}}
                    </td>
                    <td>
                        {{$color->nombre}}
                    </td>
                    <td>
                        {{$color->rgb}}
                        <div class="" style="background-color: {{$color->rgb}}; width:15px; height:15px; border-radius: 7px;">
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" 
                        data-target="#ModalColor" onclick="clickEditarColor({{$color->codColor}})"> 
                        <i class="fas fa-pen"></i>
                        
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="clickEliminarColor({{$color->codColor}})">
                            <i class="fas fa-trash"></i>

                        </button>
 
                    </td>
                
                </tr>
                
            @endforeach
        </tbody>
     </table>
</div>
 

{{-- Este modal sirve tanto para agregar como para editar --}}
<div class="modal fade" id="ModalColor" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalColor"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Color.agregarEditarColor')}}" method="POST" id="frmColor" name="frmColor">
                        
                        @csrf
                        {{-- Si se creará uno nuevo, está en 0, si se va a editar tiene el codigo del obj a editar --}}
                        <input type="{{App\Configuracion::getInputTextOHidden()}}" name="codColor" id="codColor" value="0">
                         
                        <div class="row">
                            <div class="col">
                                <label for="">nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="">Seleccionar Color</label>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <input type="color" id="colorEscogido" name="colorEscogido" onchange="changeColor()">

                                    </div>
                                    <div class="col">
                                        <input type="texto" class="form-control" value="rgb(0,0,0)" name="rgb" id="rgb" readonly>
                            
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

                    <button type="button" class="btn btn-primary"   onclick="clickGuardarColor()">
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

    
    function changeColor(){
        colorHex = document.getElementById('colorEscogido').value;
        
        var hex_code = colorHex.split("");
        
        var red = parseInt(hex_code[1]+hex_code[2],16);
        var green = parseInt(hex_code[3]+hex_code[4],16);
        var blue = parseInt(hex_code[5]+hex_code[6],16);
        
        var rgb =  "rgb("+ red+","+green+","+blue + ")";

        document.getElementById('rgb').value = rgb;
        console.log(rgb);
    }

    
    var listaColores= @php echo json_encode($listaColores); @endphp;

    function limpiarModal(){
        document.getElementById('TituloModalColor').innerHTML = "Crear Color";
        
        document.getElementById('codColor').value = "0"

        document.getElementById('nombre').value = "";
        document.getElementById('rgb').value = "";

        
    }


    
    function clickGuardarColor(){
        msjError = validarfrmColor();;
        if(msjError!=""){
            alerta(msjError);
            return;
        }

        document.frmColor.submit();

    }

    function validarfrmColor(){
        msj="";
 
        msj = validarTamañoMaximoYNulidad(msj,'nombre',100,'Nombre del color');
        msj = validarTamañoMaximoYNulidad(msj,'rgb',20,'RGB del color');
         
        return msj;

    }

    
    function clickEditarColor(codColor){
        obj = listaColores.find(element => element.codColor == codColor);

        document.getElementById('TituloModalColor').innerHTML = "Editar Color";
        
        document.getElementById('codColor').value = obj.codColor;

        document.getElementById('nombre').value = obj.nombre;
        document.getElementById('rgb').value = obj.rgb;
         

        stringRGB = obj.rgb;
        stringRGB = stringRGB.replace('rgb(','');
        stringRGB = stringRGB.replace(')','');
        stringRGB = stringRGB.replace(" ","");
        stringRGB = stringRGB.replace(" ","");
        stringRGB = stringRGB.replace(" ","");
         
        vectorRGB = stringRGB.split(',');
        
        R = parseInt(vectorRGB[0]);
        G = parseInt(vectorRGB[1]);
        B = parseInt(vectorRGB[2]);
        
        hex = rgbToHex(R,G,B);

        console.log(hex);
        document.getElementById('colorEscogido').value = hex;
        
        
         
    }
    const rgbToHex = (r, g, b) => '#' + [r, g, b].map(x => {
        const hex = x.toString(16)
        return hex.length === 1 ? '0' + hex : hex
    }).join('');

    codColorAEliminar = 0;
    function clickEliminarColor(codColor){
        obj = listaColores.find(element => element.codColor == codColor);
        codColorAEliminar = codColor;
        confirmarConMensaje("Confirmación",'¿Desea eliminar el color "'+obj.nombre+'" ?',"warning",ejecutarEliminacionColor);
    }

    function ejecutarEliminacionColor(){
        location.href = "/Color/eliminar/" + codColorAEliminar;

    }


</script>

@endsection