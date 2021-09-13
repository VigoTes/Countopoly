<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Link;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    //

    public function verLink($stringCodigoQR){
        $error = false;
        try {
            $link = Link::where('stringCodigoQR','=',$stringCodigoQR)->get()[0];
            
            if(!$link->sePuedeVer())
                $error = true;
            
            return view('Links.VerLink',compact('link','error'));            
        } catch (\Throwable $th) {
            $error = true;
            $nombreImagen="";
            $mensaje="";
            return view('Links.VerLink',compact('link','error'));
            
        }
        

    }

    public function listarLinks(){

        $listaLinks = Link::All();
        return view('Links.ListarLinks',compact('listaLinks'));
    }

    public function agregarEditarLink(Request $request){
        try{

            DB::beginTransaction();
            
            if($request->codLink=="0"){//NUEVO REGISTRO
                $link = new Link();
                $mensaje = "agregado";
            }else{ //registro ya existente estamos editando
                $link = Link::findOrFail($request->codLink);
                $mensaje = "editado";
            }

            $link->stringCodigoQR = $request->stringCodigoQR;
            $link->fechaDesbloqueo= $request->fechaDesbloqueo;
            $link->descripcion= $request->descripcion;
            $link->nombreImagen= $request->nombreImagen;
            $link->save();

            $nombre =$link->descripcion;

            db::commit();

            return redirect()->route('Link.ListarLinks')->with('datos',"Se ha $mensaje la razón de préstamo $nombre");
        }catch(\Throwable $th){
            DB::rollBack();
            
            return $th;
        }


    }
    
    public function eliminarLink($codLink){
        try {
            DB::beginTransaction();
            $registro =  Link::findOrFail($codLink); 
            $nombre = $registro->descripcion;
              
            $registro->delete();
            DB::commit();

            return redirect()->route('Link.ListarLinks')->with('datos',"Se ha eliminado el link $nombre");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }

    }
    /* FALTARIA HACER EL CRUD PARA HACER EL LINK */


    //sube una imagen al public path que será usada luego
    public function subirImagen(Request $request){

    }


}
