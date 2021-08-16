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

    public function ajaxBuscaKcb(Request $request)
    {
        dd($request->all());
    }

    public function listado(Request $request)
    {
        // $ejemplares = Ejemplar::orderBy('id', 'desc')
        //                     ->limit(200)
        //                     ->get();

        $razas = Raza::all();
        $propietarios = User::where('perfil_id', 4)
                            ->get();

        return view('ejemplar.listado')->with(compact('ejemplares', 'razas', 'propietarios'));
    }

    public function ajaxListado(Request $request)
    {
        $ejemplares = Ejemplar::orderBy('id', 'desc')
                            ->limit(200)
                            ->get();
        
        return view('ejemplar.ajaxListado')->with(compact('ejemplares'));
    }

}
