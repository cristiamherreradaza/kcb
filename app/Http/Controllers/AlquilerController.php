<?php

namespace App\Http\Controllers;

use App\Alquiler;
use Illuminate\Http\Request;

class AlquilerController extends Controller
{
    public function listado()
    {
        $alquileres = Alquiler::all()
                                ->orderBy('id', 'desc')
                                ->limit(200);

        return view('alquileres.listado')->with(compact('alquileres'));
    }
}
