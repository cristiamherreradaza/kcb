<?php

namespace App\Http\Controllers;

use App\Raza;
use App\Evento;
use App\Ejemplar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function listado()
    {
        $eventos = Evento::all();

        return view('evento.listado')->with(compact('eventos'));
    }

    public function guarda(Request $request)
    {
        // dd($request->all());
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('evento_id') == null){
            // creamos un nuevo registro
            $tipo = new Evento();
        }else{
            // editamos un registro con su tipo_id
            $tipo = Evento::find($request->input('evento_id'));
        }
        if($request->has('circuito')){
            $tipoCircuito = "Si";
        }else{
            $tipoCircuito = "No";
        }
        $tipo->user_id      = Auth::user()->id;
        $tipo->nombre       = $request->input('nombre');
        $tipo->fecha_inicio = $request->input('fecha_ini');
        $tipo->fecha_fin    = $request->input('fecha_fin');
        $tipo->direccion    = $request->input('direccion');
        $tipo->departamento = $request->input('departamento');
        $tipo->numero_pista = $request->input('num_pista');
        $tipo->circuito     = $tipoCircuito;
        
        $tipo->save();

        return redirect('Evento/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        Evento::destroy($tipo_id);
        return redirect('Evento/listado');
    }

    public function formulario(Request $request)
    {
        // dd("hoal");
        // return redirect('Evento/nuevo');
        $razas = Raza::all();

        return view('evento.formularioInscripcion')->with(compact('razas'));
    }

    public function ajaxBuscaEjemplar(Request $request)
    {
        $ejemplar = Ejemplar::where('kcb', $request->kcb)
                        ->limit(10)
                        ->first();
                        // ->get();

                        // dd($ejemplar->padre->nombre);
                        

        return json_encode($ejemplar);
    }
    

}
