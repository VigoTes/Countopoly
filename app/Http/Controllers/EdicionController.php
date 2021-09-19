<?php

namespace App\Http\Controllers;

use App\Color;
use App\Edicion;
use App\Http\Controllers\Controller;
use App\Propiedad;
use App\TipoPropiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EdicionController extends Controller
{
    
    public function listarEdiciones(){
        $listaEdiciones = Edicion::All();

        return view('Ediciones.ListarEdicion',compact('listaEdiciones'));
    }

    public function Editar($codEdicion){    
        $edicion = Edicion::findOrFail($codEdicion);
        $listaColores = Color::All();
        $listaPropiedades = Propiedad::where('codEdicion','=',$codEdicion)
            ->orderBy('lado','DESC')
            ->orderBy('codPropiedad','DESC')
            ->get();

        $listaTipoPropiedades = TipoPropiedad::All();

        return view('Ediciones.EditarEdicion',compact('listaPropiedades','edicion','listaColores','listaTipoPropiedades'));
    }

    public function agregarEdicion(){

    }

    public function EliminarEdicion($codEdicion){
        $edicion = Edicion::findOrFail($codEdicion);
        $nombre = $edicion->nombre;

        if($edicion->tienePartidas()){
            return redirect()->route('Edicion.Listar')->with("No se puede eliminar la edición $nombre porque está siendo usada.");

        }

        $edicion->delete();
        return redirect()->route('Edicion.Listar')->with("Se ha eliminado la edición $nombre");

    }

    function agregarEditarPropiedad(Request $request){
        try{
            DB::beginTransaction();
            
            if($request->codPropiedad=="0"){//NUEVO REGISTRO
                $propiedad = new Propiedad();
                $mensaje = "agregado";
            }else{ //registro ya existente estamos editando
                $propiedad = Propiedad::findOrFail($request->codPropiedad);
                $mensaje = "editado";
            }

            $propiedad->nombre = $request->nombre;
            $propiedad->lado= $request->lado;
            $propiedad->codColor= $request->codColor;
            $propiedad->precioCompra= $request->precioCompra;
            $propiedad->codEdicion= $request->codEdicion;
            $propiedad->codTipoPropiedad = $request->codTipoPropiedad;
            
            $propiedad->save();

            $nombre =$propiedad->nombre;

            db::commit();

            return redirect()->route('Edicion.Editar',$propiedad->codEdicion)
                ->with('datos',"Se ha $mensaje la propiedad $nombre");
        }catch(\Throwable $th){
            DB::rollBack();
            
            return $th;
        }
    }

    public function eliminarPropiedad($codPropiedad){
        $propiedad = Propiedad::findOrFail($codPropiedad);
        $edicion = $propiedad->getEdicion();

        if($edicion->tienePartidas()){
            return redirect()->route('Edicion.Editar',$propiedad->codEdicion)
                ->with('datos','No se puede eliminar porque ya se usó la edicion');
        }

        $propiedad->delete();

        return redirect()->route('Edicion.Listar')->with('datos',"Se ha eliminado exitosamente la edición " . $edicion->nombre);

    }

    public function ActualizarNombre(Request $request){

        $edicion = Edicion::findOrFail($request->codEdicion);
        $edicion->nombre = $request->nombreEdicion;
        $nombre = $edicion->nombre;
        $edicion->save();

        return redirect()->route('Edicion.Editar',$edicion->codEdicion)->with('datos',"Se ha actualizado el nombre a $nombre ");
    }
}
