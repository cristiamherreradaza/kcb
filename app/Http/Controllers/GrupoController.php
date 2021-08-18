<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\GrupoRaza;
use App\Raza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $tipo->user_id     = Auth::user()->id;
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

    public function listadoGrupoRaza(Request $request, $grupo_id){

        $razas = Raza::all();

        $gruposRazas = GrupoRaza::where('grupo_id',$grupo_id)
                            ->get();

    return view('grupos.listadoGrupoRaza')->with(compact('gruposRazas','razas'));
    }

    public function agregarRaza(Request $request){

        $grupoRaza = new GrupoRaza();

        $grupoRaza->user_id  = Auth::user()->id;
        $grupoRaza->raza_id  = $request->input('raza_id');
        $grupoRaza->grupo_id = $request->input('grupo_id');

        $grupoRaza->save();

        return redirect('Grupo/listadoGrupoRaza/'.$request->input('grupo_id'));
    }
}
