<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\TipoCuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CuentaController extends Controller
{
    const PAGINATION = 15;

    public function listar(){
        $listaCuentas = Cuenta::All();
        $listaTipoCuenta = TipoCuenta::All();

        return view('Cuenta.ListarCuentas',compact('listaCuentas','listaTipoCuenta'));
    }
 

    
    public function eliminar($id){
        $cuenta=Cuenta::findOrFail($id);
        $cuenta->delete();
        return redirect()->route('Cuenta.listar')
                ->with('datos','Cuenta '.$cuenta->cuenta.' eliminado exitosamente');
    }


    public function agregarEditarCuenta(Request $request){
        try{

            DB::beginTransaction();
            
            if($request->codCuenta=="0"){//NUEVO REGISTRO
                $cuenta = new Cuenta();
                $mensaje = "agregado";
            }else{ //registro ya existente estamos editando
                $cuenta = Cuenta::findOrFail($request->codCuenta);
                $mensaje = "editado";
            }

            $cuenta->usuario = $request->usuario;
            $cuenta->password= hash::make($request->contraseña);
            $cuenta->codTipoCuenta= $request->codTipoCuenta;
            
            $cuenta->save();

            $nombre =$cuenta->usuario;

            db::commit();

            return redirect()->route('Cuenta.Listar')->with('datos',"Se ha $mensaje la cuenta de  '$nombre'");
        }catch(\Throwable $th){
            DB::rollBack();
            
            return $th;
        }


    } 
   

}
