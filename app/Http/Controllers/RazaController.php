<?php

namespace App\Http\Controllers;

use App\Raza;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    public function listado()
    {
        $razas = Raza::all();

        return view('raza.listado')->with(compact('razas'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('raza_id') == null){
            // creamos un nuevo registro
            $tipo = new Raza();
        }else{
            // editamos un registro con su tipo_id
            $tipo = Raza::find($request->input('raza_id'));
        }

        $tipo->nombre      = $request->input('nombre');
        $tipo->descripcion = $request->input('descripcion');
        $tipo->save();

        return redirect('Raza/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        Raza::destroy($tipo_id);
        return redirect('Raza/listado');
    }
}
