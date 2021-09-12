<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    //

    public function verLink($stringCodigoQR){

        
        $link = Link::where('stringCodigoQR','=',$stringCodigoQR)->get()[0];
        $error = false;
        $nombreImagen = $link->rutaImagen;
        $mensaje = $link->descripcion;
        return view('Links.Link',compact('error','nombreImagen','mensaje'));

    }

    /* FALTARIA HACER EL CRUD PARA HACER EL LINK */

}
