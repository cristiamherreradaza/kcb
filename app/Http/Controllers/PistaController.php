<?php

namespace App\Http\Controllers;

use App\Pista;
use Illuminate\Http\Request;

class PistaController extends Controller
{
    public function listado()
    {
        $pistas = Pista::all();

        return view('pistas.listado')->with(compact('pistas'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('pista_id') == null){
            // creamos un nuevo registro
            $tipo = new Pista();
        }else{
            // editamos un registro con su tipo_id
            $tipo = Pista::find($request->input('pista_id'));
        }

        $tipo->nombre        = $request->input('nombre');
        $tipo->descripcion   = $request->input('descripcion');
        $tipo->save();

        return redirect('Pista/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        Pista::destroy($tipo_id);
        return redirect('Pista/listado');
    }
}
