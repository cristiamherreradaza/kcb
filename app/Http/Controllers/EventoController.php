<?php

namespace App\Http\Controllers;

use App\Raza;
use App\Evento;
use App\Ejemplar;
use App\CategoriasPista;
use App\EjemplarEvento;
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

    public function formulario(Request $request, $evento_id)
    {
        // dd("hoal");
        // return redirect('Evento/nuevo');
        $evento = Evento::find($evento_id);

        $razas = Raza::all();

        $categorias_pistas = CategoriasPista::all();

        return view('evento.formularioInscripcion')->with(compact('razas', 'categorias_pistas', 'evento'));
    }

    public function ajaxBuscaEjemplar(Request $request)
    {
        $arrayEjemplar = array();

        $ejemplar = Ejemplar::where('kcb', $request->kcb)
                        ->limit(10)
                        ->first();
                        // ->get();
        if($ejemplar){
            $arrayEjemplar['id'] = $ejemplar->id;
            $arrayEjemplar['nombre_completo'] = $ejemplar->nombre_completo;
            $arrayEjemplar['color'] = $ejemplar->color;
            $arrayEjemplar['fecha_nacimiento'] = $ejemplar->fecha_nacimiento;
            $arrayEjemplar['sexo'] = $ejemplar->sexo;
            $arrayEjemplar['codigo_nacionalizado'] = $ejemplar->codigo_nacionalizado;
            $arrayEjemplar['num_tatuaje'] = $ejemplar->num_tatuaje;
            $arrayEjemplar['chip'] = $ejemplar->chip;
            // dd($ejemplar->madre);
            if($ejemplar->padre){
                $arrayEjemplar['kcb_padre'] = $ejemplar->padre->kcb;
                $arrayEjemplar['nombre_padre'] = $ejemplar->padre->nombre_completo;
            }else{
                $arrayEjemplar['kcb_padre'] = null;
                $arrayEjemplar['nombre_padre'] = null;
            }
            if($ejemplar->madre){
                $arrayEjemplar['kcb_madre'] = $ejemplar->madre->kcb;
                $arrayEjemplar['nombre_madre'] = $ejemplar->madre->nombre_completo;
            }else{
                $arrayEjemplar['kcb_madre'] = null;
                $arrayEjemplar['nombre_madre'] = null;
            }
            $arrayEjemplar['nom_propietario'] = $ejemplar->propietario->name;    
            $arrayEjemplar['departamento'] = $ejemplar->propietario->departamento;    
            $arrayEjemplar['celulares'] = $ejemplar->propietario->celulares;    
            $arrayEjemplar['email'] = $ejemplar->propietario->email;    

            $arrayEjemplar['raza_id'] = $ejemplar->raza->id;                   
        }
        // dd($ejemplar->padre->nombre);


        return json_encode($arrayEjemplar);
    }

    public function ajaxBuscaExtranjero(Request $request){
        // dd($request->all());
        $arrayEjemplar = array();

        $ejemplarEvento = EjemplarEvento::where('codigo_nacionalizado', $request->cod_ex)
                        ->limit(10)
                        ->first();
                        // ->get();
                        // dd($ejemplarEvento);
                        // dd(json_encode($arrayEjemplar));
        if($ejemplarEvento){

            $arrayEjemplar['id']                        = $ejemplarEvento->id;
            $arrayEjemplar['raza_id']                   = $ejemplarEvento->raza->id;
            $arrayEjemplar['codigo_nacionalizado']      = $ejemplarEvento->codigo_nacionalizado;
            $arrayEjemplar['nombre_completo']           = $ejemplarEvento->nombre_completo;
            $arrayEjemplar['color']                     = $ejemplarEvento->color;
            $arrayEjemplar['fecha_nacimiento']          = $ejemplarEvento->fecha_nacimiento;
            $arrayEjemplar['sexo']                      = $ejemplarEvento->sexo;
            $arrayEjemplar['chip']                      = $ejemplarEvento->chip;
            $arrayEjemplar['kcb_padre']                 = $ejemplarEvento->kcb_padre;
            $arrayEjemplar['nombre_padre']              = $ejemplarEvento->nombre_padre;
            $arrayEjemplar['kcb_madre']                 = $ejemplarEvento->kcb_madre;
            $arrayEjemplar['nombre_madre']              = $ejemplarEvento->nombre_madre;
            $arrayEjemplar['criador']                   = $ejemplarEvento->criador;
            $arrayEjemplar['propietario']               = $ejemplarEvento->propietario;
            $arrayEjemplar['ciudad']                    = $ejemplarEvento->ciudad;
            $arrayEjemplar['telefono']                  = $ejemplarEvento->telefono;
            $arrayEjemplar['email']                     = $ejemplarEvento->email;
            $arrayEjemplar['num_tatuaje']               = $ejemplarEvento->tatuaje;
        }
        // dd($ejemplar->padre->nombre);


        return json_encode($arrayEjemplar);
    }
    
    public function inscribirEvento(Request $request){
        // dd($request->all());
        $ejemplarEvento = new EjemplarEvento();

        if($request->kcb_busca && $request->ejemplar_id){

            $ejemplarEvento->user_id                    = Auth::user()->id;
            $ejemplarEvento->evento_id                  = $request->input('evento_id');
            $ejemplarEvento->ejemplar_id                = $request->input('ejemplar_id');      
            $ejemplarEvento->categoria_pista_id         = $request->input('categoria_pista');
            $ejemplarEvento->extrangero                 = 'no';
            $ejemplarEvento->criador                    = $request->input('criador');
            $ejemplarEvento->telefono                   = $request->input('telefono');
            $ejemplarEvento->email                      = $request->input('email');

        }elseif($request->cod_extrangero && $request->ejemplar_id == null){

            $ejemplarEvento->user_id                    = Auth::user()->id;
            $ejemplarEvento->evento_id                  = $request->input('evento_id');
            $ejemplarEvento->raza_id                    = $request->input('raza_id');
            $ejemplarEvento->categoria_pista_id         = $request->input('categoria_pista');
            $ejemplarEvento->extrangero                 = 'si';
            $ejemplarEvento->codigo_nacionalizado       = $request->input('cod_extrangero');
            $ejemplarEvento->nombre_completo            = $request->input('nombre');
            $ejemplarEvento->color                      = $request->input('color');
            $ejemplarEvento->fecha_nacimiento           = $request->input('fecha_nacimiento');
            $ejemplarEvento->chip                       = $request->input('chip');
            $ejemplarEvento->kcb_padre                  = $request->input('kcb_padre');
            $ejemplarEvento->nombre_padre               = $request->input('nom_padre');
            $ejemplarEvento->kcb_madre                  = $request->input('kcb_madre');
            $ejemplarEvento->nombre_madre               = $request->input('nom_madre');
            $ejemplarEvento->criador                    = $request->input('criador');
            $ejemplarEvento->propietario                = $request->input('propietario');
            $ejemplarEvento->ciudad                     = $request->input('ciudad');
            $ejemplarEvento->sexo                       = $request->input('sexo');
            $ejemplarEvento->telefono                   = $request->input('telefono');
            $ejemplarEvento->email                      = $request->input('email');
        }

        $ejemplarEvento->edad                           = $request->input('ejemplar_meses');

        $ejemplarEvento->save();

        echo  'se registro';
    }

    public function listadoInscritos(Request $request, $evento_id){
        // dd($evento_id);

        $ejemplaresEventos = EjemplarEvento::where('evento_id',$evento_id)
                                            ->get();

        $evento = Evento::find($evento_id);

        $razas = Raza::all();

        $categoriasPista = CategoriasPista::all();

        return view('evento.listadoInscritos')->with(compact('ejemplaresEventos', 'evento', 'razas', 'categoriasPista'));
                                            
    }

    public function editaInscripcionEjemplarEvento(Request $request){
        
        $ejemplarEvento = EjemplarEvento::find($request->input('ejemplarEvento'));

        if($request->input('extranjero') == 'si'){
            $ejemplarEvento->nombre_completo        = $request->input('nombre');
            $ejemplarEvento->raza_id                = $request->input('raza_id');
            $ejemplarEvento->color                  = $request->input('color');
            $ejemplarEvento->fecha_nacimiento       = $request->input('fecha_nacimiento');
            $ejemplarEvento->sexo                   = $request->input('sexo');
            $ejemplarEvento->codigo_nacionalizado   = $request->input('cod_extranjero');
            $ejemplarEvento->tatuaje                = $request->input('num_tatuaje');
            $ejemplarEvento->chip                   = $request->input('chip');
            $ejemplarEvento->kcb_padre              = $request->input('kcb_padre');
            $ejemplarEvento->nombre_padre           = $request->input('nom_padre');
            $ejemplarEvento->kcb_madre              = $request->input('kcb_madre');
            $ejemplarEvento->nombre_madre           = $request->input('nom_madre');
            $ejemplarEvento->criador                = $request->input('criador');
            $ejemplarEvento->propietario            = $request->input('propietario');
            $ejemplarEvento->ciudad                 = $request->input('ciudad');
        }

        $ejemplarEvento->telefono               = $request->input('telefono');
        $ejemplarEvento->categoria_pista_id     = $request->input('categoria_pista_id');
        $ejemplarEvento->email                  = $request->input('email');
        $ejemplarEvento->estado                 = $request->input('estado');

        $ejemplarEvento->save();

        return redirect('Evento/listadoInscritos/'.$ejemplarEvento->evento_id);
    }

    public function eliminaInscripcion(Request $request, $inscripcion_id){
        $ejemplarEventoId = (EjemplarEvento::find($inscripcion_id))->evento_id;
        // dd($ejemplarEventoId);
        EjemplarEvento::destroy($inscripcion_id);
        return redirect('Evento/listadoInscritos/'.$ejemplarEventoId);
    }

    public function catalogo(Request $request, $evento_id){
        // dd("En desarrollo :v");

        // $ejemplares = EjemplarEvento::where("evento_id",$evento_id)
        //                             ->get();

        
        $ejemplares = EjemplarEvento::where("categoria_pista_id",1)
                                    ->where("evento_id",$evento_id)
                                    ->get();

        // dd($ejemplares);                                    

        return view('evento.catalogo')->with(compact('ejemplares'));
    }

}
