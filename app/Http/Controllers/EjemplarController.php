<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Raza;
use App\Ejemplar;

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


    // TODO - pasar funcion al controlador de migraciones
    public function migracionMascotas()
    {
        $mascotas = DB::table('amascotas')
                            ->orderBy('id', 'desc')
                            ->limit(500)
                            ->get();

        // dd($razasAnterior);

        foreach ($mascotas as $key => $m) {
            $ejemplar = new Ejemplar();
            // $ejemplar->    
        }
    }
}
