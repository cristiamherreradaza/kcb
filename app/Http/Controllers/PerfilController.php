<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listado()
    {
        $perfiles = Perfil::all();

        return view('perfiles.listado')->with(compact('perfiles'));
    }

    public function guarda(Request $request)
    {
        // dd(Auth::user());
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('perfil_id') == null){
            // creamos un nuevo registro
            $tipo = new Perfil();
        }else{
            // editamos un registro con su tipo_id
            $tipo = Perfil::find($request->input('perfil_id'));
        }

        $tipo->user_id     = Auth::user()->id;
        $tipo->nombre      = $request->input('nombre');
        $tipo->descripcion = $request->input('descripcion');
        $tipo->save();

        return redirect('Perfil/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        Perfil::destroy($tipo_id);
        return redirect('Perfil/listado');
    }
}
