<?php

namespace App\Http\Controllers;

use App\Raza;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    public function listado(){

        echo "holas";
        $razas = Raza::get();        

        // foreach ($razas as $key => $r) {
        //     echo "nombre ".$r->nombre;
        // }

        // dd($razas);
        return view('raza.listado')->with(compact('razas'));
    }
}
