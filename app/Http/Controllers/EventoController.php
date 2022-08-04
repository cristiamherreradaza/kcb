<?php

namespace App\Http\Controllers;

use PDF;
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
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MenssgeConfirmacionInscripcionEvento;

class EventoController extends Controller
{
    public function __construct(){

        $this->middleware('auth', ['except' => ['index', 'formulario','ajaxBuscaEjemplar','ajaxBuscaExtranjero','inscribirEvento', 'ajaxBuscaCategoria']]);

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
        $tipo->habilitado   = $request->input('habilitado');
        
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

        // PARA LA IMAGEN
        if($request->file('carnet')){

            $archivo                            = $request->file('carnet');
            $direccion                          = 'imagenesCarnet/';   
            $nombreArchivo                      = date('YmdHis').".".$archivo->getClientOriginalExtension();

            $archivo->move($direccion,$nombreArchivo);

            $ejemplarEvento->carnet             = $nombreArchivo;

        }

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
        $ejemplarEvento->extrangero             = $request->input('extrangero');

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

        $ejemplaresAdulto = EjemplarEvento::where("evento_id",$evento_id)
                                    ->whereIn("categoria_pista_id",[5,6,7,8,9,10,14,15,16,17,18,19,20])
                                    ->get();

        return view('evento.catalogo')->with(compact('ejemplares', 'evento','ejemplaresAbsolutos', 'ejemplaresJovenes', 'ejemplaresAdulto'));
    }

