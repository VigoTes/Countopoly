<?php

namespace App\Http\Controllers;

use App\Color;
use App\Http\Controllers\Controller;
use App\LenguajeAmor;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompatibilidadController extends Controller
{
    

    function ver(){
        
        $lenguajes = LenguajeAmor::All();
        $jugo = Persona::findOrFail(2);
        $cuack = Persona::findOrFail(1);
        

        

        return view('Compatibilidad.Probar',compact('lenguajes','jugo','cuack'));
    }







}
