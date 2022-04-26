<?php

namespace App\Http\Controllers\Proyecciones;

use App\Fecha;
use App\Http\Controllers\Controller;
use App\Models\Proyecciones\Orden;
use App\Models\Proyecciones\Proyeccion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyeccionController extends Controller
{
    public function Listar(){
        $listaProyecciones = Proyeccion::All();
        return view('Proyecciones.Proyeccion.ListarProyecciones',compact('listaProyecciones'));

    }


    public function EliminarProyeccion($codProyeccion){
        $proyeccion = Proyeccion::findOrFail($codProyeccion);
          

        $proyeccion->delete();
        return redirect()->route('Proyeccion.Listar')->with("Se ha eliminado el ");

    }

    function agregarEditarProyeccion(Request $request){
        try{
            DB::beginTransaction();
            
            if($request->codProyeccion=="0"){//NUEVO REGISTRO
                $proyeccion = new Proyeccion();
                $proyeccion->fechaHoraCreacion = Carbon::now();
                $proyeccion->tokenActualizacion = Proyeccion::generarNuevoToken();
                $proyeccion->codigo = Proyeccion::generarNuevoCodigo();
                
                $mensaje = "agregado";

            }else{ //registro ya existente estamos editando
                $proyeccion = Proyeccion::findOrFail($request->codProyeccion);
                $mensaje = "editado";
            }

            $proyeccion->nombre  = $request->nombre; //el unico campo editable
            $proyeccion->fechaHoraProyeccion  = Fecha::formatoParaSQL($request->fechaHoraProyeccion);
            $proyeccion->save();

            $nombre =$proyeccion->nombre;

            db::commit();

            return redirect()->route('PROY.Proyeccion.Listar')
                ->with('datos',"Se ha $mensaje la proyeccion $nombre");
        }catch(\Throwable $th){
            DB::rollBack();
            
            return $th;
        }
    }


    function Visualizar($codigoProyeccion){
        $proyeccion = Proyeccion::buscarPorCodigo($codigoProyeccion);
       
        return view('Proyecciones.Proyeccion.Visualizar',compact('proyeccion'));
    }

    function Panel($codigoProyeccion){
        $proyeccion = Proyeccion::buscarPorCodigo($codigoProyeccion);


        return view('Proyecciones.Proyeccion.PanelDeControl',compact('proyeccion'));
    }

    
    function AgregarOrden(Request $request){
        for ($i=0; $i < 5 ; $i++) { 
            
         
            $orden = new Orden();
            $orden->valores = $request->valores;
            $orden->codProyeccion = $request->codProyeccion;
            $orden->fechaHoraCreacion = Carbon::now();
            $orden->codTipoOrden = $request->codTipoOrden;
            $orden->pendiente = 1;
            $orden->save();

            $proy = Proyeccion::findOrFail($request->codProyeccion);
            $proy->tokenActualizacion = Proyeccion::generarNuevoToken();
            $proy->save();
               
        }
        return "Orden creada";

    }
    

    function retornarOrdenesPendientes($codProyeccion,$tokenCliente){
        
        $proy = Proyeccion::findOrFail($codProyeccion);

        $objetoRespuesta = [
            'sincronizado' => '',
            'listaOrdenes' => '',
            'nuevoToken' => '',
        ];
        if($tokenCliente == $proy->tokenActualizacion){ //está actualizado, tranki
            $objetoRespuesta['sincronizado'] = '1';
        }else{
            $objetoRespuesta['sincronizado']='0';
            $objetoRespuesta['listaOrdenes'] = Orden::where('codProyeccion',$codProyeccion)->where('pendiente','1')->orderBy('codOrden','DESC')->get();
            Orden::where('codProyeccion',$codProyeccion)->where('pendiente','1')->update(['pendiente'=>'0']);
            $objetoRespuesta['nuevoToken'] = $proy->tokenActualizacion;

        }

        return $objetoRespuesta;

    }





}
