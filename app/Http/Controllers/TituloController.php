<?php

namespace App\Http\Controllers;

use App\Titulo;
use Illuminate\Http\Request;

class TituloController extends Controller
{
    public function listado()
    {
        $titulos = Titulo::all();

        return view('titulos.listado')->with(compact('titulos'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('titulo_id') == null){
            // creamos un nuevo registro
            $tipo = new Titulo();
        }else{
            // editamos un registro con su tipo_id
            $tipo = Titulo::find($request->input('titulo_id'));
        }

        $tipo->nombre      = $request->input('nombre');
        $tipo->descripcion = $request->input('descripcion');
        $tipo->save();

        return redirect('Titulo/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        Titulo::destroy($tipo_id);
        return redirect('Titulo/listado');
    }
}
