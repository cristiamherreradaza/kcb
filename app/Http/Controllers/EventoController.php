<?php

namespace App\Http\Controllers;

use App\Raza;
use App\Evento;
use App\Ejemplar;
use App\EjemplarEvento;
use App\CategoriasPista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MenssgeConfirmacionInscripcionEvento;

class EventoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        
        // $this->middleware('auth', ['except' => ['index', 'guarda']]);
        $this->middleware('auth', ['except' => ['index', 'formulario','ajaxBuscaEjemplar','ajaxBuscaExtranjero','inscribirEvento']]);

        // $this->middleware('auth')->except('formulario');
        // $this->middleware('auth', ['except' => [
        //     'formulario',
        //     'ajaxBuscaEjemplar',
        //     'ajaxBuscaExtranjero'
        //     ]
        // ]);

        // $this->middleware(['auth' => 'verified'])->except("page_name_1", "page_name_2", "page_name_3");
    }
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
        // Mail::to($request->user())->send(new MenssgeConfirmacionInscripcionEvento);

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
            if($ejemplar->propietario){
                $arrayEjemplar['nom_propietario'] = $ejemplar->propietario->name;    
                $arrayEjemplar['departamento'] = $ejemplar->propietario->departamento;    
                $arrayEjemplar['celulares'] = $ejemplar->propietario->celulares;    
                $arrayEjemplar['email'] = $ejemplar->propietario->email; 
            }else{
                $arrayEjemplar['nom_propietario'] = null;    
                $arrayEjemplar['departamento'] = null;    
                $arrayEjemplar['celulares'] = null;    
                $arrayEjemplar['email'] = null; 
            }
            // dd($ejemplar->propietario);   

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

            // $ejemplarEvento->user_id                    = Auth::user()->id;
            $ejemplarEvento->evento_id                  = $request->input('evento_id');
            $ejemplarEvento->ejemplar_id                = $request->input('ejemplar_id');      
            $ejemplarEvento->categoria_pista_id         = $request->input('categoria_pista');

            $ejemplarEvento->raza_id                    = $request->input('raza_id');
            $ejemplarEvento->nombre_completo            = $request->input('nombre');
            $ejemplarEvento->color                      = $request->input('color');
            $ejemplarEvento->fecha_nacimiento           = $request->input('fecha_nacimiento');
            $ejemplarEvento->chip                       = $request->input('chip');
            $ejemplarEvento->kcb_padre                  = $request->input('kcb_padre');
            $ejemplarEvento->nombre_padre               = $request->input('nom_padre');
            $ejemplarEvento->kcb_madre                  = $request->input('kcb_madre');
            $ejemplarEvento->nombre_madre               = $request->input('nom_madre');
            $ejemplarEvento->propietario                = $request->input('propietario');
            $ejemplarEvento->ciudad                     = $request->input('ciudad');
            $ejemplarEvento->sexo                       = $request->input('sexo');
            $ejemplarEvento->tatuaje                    = $request->input('tatuaje');

            $ejemplarEvento->extrangero                 = 'no';
            $ejemplarEvento->criador                    = $request->input('criador');
            $ejemplarEvento->telefono                   = $request->input('telefono');
            $ejemplarEvento->email                      = $request->input('email');

        }elseif($request->cod_extrangero && $request->ejemplar_id == null){

            // $ejemplarEvento->user_id                    = Auth::user()->id;
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

            $ejemplarEvento->tatuaje                    = $request->input('tatuaje');
        }

        $ejemplarEvento->edad                           = $request->input('ejemplar_meses');

        $ejemplarEvento->save();
        // dd($request->input('email'));
        // $haber = json_encode($request->all());
        // Mail::to($request->input('email'))->send(new MenssgeConfirmacionInscripcionEvento);
        // Mail::to('jjjoelcito123@gmail.com')->send(new MenssgeConfirmacionInscripcionEvento($request->input('email')));
        Mail::to($request->input('email'))->send(new MenssgeConfirmacionInscripcionEvento($ejemplarEvento->id));

        // $inscripcionEvento = $ejemplarEvento->id;
        if($ejemplarEvento->extrangero == 'si'){
            $ejemplarVista = $ejemplarEvento;
        }else{
            $ejemplarVista = Ejemplar::find($ejemplarEvento->ejemplar_id);
        }
        return view('evento.registroExitoso')->with(compact('ejemplarVista','ejemplarEvento'));;
        // echo  'se registro';
    }

    public function listadoInscritos(Request $request, $evento_id){
        // dd($evento_id);

        $ejemplaresEventos = EjemplarEvento::where('evento_id',$evento_id)
                                            ->get();
                                            // ->toSql();
                                            // dd($ejemplaresEventos);

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
        $evento = Evento::find($evento_id);

        
        $ejemplares = EjemplarEvento::where("categoria_pista_id",1)
                                    ->where("evento_id",$evento_id)
                                    ->get();

        $ejemplaresAbsolutos = EjemplarEvento::where("evento_id",$evento_id)
                                    ->where(function($query){
                                        $query->orwhere("categoria_pista_id",11)
                                              ->orwhere("categoria_pista_id",2);
                                    })
                                    ->get();

        $ejemplaresJovenes = EjemplarEvento::where("evento_id",$evento_id)
                                    ->whereIn("categoria_pista_id",[3,4])
                                    ->get();

        $ejemplaresAdulto = EjemplarEvento::where("evento_id",$evento_id)
                                    ->whereIn("categoria_pista_id",[5,6,7,8,9,10,14,15,16,17,18,19,20])
                                    ->get();
        // $ejemplaresJoveAdulto = EjemplarEvento::where("evento_id",$evento_id)
        //                             ->whereIn("categoria_pista_id",[3,4,5,6,7,8,9,10,14,15])
        //                             ->get();
        // dd($ejemplaresJoveAdulto);                                    

        // return view('evento.catalogo')->with(compact('ejemplares', 'evento','ejemplaresAbsolutos', 'ejemplaresJoveAdulto'));
        return view('evento.catalogo')->with(compact('ejemplares', 'evento','ejemplaresAbsolutos', 'ejemplaresJovenes', 'ejemplaresAdulto'));
    }

    public static function armaCatalogo($arrayGrupo, $evento_id, $grupo, $categoria){
        // dd($arrayGrupo);
        // dd($evento_id."<----->".$grupo."<----->".$categoria1."<----->".$categoria2);
        $g2machos = array();
        $g2hembras = array();
        foreach ($arrayGrupo as $g2){
            $eje = Ejemplar::find($g2);
            if($eje){
                if($eje->sexo == 'Macho'){
                    array_push($g2machos, "$eje->id");
                }else{
                    array_push($g2hembras, "$eje->id");
                }    
            }
            
        }
            $razas1 = EjemplarEvento::query();

                  $razas1->join('razas', 'ejemplares_eventos.raza_id', '=', 'razas.id')
                        ->join('grupos_razas', 'grupos_razas.raza_id', '=', 'razas.id')
                        ->join('grupos', 'grupos.id', '=', 'grupos_razas.grupo_id')
                        ->where('ejemplares_eventos.evento_id',$evento_id);
                        if($categoria == 1){
                            $razas1->where('ejemplares_eventos.categoria_pista_id',1);
                        }elseif($categoria == 2){
                            $razas1->whereIn('ejemplares_eventos.categoria_pista_id', [11,2]);
                        }elseif($categoria == 3){
                            $razas1->whereIn('ejemplares_eventos.categoria_pista_id', [3,4]);
                        }else{
                            $razas1->whereIn('ejemplares_eventos.categoria_pista_id', [5,6,7,8,9,10,14,15,16,17,18,19,20]);
                        }
                  $razas1->where('grupos.id',$grupo)
                        ->groupBy('razas.id')
                        ->orderBy('razas.nombre','asc')
                        ->select('razas.*');
                        // ->toSql();
                // $razas = $razas1->toSql();
                $razas = $razas1->get();
            // echo $razas;
            // dd($razas);
        $swm = true;
        $swh = true;

        foreach ($razas as $r){
            echo '<h5 class="text-primary"> - '. $r->nombre. '</h5>';
            // <h5 class="text-primary"> - {{ $r->nombre }}</h5>
            if (!empty($g2machos)){
                $swm = true;
                EventoController::catalogoDevuelveEjemplar($g2machos,$swm,$r,$evento_id);
            }
            if (!empty($g2hembras)){
                $swh = true;
                EventoController::catalogoDevuelveEjemplar($g2hembras,$swh,$r,$evento_id);
            }
        }
    }

    // public static function catalogoDevuelveEjemplar($arrayEjemplares, $sw, $raza){
    public static function catalogoDevuelveEjemplar($arrayEjemplares, $sw, $raza, $evento_id){
        // dd($sexo);
        foreach ($arrayEjemplares as $g2h){
            $eje = Ejemplar::find($g2h);
            if($eje){
                if($eje->raza_id == $raza->id){
                    if($sw){
                        // if($eje->kcb){
                        //     $evento = EjemplarEvento::where('kcb',$eje->kcb)->first();
                        // }else{
                        //     $evento = EjemplarEvento::where('codigo_nacionalizado',$eje->codigo_nacionalizado);
                        // }

                        
                        $evento = EjemplarEvento::where('ejemplar_id',$eje->id)
                                                    ->where('evento_id',$evento_id)
                                                    ->first();
                        // dd($evento);
                        // echo "<h1 class='text-success'>".$evento->categoria_pista_id."<-->".$eje->id."</h1>";
                        echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span> '.$eje->sexo.'s</h6>';

                        // $evento = EjemplarEvento::where('ejemplar_id',$eje->id)->first();
                        // echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span>'.$eje->sexo.'s</h6>';
                        $sw = false;
                    }

                    if($eje->kcb == null && ($eje->codigo_nacionalizado != '' || $eje->codigo_nacionalizado != null)){
                        $nacionalidad = '(Extranjero)';
                        $kcb =  $eje->codigo_nacionalizado; 
                    }else{
                        $nacionalidad = '(Nacional)';
                        $kcb =  $eje->kcb; 
                    }

                    if($eje->padre){
                        $padre = $eje->padre->nombre_completo;
                    }else{
                        $padre = '';
                    }

                    if($eje->madre){
                        $madre = $eje->madre->nombre_completo;
                    }else{
                        $madre = '';
                    }

                    if($eje->propietario){
                        $nombre_propietario         = $eje->propietario->name;
                        $departamento_propietario   = $eje->propietario->departamento;
                        $celulares_propietario      = $eje->propietario->celulares;
                        $email_propietario          = $eje->propietario->email;
                    }else{
                        $nombre_propietario         = '';
                        $departamento_propietario   = '';
                        $celulares_propietario      = '';
                        $email_propietario          = '';
                    }
                    echo '<b>'.$eje->nombre_completo.'</b><span class="text-danger">'.$nacionalidad."</span><br>" ;
                    echo '<b>KCB: </b>'.$kcb.' - <b> FECHA NACIMIENTO: </b>'.date('d/m/Y',strtotime($eje->fecha_nacimiento)).' - <b> POR: </b>'.$padre.' y '.$madre.'<br>';
                    echo '<b> PROPIETARIO: </b>'.$nombre_propietario.' - <b> CIUDAD/PAIS: </b>'.$departamento_propietario.' - <b> TELEFONOS: </b>'.$celulares_propietario.' - <b> EMAIL: </b>'.$email_propietario.'<br><br>';
                }
            }
        }
    }

}
