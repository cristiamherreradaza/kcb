<?php

namespace App\Http\Controllers;

use App\TiposUsuario;
use Illuminate\Http\Request;

class TiposUsuarioController extends Controller
{
    public function listado()
    {
        $tipos_usuarios = TiposUsuario::all();

        return view('tipos_usuarios.listado')->with(compact('tipos_usuarios'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('tipoUsuario_id') == null){
            // creamos un nuevo registro
            $tipo = new TiposUsuario();
        }else{
            // editamos un registro con su tipo_id
            $tipo = TiposUsuario::find($request->input('tipoUsuario_id'));
        }

        $tipo->nombre      = $request->input('nombre');
        $tipo->descripcion = $request->input('descripcion');
        $tipo->save();

        return redirect('TiposUsuario/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        TiposUsuario::destroy($tipo_id);
        return redirect('TiposUsuario/listado');
    }
}