    public static function armaCatalogo($arrayGrupo, $evento_id, $grupo, $categoria){

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

            $razas = $razas1->get();

        $swm = true;
        $swh = true;

        foreach ($razas as $r){
            echo '<h5 class="text-primary"> - '. $r->nombre. '</h5>';

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
                        if (!empty($g2machos)){
                            $swm = true;
                            
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

                                                        if($keyAE+1 == 1){

                                                            $prefijo = 'E';
            
                                                        }elseif($keyAE+1 == 2){
            
                                                            $prefijo = 'A';
            
                                                        }elseif($keyAE+1 == 3){
            
                                                            $prefijo = 'J';
            
                                                        }else{
            
                                                            $prefijo = '';
            
                                                        }
                                                        
                                                        $numPre->numero_prefijo =  $contador.$prefijo;

                                                        $numPre->save();

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

                                            if($keyAE+1 == 1){

                                                $prefijo = 'E';

                                            }elseif($keyAE+1 == 2){

                                                $prefijo = 'A';

                                            }elseif($keyAE+1 == 3){

                                                $prefijo = 'J';

                                            }else{

                                                $prefijo = '';

                                            }

                                            $eje->numero_prefijo = $contador.$prefijo;

                                            $eje->save();

                                            $contador++;
                                        }
                                    }
                                }
                                
                            }
                        }
                        if (!empty($g2hembras)){

                            $swh = true;
                            
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

                                                                                
                                                        if($keyAE+1 == 1){

                                                            $prefijo = 'E';

                                                        }elseif($keyAE+1 == 2){

                                                            $prefijo = 'A';

                                                        }elseif($keyAE+1 == 3){

                                                            $prefijo = 'J';

                                                        }else{

                                                            $prefijo = '';

                                                        }

                                                        $numPre->numero_prefijo = $contador.$prefijo;
                                
                                                        $numPre->save();

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

                                        
                                            if($keyAE+1 == 1){

                                                $prefijo = 'E';

                                            }elseif($keyAE+1 == 2){

                                                $prefijo = 'A';

                                            }elseif($keyAE+1 == 3){

                                                $prefijo = 'J';

                                            }else{

                                                $prefijo = '';

                                            }

                                            $eje->numero_prefijo = $contador.$prefijo;

                                            $eje->save();

                                            $contador++;
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }
        }

        return redirect('Evento/listado');
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

    // public function generaBestingPdf(Request $request, $evento, $tipo){

    //     $ganadores = Evento::bestingTipos($tipo, $evento);

    //     $grupo1 = array();
    //     $grupo2 = array();
    //     $grupo3 = array();
    //     $grupo4 = array();
    //     $grupo5 = array();
    //     $grupo6 = array();
    //     $grupo7 = array();
    //     $grupo8 = array();
    //     $grupo9 = array();
    //     $grupo10 = array();
    //     $grupo11 = array();

    //     $arrayGrupo = array();

    //     foreach ($ganadores as $g){

    //         switch ($g->grupo_id) {
    //             case 1:
    //                 array_push($grupo1,$g);
    //                 break;
    //             case 2:
    //                 array_push($grupo2,$g);
    //                 break;
    //             case 3:
    //                 array_push($grupo3,$g);
    //                 break;
    //             case 4:
    //                 array_push($grupo4,$g);
    //                 break;
    //             case 5:
    //                 array_push($grupo5,$g);
    //                 break;
    //             case 6:
    //                 array_push($grupo6,$g);
    //                 break;
    //             case 7:
    //                 array_push($grupo7,$g);
    //                 break;
    //             case 8:
    //                 array_push($grupo8,$g);
    //                 break;
    //             case 9:
    //                 array_push($grupo9,$g);
    //                 break;
    //             case 10:
    //                 array_push($grupo10,$g);
    //                 break;
    //             case 11:
    //                 array_push($grupo11,$g);
    //                 break;
    //         }

    //     }

    //     array_push($arrayGrupo, $grupo1);
    //     array_push($arrayGrupo, $grupo2);
    //     array_push($arrayGrupo, $grupo3);
    //     array_push($arrayGrupo, $grupo4);
    //     array_push($arrayGrupo, $grupo5);
    //     array_push($arrayGrupo, $grupo6);
    //     array_push($arrayGrupo, $grupo7);
    //     array_push($arrayGrupo, $grupo8);
    //     array_push($arrayGrupo, $grupo9);
    //     array_push($arrayGrupo, $grupo10);
    //     array_push($arrayGrupo, $grupo11);

    //     // SACAMOS LOS GANADORES
    //     // primer
    //     $primerLugar = Evento::getPuestoGanador($evento, $tipo, 1);

    //     // segundo
    //     $segundoLugar = Evento::getPuestoGanador($evento, $tipo, 2);

    //     // tercer
    //     $tercerLugar = Evento::getPuestoGanador($evento, $tipo, 3);

    //     // cuarto
    //     $cuartoLugar = Evento::getPuestoGanador($evento, $tipo, 4);

    //     // quinto
    //     $quintoLugar = Evento::getPuestoGanador($evento, $tipo, 5);

    //     // BUSCAMOS AL JUEZ DEL EVENTO
    //     $juez = Evento::getJuez($evento);


    //     $pdf    = PDF::loadView('evento.generaBestingPdf', compact('ganadores', 'tipo', 'arrayGrupo', 'primerLugar', 'segundoLugar', 'tercerLugar', 'cuartoLugar', 'quintoLugar', 'juez'))->setPaper('letter', 'landscape');

    //     return $pdf->stream('Planilla_'.date('Y-m-d H:i:s').'.pdf');      

    //     // return view('evento.generaBestingPdf')->with(compact('ganadores'));

    // }

    public function inscribirEjemplar(Request $request){

        $ejemplar_id = $request->input('inscribe_ejemplar_id');
        $evento_id   = $request->input('inscribe_evento_id');

        if($ejemplar_id != 0){

            $ejemplar = Ejemplar::find($ejemplar_id);

        }else{

            $ejemplar = null;

        }

        $ejemplar_evento = new EjemplarEvento();

        $ejemplar_evento->user_id               = Auth::user()->id;
        $ejemplar_evento->evento_id             = $evento_id;
        $ejemplar_evento->ejemplar_id           = ($ejemplar)? $ejemplar->id : null;
        $ejemplar_evento->raza_id               = ($ejemplar)? $ejemplar->raza_id : $request->input('inscribe_raza_id');
        $ejemplar_evento->categoria_pista_id    = $request->input('inscribe_categoria_pista_id');
        $ejemplar_evento->extrangero            = $request->input('inscribe_extranjero');
        $ejemplar_evento->codigo_nacionalizado  = $request->input('inscribe_cod_extranjero');
        $ejemplar_evento->nombre_completo       = $request->input('inscribe_nombre');
        $ejemplar_evento->color                 = $request->input('inscribe_color');
        $ejemplar_evento->tatuaje               = $request->input('inscribe_num_tatuaje');
        $ejemplar_evento->fecha_nacimiento      = $request->input('inscribe_fecha_nacimiento');
        $ejemplar_evento->sexo                  = $request->input('inscribe_sexo');
        $ejemplar_evento->chip                  = $request->input('inscribe_chip');
        $ejemplar_evento->kcb_padre             = $request->input('inscribe_kcb_padre');
        $ejemplar_evento->nombre_padre          = $request->input('inscribe_nom_padre');
        $ejemplar_evento->kcb_madre             = $request->input('inscribe_kcb_madre');
        $ejemplar_evento->nombre_madre          = $request->input('inscribe_nom_madre');
        // $ejemplar_evento->criador               = $request->input('inscribe_cod_extranjero');
        $ejemplar_evento->propietario           = $request->input('inscribe_propietario');
        $ejemplar_evento->ciudad                = $request->input('inscribe_ciudad');
        $ejemplar_evento->telefono              = $request->input('inscribe_telefono');
        $ejemplar_evento->email                 = $request->input('inscribe_email');
        // $ejemplar_evento->edad  = $request->input('inscribe_cod_extranjero');
        $ejemplar_evento->numero_prefijo        = $request->input('inscribe_numero_prefijo');

        $ejemplar_evento->save();


        return redirect('Evento/listadoInscritos/'.$evento_id);

    }

    public function buscaExtranjero(Request $request){

        if($request->all()){

            $codigo = $request->input('codigo');

            $ejemplar = Ejemplar::where('codigo_nacionalizado', $codigo)
                                ->first();

            if($ejemplar){

                $data['status'] = 'success';
                $data['ejemplar'] = $ejemplar;                

            }else{

                $data['status'] = 'error';

            }

            return $data;
        }
    }

    public function ranking(Request $request, $evento_id, $pista){

        $evento = Evento::find($evento_id);

        $razas = Evento::razasParticipantesEventoGanadores($evento_id, $pista);


        // MANDARESMO LAS RAZAS LAS RAZAS
        $ejemplares = array();

        foreach($razas as $ra){

            // PARA EL MEJOR CACHORRO
            $mejorCachorro = Juez::mejorCategoria($evento_id, $pista, $ra->raza_id, 'mejor_cachorro');
            
            // PARA EL MEJOR CACHORRO SEXO OPUESTO
            $mejorCachorroSexoOpuesto = Juez::mejorCategoria($evento_id, $pista, $ra->raza_id, 'sexo_opuesto_cachorro');

            //PARA EL MEJOR JOVEN
            $mejorJoven = Juez::mejorCategoria($evento_id, $pista, $ra->raza_id, 'mejor_joven');

            //PARA EL MEJOR JOVEN SEXO OPUESTO
            $mejorJovenSexoOpuesto = Juez::mejorCategoria($evento_id, $pista, $ra->raza_id, 'sexo_opuesto_joven');

            
            //PARA EL MEJOR RAZA
            $mejorRaza = Juez::mejorCategoria($evento_id, $pista, $ra->raza_id, 'mejor_raza');
            
            //PARA EL MEJOR RAZA SEXO OPUESTO
            $mejorRazaSexoOpuesto = Juez::mejorCategoria($evento_id, $pista, $ra->raza_id, 'sexo_opuesto_raza');


            $raza = array(
                'nombre'                    => $ra->raza->nombre,
                'mejorCachoro'              => $mejorCachorro,
                'mejorCachoroSexoOpuesto'   => $mejorCachorroSexoOpuesto,
                
                'mejorJoven'                => $mejorJoven,
                'mejorJovenSexoOpuesto'     => $mejorJovenSexoOpuesto,
                
                'mejorRaza'                 => $mejorRaza,
                'mejorRazaSexoOpuesto'      => $mejorRazaSexoOpuesto
            );

            array_push($ejemplares, $raza);
        }


        // BUSCAMOS PARA LOS ESPECIALES
        $primeroEspecial = Evento::ganadoresBesting($evento_id, $pista,'especiales',1);
        $segundoEspecial = Evento::ganadoresBesting($evento_id, $pista,'especiales',2);
        $tercerEspecial = Evento::ganadoresBesting($evento_id, $pista,'especiales',3);
        $cuartoEspecial = Evento::ganadoresBesting($evento_id, $pista,'especiales',4);
        $quintoEspecial = Evento::ganadoresBesting($evento_id, $pista,'especiales',5);
        
        $arrarEspeciales = array(
            'primero' => $primeroEspecial,
            'segundo' => $segundoEspecial,
            'tercer' => $tercerEspecial,
            'cuarto' => $cuartoEspecial,
            'quinto' => $quintoEspecial
        );
        
        // PARA LOS ABSOLUTOS
        $primeroAbsoluto = Evento::ganadoresBesting($evento_id, $pista,'absolutos',1);
        $segundoAbsoluto = Evento::ganadoresBesting($evento_id, $pista,'absolutos',2);
        $tercerAbsoluto = Evento::ganadoresBesting($evento_id, $pista,'absolutos',3);
        $cuartoAbsoluto = Evento::ganadoresBesting($evento_id, $pista,'absolutos',4);
        $quintoAbsoluto = Evento::ganadoresBesting($evento_id, $pista,'absolutos',5);
        
        $arrarAbsoluto = array(
            'primero' => $primeroAbsoluto,
            'segundo' => $segundoAbsoluto,
            'tercer' => $tercerAbsoluto,
            'cuarto' => $cuartoAbsoluto,
            'quinto' => $quintoAbsoluto
        );

        // PARA LOS ABSOLUTOS
        $primeroJoven = Evento::ganadoresBesting($evento_id, $pista,'jovenes',1);
        $segundoJoven = Evento::ganadoresBesting($evento_id, $pista,'jovenes',2);
        $tercerJoven = Evento::ganadoresBesting($evento_id, $pista,'jovenes',3);
        $cuartoJoven = Evento::ganadoresBesting($evento_id, $pista,'jovenes',4);
        $quintoJoven = Evento::ganadoresBesting($evento_id, $pista,'jovenes',5);
        
        $arrarJoven = array(
            'primero' => $primeroJoven,
            'segundo' => $segundoJoven,
            'tercer' => $tercerJoven,
            'cuarto' => $cuartoJoven,
            'quinto' => $quintoJoven
        );

        // PARA LOS ADULTOS
        $primeroAdulto = Evento::ganadoresBesting($evento_id, $pista,'adultos',1);
        $segundoAdulto = Evento::ganadoresBesting($evento_id, $pista,'adultos',2);
        $tercerAdulto = Evento::ganadoresBesting($evento_id, $pista,'adultos',3);
        $cuartoAdulto = Evento::ganadoresBesting($evento_id, $pista,'adultos',4);
        $quintoAdulto = Evento::ganadoresBesting($evento_id, $pista,'adultos',5);
        
        $arrarAdulto = array(
            'primero' => $primeroAdulto,
            'segundo' => $segundoAdulto,
            'tercer' => $tercerAdulto,
            'cuarto' => $cuartoAdulto,
            'quinto' => $quintoAdulto
        );
        
        return view('evento.ranking')->with(compact('evento', 'razas', 'ejemplares', 'primeroEspecial', 'arrarEspeciales', 'arrarAbsoluto', 'arrarJoven', 'arrarAdulto'));

    }

    public function habilitaEvento(Request $request){

        if($request->ajax()){

            $evento_id = $request->input('evento');

            $evento = Evento::find($evento_id);

            if($evento->habilitado == "No" || $evento->habilitado == null){
                $evento->habilitado = "Si";
            }else{
                $evento->habilitado = "No";
            }

            $evento->save();

            $data['status'] = 'success';
    
            return json_encode($data);

        }

    }

    public function clonarEvento(Request $request){

        $evento_id = $request->input('evento_id_clonar');

        $evento  = Evento::find($evento_id);

        // CREAMOS EL NUEVO EVENTO
        $eventoNuevo = new Evento();
        
        $eventoNuevo->nombre        = $request->input('nombre_clonar');
        $eventoNuevo->fecha_inicio  = $evento->fecha_inicio;
        $eventoNuevo->fecha_fin     = $evento->fecha_fin;
        $eventoNuevo->direccion     = $evento->direccion;
        $eventoNuevo->departamento  = $evento->departamento;
        $eventoNuevo->numero_pista  = $evento->numero_pista;
        $eventoNuevo->circuito      = $evento->circuito;
        $eventoNuevo->habilitado    = $evento->habilitado;
        $eventoNuevo->tipo_evento   = $request->input('radios3_1');

        $eventoNuevo->save();

        // AHORA VAMOS POR LOS INSCRITOS A UN EVENO
        $ejemplaresEventosInscritos = EjemplarEvento::where('evento_id',$evento->id)->get();

        foreach ($ejemplaresEventosInscritos as $ei){

            $ejemplar_evento = new EjemplarEvento();

            $ejemplar_evento->user_id               = Auth::user()->id;
            $ejemplar_evento->evento_id             = $eventoNuevo->id;

            $ejemplar_evento->ejemplar_id           = $ei->ejemplar_id;
            $ejemplar_evento->raza_id               = $ei->raza_id;
            $ejemplar_evento->categoria_pista_id    = $ei->categoria_pista_id;
            $ejemplar_evento->extrangero            = $ei->extrangero;
            $ejemplar_evento->codigo_nacionalizado  = $ei->codigo_nacionalizado;
            $ejemplar_evento->nombre_completo       = $ei->nombre_completo;
            $ejemplar_evento->color                 = $ei->color;
            $ejemplar_evento->tatuaje               = $ei->tatuaje;
            $ejemplar_evento->fecha_nacimiento      = $ei->fecha_nacimiento;
            $ejemplar_evento->sexo                  = $ei->sexo;
            $ejemplar_evento->chip                  = $ei->chip;
            $ejemplar_evento->kcb_padre             = $ei->kcb_padre;
            $ejemplar_evento->nombre_padre          = $ei->nombre_padre;
            $ejemplar_evento->kcb_madre             = $ei->kcb_madre;
            $ejemplar_evento->nombre_madre          = $ei->nombre_madre;
            $ejemplar_evento->criador               = $ei->criador;
            $ejemplar_evento->propietario           = $ei->propietario;
            $ejemplar_evento->ciudad                = $ei->ciudad;
            $ejemplar_evento->telefono              = $ei->telefono;
            $ejemplar_evento->email                 = $ei->email;
            $ejemplar_evento->edad                  = $ei->edad;
            $ejemplar_evento->carnet                = $ei->carnet;
            $ejemplar_evento->numero                = $ei->numero;
            $ejemplar_evento->numero_prefijo        = $ei->numero_prefijo;
            $ejemplar_evento->estado                = $ei->estado;

            $ejemplar_evento->save();

        }

        return redirect('Evento/listado');
    }

    public function jucesEvento(Request $request){

        if($request->ajax()){

            $evento_id = $request->input('evento');

            $asignaciones  = Asignacion::where('evento_id',$evento_id)
                                        ->get();

            $select = "<select class='form-control' name='buscar_ejemplares' id='buscar_ejemplares' onchange='buscaEjemplaresCalificados()'>";
            $selectBody = "<option value=''>Seleccione el juez</option>";
            $selectFin = "</select>";

            foreach ($asignaciones as $as){
                $selectBody = $selectBody."<option value='".$as->id."'>".$as->juez->nombre."</option>";
            }   

            $data['status'] = 'success';
            $data['select'] = $select.$selectBody.$selectFin;

            return json_encode($data);

        }
        
    }

    public function listadoEjemplaresCalificados(Request $request){

        if($request->ajax()){

            $asignacion_id = $request->input('asiganacion');

            $asignacion = Asignacion::find($asignacion_id);

            if($asignacion){
                $num_pista = $asignacion->num_pista;

                $ejemplaresEventos = EjemplarEvento::where('evento_id',$asignacion->evento_id)
                                                    ->orderBy('numero_prefijo', 'asc')
                                                    ->get();
            }else{
                $ejemplaresEventos = [];   
                $num_pista = 0;
            }


            $data['status'] = 'success';

            $data['listado'] = view('evento.ajaxListadoEjemplaresEventos', compact('ejemplaresEventos', 'asignacion', 'num_pista'))->render();

            return json_encode($data);

        }

    }

}
