<?php

namespace App\Http\Controllers;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasarelaController extends Controller
{
  public function probarPasarela(){
     

    return view('Pasarela.ProbarPasarela');
  }


}
