<?php

namespace App\Http\Controllers;

use App\Examen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listado()
    {
        $examenes = Examen::all();

        return view('examenes.listado')->with(compact('examenes'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('examen_id') == null){
            // creamos un nuevo registro
            $tipo = new Examen();
        }else{
            // editamos un registro con su tipo_id
            $tipo = Examen::find($request->input('examen_id'));
        }

        $tipo->user_id     = Auth::user()->id;
        $tipo->nombre      = $request->input('nombre');
        $tipo->descripcion = $request->input('descripcion');
        $tipo->save();

        return redirect('Examen/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        Examen::destroy($tipo_id);
        return redirect('Examen/listado');
    }
}
