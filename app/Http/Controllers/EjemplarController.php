<?php

namespace App\Http\Controllers;

use App\Raza;
use App\User;

use App\Ejemplar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EjemplarController extends Controller
{
    public function formulario(Request $request, $id)
    {
        if ($id != 0) {
            $ejemplar = Ejemplar::find($id);
        } else {
            $ejemplar = null;
        }

        $razas = Raza::all();

        return view('ejemplar.formulario')->with(compact('ejemplar', 'razas'));
    }

    public function ajaxBuscaEjemplar(Request $request)
    {
        // dd($request->all());
        $queryEjemplares = Ejemplar::query();

        if($request->filled('kcb')){
            $kcb = $request->input('kcb');
            $queryEjemplares->where('kcb', 'like', "%$kcb%");
        }

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $queryEjemplares->where('nombre', 'like', "%$nombre%");
        }

        $queryEjemplares->limit(8);

        $ejemplares = $queryEjemplares->get();

        return view('ejemplar.ajaxBuscaEjemplar')->with(compact('ejemplares'));
    }

    public function listado(Request $request)
    {
        $razas = Raza::all();
        $propietarios = User::where('perfil_id', 4)
                            ->get();

        return view('ejemplar.listado')->with(compact('ejemplares', 'razas', 'propietarios'));
    }

    public function ajaxListado(Request $request)
    {
        $queryEjemplares = Ejemplar::orderBy('id', 'desc');
                            
        if ($request->filled('kcb_buscar')) {
            $kcb = $request->input('kcb_buscar');
            $queryEjemplares->where('kcb', $kcb);
        }

        if ($request->filled('nombre_buscar')) {
            $nombre = $request->input('nombre_buscar');
            $queryEjemplares->where('nombre', 'like', "%$nombre%");
        }

        if ($request->filled('chip_buscar')) {
            $chip = $request->input('chip_buscar');
            $queryEjemplares->where('chip', 'like', "%$chip%");
        }

        if ($request->filled('raza_buscar')) {
            $raza_id = $request->input('raza_buscar');
            $queryEjemplares->where('raza_id', $raza_id);
        }

        if ($request->filled('propietario_buscar')) {
            $propietario_id = $request->input('propietario_buscar');
            $queryEjemplares->where('propietario_id', $propietario_id);
        }

        if ($request->filled('kcb_buscar') || $request->filled('nombre_buscar') || $request->filled('chip_buscar') || $request->filled('raza_buscar') || $request->filled('propietario_buscar')) {
            $queryEjemplares->limit(300);
        }else{
            $queryEjemplares->limit(200);
        }


        $ejemplares = $queryEjemplares->get();
        
        return view('ejemplar.ajaxListado')->with(compact('ejemplares'));
    }

}
