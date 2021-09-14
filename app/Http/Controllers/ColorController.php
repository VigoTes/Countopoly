<?php

namespace App\Http\Controllers;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    public function listarColores(){
        $listaColores = Color::All();

        return view('Color.ListarColores',compact('listaColores'));

    }
    public function EliminarColor($codColor){
        $color = Color::findOrFail($codColor);
        $nombre = $color->nombre;

        if($color->tieneColores()){
            return redirect()->route('Color.Listar')->with("No se puede eliminar el color $nombre porque está siendo usado.");
        }

        $color->delete();
        return redirect()->route('Color.Listar')->with("Se ha eliminado el color $nombre");

    }

    function agregarEditarColor(Request $request){
        try{
            DB::beginTransaction();
            
            if($request->codColor=="0"){//NUEVO REGISTRO
                $color = new Color();
                $mensaje = "agregado";
            }else{ //registro ya existente estamos editando
                $color = Color::findOrFail($request->codColor);
                $mensaje = "editado";
            }

            $color->nombre  = $request->nombre;
            $color->rgb     = $request->rgb;
           
            $color->save();

            $nombre =$color->nombre;

            db::commit();

            return redirect()->route('Color.Listar')
                ->with('datos',"Se ha $mensaje el color $nombre");
        }catch(\Throwable $th){
            DB::rollBack();
            
            return $th;
        }
    }
}
