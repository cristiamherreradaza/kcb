<?php

namespace App\Http\Controllers;

use App\CategoriasPista;
use Illuminate\Http\Request;

class CategoriasPistaController extends Controller
{
    public function listado()
    {
        $categoriaPista = CategoriasPista::all();

        return view('categoria_pistas.listado')->with(compact('categoriaPista'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('tipo_id') == null){
            // creamos un nuevo registro
            $tipo = new CategoriasPista();
        }else{
            // editamos un registro con su tipo_id
            $tipo = CategoriasPista::find($request->input('tipo_id'));
        }

        $tipo->nombre      = $request->input('nombre');
        $tipo->descripcion = $request->input('descripcion');
        $tipo->save();

        return redirect('CategoriasPista/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        CategoriasPista::destroy($tipo_id);
        return redirect('CategoriasPista/listado');
    }
}
