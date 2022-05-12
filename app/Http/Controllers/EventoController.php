<?php

namespace App\Http\Controllers;

use App\Juez;
use App\Raza;
use App\User;
use App\Evento;
use App\Ejemplar;
use App\GrupoRaza;
use App\Asignacion;
use App\Transferencia;
use App\EjemplarEvento;
use App\CategoriasPista;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
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
        $this->middleware('auth', ['except' => ['index', 'formulario','ajaxBuscaEjemplar','ajaxBuscaExtranjero','inscribirEvento', 'ajaxBuscaCategoria']]);

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

        $jueces = Juez::all();

        $secretarios = User::where('perfil_id',7)->get();

        return view('evento.listado')->with(compact('eventos','jueces', 'secretarios'));
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
        // $tipo->habilitado   = $request->input('habilitado');
        
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

                $transferencia = Transferencia::where('ejemplar_id', $ejemplar->id)
                                                ->where('estado', 'Actual')
                                                ->first();

                if($transferencia != null){

                    $arrayEjemplar['nom_propietario'] = $transferencia->propietario->name;    
                    $arrayEjemplar['departamento'] = $transferencia->propietario->departamento;    
                    $arrayEjemplar['celulares'] = $transferencia->propietario->celulares;    
                    $arrayEjemplar['email'] = $transferencia->propietario->email; 

                }else{

                    $arrayEjemplar['nom_propietario'] = $ejemplar->propietario->name;    
                    $arrayEjemplar['departamento'] = $ejemplar->propietario->departamento;    
                    $arrayEjemplar['celulares'] = $ejemplar->propietario->celulares;    
                    $arrayEjemplar['email'] = $ejemplar->propietario->email; 
                }

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

        $ejemplarEvento->extrangero                 = $request->input('verdad_extrangero');
        $ejemplarEvento->criador                    = $request->input('criador');
        $ejemplarEvento->telefono                   = $request->input('telefono');
        $ejemplarEvento->email                      = $request->input('email');

        if($request->input('verdad_extrangero') == 'si'){
            $ejemplarEvento->codigo_nacionalizado = $request->input('registro_extrangero');
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
                                    ->whereIn("categoria_pista_id",[3,4,12,13])
                                    ->get();
                                    // ->toSql();

        // dd($ejemplaresJovenes);                                    


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
        // dd($arrayGrupo);
        foreach ($arrayGrupo as $g2){
            if($g2 != ''){

                if($g2 > 0){
                    if($g2 > 0){
                        $eje = Ejemplar::find($g2);
                    }
                    else{
                        $h = (-1)*$g2;
                        $eje = EjemplarEvento::find($h);
                    }
                    if($eje){
                        if($eje->sexo == 'Macho'){
                            array_push($g2machos, "$eje->id");
                        }else{
                            array_push($g2hembras, "$eje->id");
                        }    
                    }
                }else{
                    
                    $h = (-1)*$g2;
                    $eje = EjemplarEvento::find($h);
                    $ejeExt = (-1) * $eje->id;
                    if($eje){
                        if($eje->sexo == 'Macho'){
                            array_push($g2machos, "$ejeExt");
                        }else{
                            array_push($g2hembras, "$ejeExt");
                        }    
                    }
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
                        $razas1->whereIn('ejemplares_eventos.categoria_pista_id', [3,4,12,13]);
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
        // var_dump($arrayEjemplares);
        // exit;
        
        $arrayEjemplaresAux = array();
        $arrayEjemplaresAux = $arrayEjemplares;

        // echo '<br><br>orginal mandano';
        // print_r($arrayEjemplares);
        
        // echo '<br><br>copiado';
        // print_r($arrayEjemplaresAux);

        foreach ($arrayEjemplares as $g2h){
            if($g2h > 0){

                $eventoEjemplarInscrito = EjemplarEvento::where('ejemplar_id',$g2h)
                                                        ->where('evento_id',$evento_id)
                                                        ->first();
                $sw = true;
                                                    
                foreach ($arrayEjemplaresAux as $key => $value) {

                    $eventoEjemplarInscritoAux = EjemplarEvento::where('ejemplar_id',$value)
                                                        ->where('evento_id',$evento_id)
                                                        ->first();

                                                        // dd($eventoEjemplarInscritoAux->categoria_pista_id);
                    if($eventoEjemplarInscrito && $eventoEjemplarInscritoAux){

                        if($eventoEjemplarInscrito->categoria_pista_id == $eventoEjemplarInscritoAux->categoria_pista_id){

                            $eje = Ejemplar::find($value);
                            // $eje = Ejemplar::find($g2h);
                            if($eje){
                                if($eje->raza_id == $raza->id){

                                    $numPre = EjemplarEvento::where('ejemplar_id',$eje->id)
                                                            ->where('evento_id',$evento_id)
                                                            ->first();

                                    if($eje->raza_id == $raza->id && $eventoEjemplarInscrito->categoria_pista_id == $eventoEjemplarInscritoAux->categoria_pista_id && $sw){

                                        $evento = EjemplarEvento::where('ejemplar_id',$eje->id)
                                                                    ->where('evento_id',$evento_id)
                                                                    ->first();
                                        // dd($evento);
                                        // echo "<h1 class='text-success'>".$evento->categoria_pista_id."<-->".$eje->id."</h1>";
                                        echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span> '.$eje->sexo.'s</h6>';

                                        $sw = false;

                                    }
                                    // if($sw){
                                    //     // if($eje->kcb){
                                    //     //     $evento = EjemplarEvento::where('kcb',$eje->kcb)->first();
                                    //     // }else{
                                    //     //     $evento = EjemplarEvento::where('codigo_nacionalizado',$eje->codigo_nacionalizado);
                                    //     // }
                                    //     $evento = EjemplarEvento::where('ejemplar_id',$eje->id)
                                    //                                 ->where('evento_id',$evento_id)
                                    //                                 ->first();
                                    //     echo "<h1 class='text-success'>".$evento->categoria_pista_id."<-->".$eje->id."</h1>";
                                    //     echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span> '.$eje->sexo.'s</h6>';
                
                                    //     // $evento = EjemplarEvento::where('ejemplar_id',$eje->id)->first();
                                    //     // echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span>'.$eje->sexo.'s</h6>';
                                    //     $sw = false;
                                    // }
                
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
            
                                    // echo '<b>'.$eje->nombre_completo.' <--> <span class="text-danger">'.$evento->categoria_pista_id."</span><-->".$eje->id.'</b><span class="text-danger">'.$nacionalidad."</span><br><br>" ;
            
                                    echo '<b>'.$numPre->numero_prefijo.". - ".$eje->nombre_completo.'</b><span class="text-danger">'.$nacionalidad."</span><br>" ;
                                    echo '<b>KCB: </b>'.$kcb.' - <b> FECHA NACIMIENTO: </b>'.date('d/m/Y',strtotime($eje->fecha_nacimiento)).' - <b> POR: </b>'.$padre.' y '.$madre.'<br>';
                                    echo '<b> PROPIETARIO: </b>'.$nombre_propietario.' - <b> CIUDAD/PAIS: </b>'.$departamento_propietario.' - <b> TELEFONOS: </b>'.$celulares_propietario.' - <b> EMAIL: </b>'.$email_propietario.'<br><br>';

                                    // echo "<h1>".$key.'<--->'.$value."</h1>";

                                    unset($arrayEjemplaresAux[$key]);
                                }
                            }

                        }
                    }

                }
                
                
            }else{
                $g2hExt = (-1) * $g2h ;

                $eje = EjemplarEvento::find($g2hExt);

                if($eje){
                    if($eje->raza_id == $raza->id){
                        if($sw){
                            $evento = EjemplarEvento::where('id',$eje->id)
                                                    ->where('evento_id',$evento_id)
                                                    ->first();
                            echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span> '.$eje->sexo.'s</h6>';
                            $sw = false;
                        }

                        $nacionalidad = '(Extranjero)';
                        $kcb =  $eje->codigo_nacionalizado; 
                        $padre = $eje->nombre_padre;
                        $madre = $eje->nombre_madre;

                        $nombre_propietario         = $eje->propietario;
                        $departamento_propietario   = $eje->ciudad;
                        $celulares_propietario      = $eje->telefono;
                        $email_propietario          = $eje->email;

                        echo '<b>'.$eje->numero_prefijo.". - ".$eje->nombre_completo.'</b><span class="text-danger">'.$nacionalidad."</span><br>" ;
                        echo '<b>COD EXTRANJERO: </b>'.$kcb.' - <b> FECHA NACIMIENTO: </b>'.date('d/m/Y',strtotime($eje->fecha_nacimiento)).' - <b> POR: </b>'.$padre.' y '.$madre.'<br>';
                        echo '<b> PROPIETARIO: </b>'.$nombre_propietario.' - <b> CIUDAD/PAIS: </b>'.$departamento_propietario.' - <b> TELEFONOS: </b>'.$celulares_propietario.' - <b> EMAIL: </b>'.$email_propietario.'<br><br>';
                    }
                }
            }
            
        }
    }

    public function catalogoNumeracion(Request $request, $evento_id){

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
                                    ->whereIn("categoria_pista_id",[3,4,12,13])
                                    ->get();

        $ejemplaresAdulto = EjemplarEvento::where("evento_id",$evento_id)
                                    ->whereIn("categoria_pista_id",[5,6,7,8,9,10,14,15,16,17,18,19,20])
                                    ->get();
                                    
        $arrayDeEjemplares = array();

        array_push($arrayDeEjemplares,$ejemplares);
        array_push($arrayDeEjemplares,$ejemplaresAbsolutos);
        array_push($arrayDeEjemplares,$ejemplaresJovenes);
        array_push($arrayDeEjemplares,$ejemplaresAdulto);

        foreach ($arrayDeEjemplares as $keyAE => $ejemplares){

            $grupo1  = array();
            $grupo2  = array();
            $grupo3  = array();
            $grupo4  = array();
            $grupo5  = array();
            $grupo6  = array();
            $grupo7  = array();
            $grupo8  = array();
            $grupo9  = array();
            $grupo10 = array();

            foreach ($ejemplares as $keyE => $e){

                $cant = GrupoRaza::where('raza_id',$e->raza_id)
                                        ->first();
                if($cant){

                    if($e->extrangero == 'no'){
                        $ejemplar = $e->ejemplar_id;
                    }else{
                        $ejemplar = (-1) * $e->id;
                    }

                    switch ($cant->grupo_id) {
                        case 1:
                            array_push($grupo1, "$ejemplar");
                            break;
                        case 2:
                            array_push($grupo2, "$ejemplar");
                            break;
                        case 3:
                            array_push($grupo3, "$ejemplar");
                            break;
                        case 4:
                            array_push($grupo4, "$ejemplar");
                            break;
                        case 5:
                            array_push($grupo5, "$ejemplar");
                            break;
                        case 6:
                            array_push($grupo6, "$ejemplar");
                            break;
                        case 7:
                            array_push($grupo7, "$ejemplar");
                            break;
                        case 8:
                            array_push($grupo8, "$ejemplar");
                            break;
                        case 9:
                            array_push($grupo9, "$ejemplar");
                            break;
                        case 10:
                            array_push($grupo10, "$ejemplar");
                            break;
                    }
                }
                
            }

            $arrayDeGrupos = array();

            array_push($arrayDeGrupos,$grupo1);
            array_push($arrayDeGrupos,$grupo2);
            array_push($arrayDeGrupos,$grupo3);
            array_push($arrayDeGrupos,$grupo4);
            array_push($arrayDeGrupos,$grupo5);
            array_push($arrayDeGrupos,$grupo6);
            array_push($arrayDeGrupos,$grupo7);
            array_push($arrayDeGrupos,$grupo8);
            array_push($arrayDeGrupos,$grupo9);
            array_push($arrayDeGrupos,$grupo10);

            $contador = 1;

            foreach($arrayDeGrupos as $keyDG => $grupo){

                if(!empty($grupo)){

                    $g2machos = array();
                    $g2hembras = array();

                    foreach ($grupo as $g2){
                        if($g2 != ''){

                            if($g2 > 0){
                                if($g2 > 0){
                                    $eje = Ejemplar::find($g2);
                                }
                                else{
                                    $h = (-1)*$g2;
                                    $eje = EjemplarEvento::find($h);
                                }
                                if($eje){
                                    if($eje->sexo == 'Macho'){
                                        array_push($g2machos, "$eje->id");
                                    }else{
                                        array_push($g2hembras, "$eje->id");
                                    }    
                                }
                            }else{
                                
                                $h = (-1)*$g2;
                                $eje = EjemplarEvento::find($h);
                                $ejeExt = (-1) * $eje->id;
                                if($eje){
                                    if($eje->sexo == 'Macho'){
                                        array_push($g2machos, "$ejeExt");
                                    }else{
                                        array_push($g2hembras, "$ejeExt");
                                    }    
                                }
                            }
                        }
                        
                        
                    }

                    $razas1 = EjemplarEvento::query();

                            $razas1->join('razas', 'ejemplares_eventos.raza_id', '=', 'razas.id')
                                ->join('grupos_razas', 'grupos_razas.raza_id', '=', 'razas.id')
                                ->join('grupos', 'grupos.id', '=', 'grupos_razas.grupo_id')
                                ->where('ejemplares_eventos.evento_id',$evento_id);

                                if($keyAE+1 == 1){
                                    $razas1->where('ejemplares_eventos.categoria_pista_id',1);
                                }elseif($keyAE+1 == 2){
                                    $razas1->whereIn('ejemplares_eventos.categoria_pista_id', [11,2]);
                                }elseif($keyAE+1 == 3){
                                    $razas1->whereIn('ejemplares_eventos.categoria_pista_id', [3,4,12,13]);
                                }else{
                                    $razas1->whereIn('ejemplares_eventos.categoria_pista_id', [5,6,7,8,9,10,14,15,16,17,18,19,20]);
                                }

                            $razas1->where('grupos.id',$keyDG+1)
                                ->groupBy('razas.id')
                                ->orderBy('razas.nombre','asc')
                                ->select('razas.*');

                        $razas = $razas1->get();

                    $swm = true;
                    $swh = true;

                    foreach ($razas as $r){
                        echo '<h5 class="text-primary"> - '. $r->nombre. '</h5>';
                        if (!empty($g2machos)){
                            echo "macho";

                            $swm = true;
                            // EventoController::catalogoDevuelveEjemplar($g2machos,$swm,$r,$evento_id);
                            
                            $arrayEjemplaresAux = array();
                            $arrayEjemplaresAux = $g2machos;

                            foreach ($g2machos as $g2h){

                                if($g2h > 0){

                                    $eventoEjemplarInscrito = EjemplarEvento::where('ejemplar_id',$g2h)
                                                                            ->where('evento_id',$evento_id)
                                                                            ->first();
                                    $swm = true;
                                                                        
                                    foreach ($arrayEjemplaresAux as $keyEAM => $value) {

                                        $eventoEjemplarInscritoAux = EjemplarEvento::where('ejemplar_id',$value)
                                                                            ->where('evento_id',$evento_id)
                                                                            ->first();

                                        if($eventoEjemplarInscrito && $eventoEjemplarInscritoAux){

                                            if($eventoEjemplarInscrito->categoria_pista_id == $eventoEjemplarInscritoAux->categoria_pista_id){

                                                $eje = Ejemplar::find($value);

                                                if($eje){
                                                    if($eje->raza_id == $r->id){
                                                        
                                                        $numPre = EjemplarEvento::where('ejemplar_id',$eje->id)
                                                                                ->where('evento_id',$evento_id)
                                                                                ->first();
                                                        
                                                        $numPre->numero_prefijo =  $contador.(($keyAE+1 == 1)? 'E' : (($keyAE+1 == 2)? 'A':''));

                                                        $numPre->save();

                                                        // if($eje->raza_id == $r->id && $eventoEjemplarInscrito->categoria_pista_id == $eventoEjemplarInscritoAux->categoria_pista_id && $swm){

                                                        //     $evento = EjemplarEvento::where('ejemplar_id',$eje->id)
                                                        //                                 ->where('evento_id',$evento_id)
                                                        //                                 ->first();

                                                        //     echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span> '.$eje->sexo.'s</h6>';

                                                        //     $swm = false;

                                                        // }
                                    
                                                        // if($eje->kcb == null && ($eje->codigo_nacionalizado != '' || $eje->codigo_nacionalizado != null)){
                                                        //     $nacionalidad = '(Extranjero)';
                                                        //     $kcb =  $eje->codigo_nacionalizado; 
                                                        // }else{
                                                        //     $nacionalidad = '(Nacional)';
                                                        //     $kcb =  $eje->kcb; 
                                                        // }
                                    
                                                        // if($eje->padre){
                                                        //     $padre = $eje->padre->nombre_completo;
                                                        // }else{
                                                        //     $padre = '';
                                                        // }
                                    
                                                        // if($eje->madre){
                                                        //     $madre = $eje->madre->nombre_completo;
                                                        // }else{
                                                        //     $madre = '';
                                                        // }
                                    
                                                        // if($eje->propietario){
                                                        //     $nombre_propietario         = $eje->propietario->name;
                                                        //     $departamento_propietario   = $eje->propietario->departamento;
                                                        //     $celulares_propietario      = $eje->propietario->celulares;
                                                        //     $email_propietario          = $eje->propietario->email;
                                                        // }else{
                                                        //     $nombre_propietario         = '';
                                                        //     $departamento_propietario   = '';
                                                        //     $celulares_propietario      = '';
                                                        //     $email_propietario          = '';
                                                        // }
                                
                                                        // echo '<b>'.$contador.(($keyAE+1 == 1)? 'E' : (($keyAE+1 == 2)? 'A':''))." ".$eje->nombre_completo.'</b><span class="text-danger">'.$nacionalidad."</span><br>" ;
                                                        // echo '<b>KCB: </b>'.$kcb.' - <b> FECHA NACIMIENTO: </b>'.date('d/m/Y',strtotime($eje->fecha_nacimiento)).' - <b> POR: </b>'.$padre.' y '.$madre.'<br>';
                                                        // echo '<b> PROPIETARIO: </b>'.$nombre_propietario.' - <b> CIUDAD/PAIS: </b>'.$departamento_propietario.' - <b> TELEFONOS: </b>'.$celulares_propietario.' - <b> EMAIL: </b>'.$email_propietario.'<br><br>';

                                                        unset($arrayEjemplaresAux[$keyEAM]);
                                                        
                                                        $contador++;
                                                    }


                                                }

                                            }
                                        }

                                    }
                                    
                                    
                                }else{
                                    $g2hExt = (-1) * $g2h ;

                                    $eje = EjemplarEvento::find($g2hExt);

                                    if($eje){
                                        if($eje->raza_id == $r->id){

                                            $eje->numero_prefijo = $contador.(($keyAE+1 == 1)? 'E' : (($keyAE+1 == 2)? 'A':''));

                                            $eje->save();

                                            // if($swm){
                                            //     $evento = EjemplarEvento::where('id',$eje->id)
                                            //                             ->where('evento_id',$evento_id)
                                            //                             ->first();
                                            //     echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span> '.$eje->sexo.'s</h6>';
                                            //     $swm = false;
                                            // }

                                            // $nacionalidad = '(Extranjero)';
                                            // $kcb =  $eje->codigo_nacionalizado; 
                                            // $padre = $eje->nombre_padre;
                                            // $madre = $eje->nombre_madre;

                                            // $nombre_propietario         = $eje->propietario;
                                            // $departamento_propietario   = $eje->ciudad;
                                            // $celulares_propietario      = $eje->telefono;
                                            // $email_propietario          = $eje->email;

                                            // echo '<b>'.$contador.(($keyAE+1 == 1)? 'E' : (($keyAE+1 == 2)? 'A':''))." ".$eje->nombre_completo.'</b><span class="text-danger">'.$nacionalidad."</span><br>" ;
                                            // echo '<b>COD EXTRANJERO: </b>'.$kcb.' - <b> FECHA NACIMIENTO: </b>'.date('d/m/Y',strtotime($eje->fecha_nacimiento)).' - <b> POR: </b>'.$padre.' y '.$madre.'<br>';
                                            // echo '<b> PROPIETARIO: </b>'.$nombre_propietario.' - <b> CIUDAD/PAIS: </b>'.$departamento_propietario.' - <b> TELEFONOS: </b>'.$celulares_propietario.' - <b> EMAIL: </b>'.$email_propietario.'<br><br>';

                                            $contador++;
                                        }
                                    }
                                }
                                
                            }
                            // EventoController::catalogoDevuelveEjemplar($g2machos,$swm,$r,$evento_id);
                        }
                        if (!empty($g2hembras)){

                            $swh = true;
                            // EventoController::catalogoDevuelveEjemplar($g2hembras,$swh,$r,$evento_id);
                            
                            $arrayEjemplaresAux = array();
                            $arrayEjemplaresAux = $g2hembras;

                            foreach ($g2hembras as $g2h){

                                if($g2h > 0){

                                    $eventoEjemplarInscrito = EjemplarEvento::where('ejemplar_id',$g2h)
                                                                            ->where('evento_id',$evento_id)
                                                                            ->first();
                                    $swh = true;
                                                                        
                                    foreach ($arrayEjemplaresAux as $keyEAH => $value) {

                                        $eventoEjemplarInscritoAux = EjemplarEvento::where('ejemplar_id',$value)
                                                                            ->where('evento_id',$evento_id)
                                                                            ->first();
                                        if($eventoEjemplarInscrito && $eventoEjemplarInscritoAux){

                                            if($eventoEjemplarInscrito->categoria_pista_id == $eventoEjemplarInscritoAux->categoria_pista_id){

                                                $eje = Ejemplar::find($value);

                                                if($eje){
                                                    if($eje->raza_id == $r->id){
                                                        
                                                        $numPre = EjemplarEvento::where('ejemplar_id',$eje->id)
                                                                                ->where('evento_id',$evento_id)
                                                                                ->first();
                                
                                                        $numPre->numero_prefijo =  $contador.(($keyAE+1 == 1)? 'E' : (($keyAE+1 == 2)? 'A':''));

                                                        $numPre->save();

                                                        // if($eje->raza_id == $r->id && $eventoEjemplarInscrito->categoria_pista_id == $eventoEjemplarInscritoAux->categoria_pista_id && $swh){

                                                        //     $evento = EjemplarEvento::where('ejemplar_id',$eje->id)
                                                        //                                 ->where('evento_id',$evento_id)
                                                        //                                 ->first();

                                                        //     echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span> '.$eje->sexo.'s</h6>';

                                                        //     $swh = false;

                                                        // }
                                    
                                                        // if($eje->kcb == null && ($eje->codigo_nacionalizado != '' || $eje->codigo_nacionalizado != null)){
                                                        //     $nacionalidad = '(Extranjero)';
                                                        //     $kcb =  $eje->codigo_nacionalizado; 
                                                        // }else{
                                                        //     $nacionalidad = '(Nacional)';
                                                        //     $kcb =  $eje->kcb; 
                                                        // }
                                    
                                                        // if($eje->padre){
                                                        //     $padre = $eje->padre->nombre_completo;
                                                        // }else{
                                                        //     $padre = '';
                                                        // }
                                    
                                                        // if($eje->madre){
                                                        //     $madre = $eje->madre->nombre_completo;
                                                        // }else{
                                                        //     $madre = '';
                                                        // }
                                    
                                                        // if($eje->propietario){
                                                        //     $nombre_propietario         = $eje->propietario->name;
                                                        //     $departamento_propietario   = $eje->propietario->departamento;
                                                        //     $celulares_propietario      = $eje->propietario->celulares;
                                                        //     $email_propietario          = $eje->propietario->email;
                                                        // }else{
                                                        //     $nombre_propietario         = '';
                                                        //     $departamento_propietario   = '';
                                                        //     $celulares_propietario      = '';
                                                        //     $email_propietario          = '';
                                                        // }
                                
                                                        // echo '<b>'.$contador.(($keyAE+1 == 1)? 'E' : (($keyAE+1 == 2)? 'A':''))." ".$eje->nombre_completo.'</b><span class="text-danger">'.$nacionalidad."</span><br>" ;
                                                        // echo '<b>KCB: </b>'.$kcb.' - <b> FECHA NACIMIENTO: </b>'.date('d/m/Y',strtotime($eje->fecha_nacimiento)).' - <b> POR: </b>'.$padre.' y '.$madre.'<br>';
                                                        // echo '<b> PROPIETARIO: </b>'.$nombre_propietario.' - <b> CIUDAD/PAIS: </b>'.$departamento_propietario.' - <b> TELEFONOS: </b>'.$celulares_propietario.' - <b> EMAIL: </b>'.$email_propietario.'<br><br>';

                                                        unset($arrayEjemplaresAux[$keyEAH]);

                                                        $contador++;

                                                    }
                                                }

                                            }
                                        }
                                    }
                                    
                                    
                                }else{
                                    $g2hExt = (-1) * $g2h ;

                                    $eje = EjemplarEvento::find($g2hExt);

                                    if($eje){
                                        if($eje->raza_id == $r->id){

                                            $eje->numero_prefijo = $contador.(($keyAE+1 == 1)? 'E' : (($keyAE+1 == 2)? 'A':''));

                                            $eje->save();

                                            // if($swh){
                                            //     $evento = EjemplarEvento::where('id',$eje->id)
                                            //                             ->where('evento_id',$evento_id)
                                            //                             ->first();
                                            //     echo '<h6> <span class="text-danger">'.$evento->categoriaPista->nombre.'</span> '.$eje->sexo.'s</h6>';
                                            //     $swh = false;
                                            // }

                                            // $nacionalidad = '(Extranjero)';
                                            // $kcb =  $eje->codigo_nacionalizado; 
                                            // $padre = $eje->nombre_padre;
                                            // $madre = $eje->nombre_madre;

                                            // $nombre_propietario         = $eje->propietario;
                                            // $departamento_propietario   = $eje->ciudad;
                                            // $celulares_propietario      = $eje->telefono;
                                            // $email_propietario          = $eje->email;

                                            // echo '<b>'.$contador.(($keyAE+1 == 1)? 'E' : (($keyAE+1 == 2)? 'A':''))." ".$eje->nombre_completo.'</b><span class="text-danger">'.$nacionalidad."</span><br>" ;
                                            // echo '<b>COD EXTRANJERO: </b>'.$kcb.' - <b> FECHA NACIMIENTO: </b>'.date('d/m/Y',strtotime($eje->fecha_nacimiento)).' - <b> POR: </b>'.$padre.' y '.$madre.'<br>';
                                            // echo '<b> PROPIETARIO: </b>'.$nombre_propietario.' - <b> CIUDAD/PAIS: </b>'.$departamento_propietario.' - <b> TELEFONOS: </b>'.$celulares_propietario.' - <b> EMAIL: </b>'.$email_propietario.'<br><br>';
                                            
                                            $contador++;
                                        }
                                    }
                                }
                            }
                        }
                        // if($contador == 4)
                        //     break;
                        
                        //$contador++;
                    }

                    // EventoController::armaCatalogo($grupo, $evento->id, ($keyDG+1), ($keyAE+1));

                }
            }


            // echo '<hr>';
            // echo '<br><br>grupo I -> ';
            // print_r($grupo1);
            // echo '<br><br>grupo II -> ';
            // print_r($grupo2);
            // echo '<br><br>grupo III -> ';
            // print_r($grupo3);
            // echo '<br><br>grupo IV -> ';
            // print_r($grupo4);
            // echo '<br><br>grupo V -> ';
            // print_r($grupo5);
            // echo '<br><br>grupo VI -> ';
            // print_r($grupo6);
            // echo '<br><br>grupo VII -> ';
            // print_r($grupo7);
            // echo '<br><br>grupo VIII -> ';
            // print_r($grupo8);
            // echo '<br><br>grupo IX -> ';
            // print_r($grupo9);
            // echo '<br><br>grupo X -> ';
            // print_r($grupo10);

        }

        return redirect('Evento/listado');
        // return redirect('Evento/catalogo/'.$evento_id);

    }

    public function ajaxBuscaCategoria(Request $request){

        $arrayCategorias = array();

        $edad = $request->input('edad');

        // dd($request->input('edad'));
        $e = intval($edad);

        if($request->input('sexo')=='Macho'){

            $categorias = DB::table('categorias_pistas')->where('hasta','>=',$e)
                                                        ->where('desde','<=',$e)
                                                        ->whereIn('id', [1,3,5,7,9,11,12,14,16])
                                                        // ->toSql();
                                                        ->get();
        }else{
            $categorias = DB::table('categorias_pistas')->where('hasta','>=',$e)
                                                        ->where('desde','<=',$e)
                                                        ->whereIn('id', [1,2,4,6,8,10,13,15,17])
                                                        // ->toSql();
                                                        ->get();
        }

        // dd($categorias."---".$edad);
        // dd($categorias);

        if($categorias){
            $punetero = 0 ;
            foreach ($categorias as $key =>  $ca){
                $arrayCategorias[$punetero] = $ca->id;
                $arrayCategorias[$punetero+1] = $ca->nombre;
                 
                $punetero = $punetero + 2 ;
                //  $arrayCategorias[$ca->id] = $ca->nombre;
            }
        }

        // dd("holas");

        return json_encode($arrayCategorias);
    }

}
