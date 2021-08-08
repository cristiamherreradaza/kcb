<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Raza;
use App\ejemplar;

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
        $razasAnterior = DB::table('amascotas')
                            ->orderBy('id', 'desc')
                            ->limit(500)
                            ->get();

        foreach ($variable as $key => $value) {
            # code...
        }
    }
}
