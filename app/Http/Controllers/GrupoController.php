<?php

namespace App\Http\Controllers;

use App\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function listado()
    {
        $grupos = Grupo::all();

        return view('grupos.listado')->with(compact('grupos'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('grupo_id') == null){
            // creamos un nuevo registro
            $tipo = new Grupo();
        }else{
            // editamos un registro con su tipo_id
            $tipo = Grupo::find($request->input('grupo_id'));
        }

        $tipo->nombre      = $request->input('nombre');
        $tipo->descripcion = $request->input('descripcion');
        $tipo->save();

        return redirect('Grupo/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        Grupo::destroy($tipo_id);
        return redirect('Grupo/listado');
    }
}