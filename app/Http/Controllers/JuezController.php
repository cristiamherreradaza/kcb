<?php

namespace App\Http\Controllers;

use App\Juez;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuezController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listado(Request $request){

        $jueces = Juez::all();

        return view('juez.listado')->with(compact('jueces'));
    }

    public function guarda(Request $request){
        
        $juez_id = $request->input('juez_id');

        if($juez_id == 0 ){
            $juez = new Juez();
        }else{
            $juez = Juez::find($juez_id);
        }

        $juez->user_id                  = Auth::user()->id;
        $juez->nombre                   = $request->input('nombre');
        $juez->email                    = $request->input('email');
        $juez->fecha_nacimiento         = $request->input('fecha_nacimiento');
        $juez->direccion                = $request->input('direccion');
        $juez->celulares                = $request->input('celulares');
        $juez->departamento             = $request->input('departamento');

        $juez->save();

        return redirect('Juez/listado');
    }

    public function elimina(Request $request, $juez_id){

        Juez::destroy($juez_id);
        
        return redirect('Juez/listado');
    }
}
