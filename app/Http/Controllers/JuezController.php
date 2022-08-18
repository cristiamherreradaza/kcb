<?php

namespace App\Http\Controllers;

use PDF;
use App\Juez;
use App\Raza;
use App\Grupo;

use App\Evento;
use App\Besting;
use App\Ganador;
use App\GrupoRaza;
use App\Asignacion;
use App\Calificacion;
use App\CategoriaJuez;
use App\EjemplarEvento;

use App\CategoriasPista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class JuezController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listado(Request $request){

        $jueces = Juez::all();
        
        // LISTAMOS LAS CATEGORIAS
        $categoriaJuez = CategoriaJuez::all();

        return view('juez.listado')->with(compact('jueces', 'categoriaJuez'));
    }

    public function guarda(Request $request){

        $juez_id = $request->input('juez_id');

        if($juez_id == 0 ){
            $juez = new Juez();
        }else{
            $juez = Juez::find($juez_id);
        }

        $juez->user_id                  = Auth::user()->id;
        $juez->nombre                   = $request->input('nombre');
        $juez->email                    = $request->input('email');
        $juez->categoria_juez_id        = $request->input('categoria_juez_id');
        $juez->departamento             = $request->input('departamento');

        if($request->file('imgInp')){

            // subiendo el archivo al servidor
            $archivo    = $request->file('imgInp');

            $direcion   = "imagenesJueces/";
            $nombreArchivo = date('YmdHis').".".$archivo->getClientOriginalExtension();
            $archivo->move($direcion,$nombreArchivo);

            $juez->foto             = $nombreArchivo;

        }

        // esto es para la firma digital de los secretarios
        if($request->file('firma_digital')){
            
            // subiendo el archivo al servidor
            $archivo    = $request->file('firma_digital');

            $direcion   = "imagenesFirmaJuezSecre/";
            $nombreArchivo = date('YmdHis').".".$archivo->getClientOriginalExtension();
            $archivo->move($direcion,$nombreArchivo);

            $juez->estado    = $nombreArchivo;

        }

        $juez->save();

        return redirect('Juez/listado');
    }

    public function elimina(Request $request, $juez_id){

        Juez::destroy($juez_id);
        
        return redirect('Juez/listado');
    }

    public function ajaxguardaAsignacionEvento(Request $request){

        $tipo = $request->input('tipo_asignacion');

        if($tipo == "pista")
            $sw  = true;
        else
            $sw  = false;


        $asignacion = new  Asignacion();

        $asignacion->user_id        = Auth::user()->id;
        $asignacion->juez_id        = $request->input('juez_id');
        $asignacion->secretario_id  = $request->input('secretario_id');
        $asignacion->evento_id      = $request->input('asignacion_evento_id');

        if($sw){
            $asignacion->estado         = 1;
            $asignacion->num_pista      = $request->input('num_pista');
        }else{
            $asignacion->estado         = 2;

            $asignacion->grupos = json_encode($request->input('grupos'));
        }


        $asignacion->save();

        $evento_id = $request->input('asignacion_evento_id');
        
        $asiganaciones  = Asignacion::where('evento_id',$evento_id)->get();


        // AQUI AREMOS APRA CONTAR
        $evento = Evento::find($evento_id);

        $numero_pistas_evento = $evento->numero_pista;

        $cantidadAsiganacionesEvento = Asignacion::where('evento_id', $evento_id)->count();
        
        $faltantes = intval($numero_pistas_evento) - intval($cantidadAsiganacionesEvento);

        // VERIFICAMOS QUE TIPO DE ASIGNACION ES
        if(count($asiganaciones) != 0 ){
        
            if($asiganaciones[0]->estado == 1)
                $data['tipo'] = 'pista';
            else
                $data['tipo'] = 'grupo';

        }else{

            $data['tipo'] = 'vacio';

        }

        $data['listado'] = view('evento.ajaxListadoAsignacion', compact('asiganaciones', 'faltantes'))->render();
        $data['cantAsignaciones'] = $faltantes;
        $data['status'] = 'success';

        return json_encode($data);
    }

    public function ajaxListadoAsignacion(Request $request){

        $evento_id = $request->input('evento_id');

        $asiganaciones  = Asignacion::where('evento_id', $evento_id)->get();

        // AQUI AREMOS APRA CONTAR
        $evento = Evento::find($evento_id);

        $numero_pistas_evento = $evento->numero_pista;

        $cantidadAsiganacionesEvento = Asignacion::where('evento_id', $evento_id)->count();

        $faltantes = intval($numero_pistas_evento) - intval($cantidadAsiganacionesEvento);

        // MANDAMOS LOS GROPOS DEL EVENTO
        $grupos = Juez::getGruposParticipantes($evento_id);

        if($cantidadAsiganacionesEvento != 0){

            if($asiganaciones[0]->estado == 1)
                $data['tipo'] = 'pista';
            else
                $data['tipo'] = 'grupo';

        }else{
            $data['tipo'] = 'vacio';
        }

        $data['listado'] = view('evento.ajaxListadoAsignacion', compact('asiganaciones', 'faltantes'))->render();
        $data['cantAsignaciones'] = $faltantes;
        $data['grupos'] = $grupos;
        $data['status'] = 'success';

        return json_encode($data);

    }

    public function ajaxEliminaAsignacion(Request $request){

        $asignacion_id = $request->input('asignacion_id');

        $evento_id = Asignacion::find($asignacion_id)->evento_id;

        Asignacion::destroy($asignacion_id);

        $asiganaciones  = Asignacion::where('evento_id',$evento_id)->get();

        // AQUI AREMOS APRA CONTAR
        $evento = Evento::find($evento_id);

        $numero_pistas_evento = $evento->numero_pista;

        $cantidadAsiganacionesEvento = Asignacion::where('evento_id', $evento_id)->count();

        $faltantes = intval($numero_pistas_evento) - intval($cantidadAsiganacionesEvento);

        if($cantidadAsiganacionesEvento != 0){

            if($asiganaciones[0]->estado == 1)
                $data['tipo'] = 'pista';
            else
                $data['tipo'] = 'grupo';

        }else{
            $data['tipo'] = 'vacio';
        }
 
        $data['listado'] = view('evento.ajaxListadoAsignacion', compact('asiganaciones', 'faltantes'))->render();
        $data['cantAsignaciones'] = $faltantes;
        $data['status'] = 'success';
 
        return json_encode($data);

    }

    public function calificacion(Request $request){

        $user_id = Auth::user()->id;

        $asignaciones = Asignacion::where('secretario_id',$user_id)->get();

        $cantidadAsignaciones = Asignacion::where('secretario_id',$user_id)->count();

        return view('juez.calificacion')->with(compact('asignaciones','cantidadAsignaciones'));

    }

    public function ponderacion(Request $request, $evento_id, $grupo_id, $raza_id){

        $raza = Raza::find($raza_id);

        $cachorros = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('raza_id',$raza_id)
                                    ->WhereIn('categoria_pista_id',[1,2,11])
                                    ->get();

        $jovenes = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('raza_id',$raza_id)
                                    ->WhereIn('categoria_pista_id',[3,4])
                                    ->get();

        $jovenesCampeones = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('raza_id',$raza_id)
                                    ->WhereIn('categoria_pista_id',[12,13])
                                    ->get();

        $intermedia = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('raza_id',$raza_id)
                                    ->WhereIn('categoria_pista_id',[5,6])
                                    ->get();

        $abiertas = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('raza_id',$raza_id)
                                    ->WhereIn('categoria_pista_id',[7,8])
                                    ->get();

        $campeones = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('raza_id',$raza_id)
                                    ->WhereIn('categoria_pista_id',[9,10])
                                    ->get();

        $GranCampeones = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('raza_id',$raza_id)
                                    ->WhereIn('categoria_pista_id',[14,15])
                                    ->get();

        $veteranos = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('raza_id',$raza_id)
                                    ->WhereIn('categoria_pista_id',[16,17])
                                    ->get();

        $array_categorias = array();

        if(count($cachorros) != 0){
            array_push($array_categorias, $cachorros);
        }

        if(count($jovenes) != 0){
            array_push($array_categorias, $jovenes);
        }

        if(count($jovenesCampeones) != 0){
            array_push($array_categorias, $jovenesCampeones);
        }

        if(count($intermedia) != 0){
            array_push($array_categorias, $intermedia);
        }

        if(count($abiertas) != 0){
            array_push($array_categorias, $abiertas);
        }

        if(count($campeones) != 0){
            array_push($array_categorias, $campeones);
        }

        if(count($GranCampeones) != 0){
            array_push($array_categorias, $GranCampeones);
        }

        if(count($veteranos) != 0){
            array_push($array_categorias, $veteranos);
        }

        $evento = Evento::find($evento_id);

        return view('juez.ponderacion')->with(compact('array_categorias', 'evento', 'grupo_id', 'raza'));
    }

    public function guardaPonderacion(Request $request){

        $inscripcion_id = $request->input('ejemplar_evento');

        $inscripcion = EjemplarEvento::find($inscripcion_id);

        $calificaciones = Calificacion::where('evento_id',$inscripcion->evento_id)
                                        // ->where('inscripcion_id',$inscripcion_id)
                                        ->where('raza_id',$inscripcion->raza_id)
                                        ->where('calificacion', $request->input('calificacion'))
                                        ->where('lugar', $request->input('lugar'))
                                        ->count();

        if($calificaciones != 0){
         
            return trigger_error("1", E_USER_ERROR);
            
        }


        if($inscripcion){

            $calificacion = new  Calificacion();

            $calificacion->creador_id       = Auth::user()->id;
            $calificacion->evento_id        = $inscripcion->evento_id;

            $juez = Asignacion::where('evento_id',$inscripcion->evento_id)
                                ->where('secretario_id',Auth::user()->id)
                                ->first();

            if($juez){

                $calificacion->juez_id    = $juez->juez_id;

            }
            
            $calificacion->secretario_id    = Auth::user()->id;
            $calificacion->ejemplar_id      = $inscripcion->ejemplar_id;
            $calificacion->raza_id          = $inscripcion->raza_id;
            $calificacion->categoria_id     = $inscripcion->categoria_pista_id;
            $calificacion->inscripcion_id   = $inscripcion_id;

            $grupoRazao = GrupoRaza::where('raza_id',$inscripcion->raza_id)->first();

            if($grupoRazao){

                $calificacion->grupo            = $grupoRazao->grupos->nombre;
                $calificacion->grupo_id         = $grupoRazao->grupos->id;

            }

            $calificacion->sexo                 = $inscripcion->sexo;
            $calificacion->calificacion         = $request->input('calificacion');
            $calificacion->lugar                = $request->input('lugar');

            $calificacion->save();

        }

    }

    public function grupos(Request $request, $evento_id){
        
        $grupos = DB::table('ejemplares_eventos')
                ->join('grupos_razas', 'ejemplares_eventos.raza_id', '=', 'grupos_razas.raza_id')
                ->select('grupos_razas.grupo_id as id', 'ejemplares_eventos.evento_id')
                ->where('ejemplares_eventos.evento_id',$evento_id)
                ->groupBy('grupos_razas.grupo_id')
                ->get();

        return view('juez.grupos')->with(compact('grupos'));
    }

    public function razas(Request $request, $evento_id, $grupo_id){

        $razas = DB::table('ejemplares_eventos')
                ->join('grupos_razas', 'ejemplares_eventos.raza_id', '=', 'grupos_razas.raza_id')
                ->select('grupos_razas.raza_id as id')
                ->where('ejemplares_eventos.evento_id',$evento_id)
                ->where('grupos_razas.grupo_id',$grupo_id)
                ->groupBy('ejemplares_eventos.raza_id')
                ->get();

        return view('juez.razas')->with(compact('razas','grupo_id','evento_id'));
    }

    public function categorias(Request $request, $evento_id, $asignacion_id){

        $evento = Evento::find($evento_id);

        // MANDAMOS LA ASIGNACION
        $asignacion = Asignacion::find($asignacion_id);

        $arrayEjemplares = array();
        $arrayEjemplaresTotal = array();

        if($asignacion->estado == 1){
    
            for($i = 1; $i <= 10 ; $i++){
    
                $emplares = Juez::ejemplaresGrupos($evento_id, $i);
    
                $arrayEjemplares = array(
                    'grupo' => 'Grupo '.$i,
                    'ejemplares' => $emplares
                );
    
                array_push($arrayEjemplaresTotal,$arrayEjemplares);
    
            }

        }else{

            $grupos = json_decode($asignacion->grupos);

            foreach ($grupos as $g){

                $ejemplares = Juez::ejemplaresGrupos($evento_id, $g);

                $arrayEjemplares = array(
                                    'grupo' => 'Grupo '.$g,
                                    'ejemplares' => $ejemplares
                                );

                array_push($arrayEjemplaresTotal,$arrayEjemplares);

            }

        }
        

        return view('juez.categorias')->with(compact('evento', 'arrayEjemplaresTotal', 'asignacion'));
    }

    public function ajaxFinalizarCalificacion(Request $request){

        // dd($request->all());

        $ejemplares_eventos = $request->input('ejemplar_evento_id_ejemplar');
        $raza_id            = $request->input('raza_id_ejemplar');
        $evento_id          = $request->input('evento_id_ejemplar');
        $categoria_id       = $request->input('categoria_id_ejemplar');
        $sexo               = $request->input('sexo_ejemplar');
        $numero_prefijos    = $request->input('numero_prefijo_ejemplar');
        $calificaciones     = $request->input('calificacion_ejemplar');
        $lugares            = $request->input('lugar_ejemplar');
        $ejemplares         = $request->input('ejemplar_id_ejemplar');
        $grupo              = $request->input('grupo_id');
        $num_pista          = $request->input('num_pista');

        $categoria = CategoriasPista::find($categoria_id)[0]->nombre;

        // dd($ejemplares_eventos, $calificaciones, $lugares, $categoria_id[0]);
        
        // verificamos si las calificaciones o el lugar esta repoedido 
        $valida = $this->validaCalificaciones($ejemplares_eventos, $calificaciones, $lugares);

        $arrayRepetidos = array();
        $arrayMejorEjemplar = array();

        if($valida['status']){

            $ganadorUnico = null;
            $swunico = true;

            foreach ($ejemplares_eventos as $key => $e){

                $cantidadEjemplarRepetido = Juez::verificaEjemplar(intval($e), $categoria_id[0], $numero_prefijos[$key], $num_pista);

                if($cantidadEjemplarRepetido == 0){

                    $calificacion = new  Calificacion();
        
                    $calificacion->creador_id               = Auth::user()->id;
                    $calificacion->ejemplares_eventos_id    = intval($e);
                    $calificacion->evento_id                = $evento_id[0];

                    $asignacion =  Juez::getJuezSecreEvento($evento_id[0], Auth::user()->id);

                    $calificacion->juez_id                  = $asignacion->juez_id;
                    $calificacion->secretario_id            = Auth::user()->id;
                    $calificacion->ejemplar_id              = $ejemplares[$key];
                    $calificacion->raza_id                  = $raza_id[0];
                    $calificacion->categoria_id             = $categoria_id[0];
                    $calificacion->sexo                     = $sexo[0];
                    $calificacion->grupo_id                 = $grupo[0];
                    $calificacion->numero_prefijo           = $numero_prefijos[$key];
                    $calificacion->calificacion             = $calificaciones[$key];
                    $calificacion->lugar                    = $lugares[$key];
                    $calificacion->pista                    = $num_pista;
        
                    $calificacion->save();

                    $ganador = null;

                }else{

                    // MODIFICAMOS LOS DATOS SI ES QUE YA ESTAN CALIFICADOS
                    $calificacion = Juez::getCalificacion(intval($e), $num_pista, $numero_prefijos[$key], $evento_id);

                    $calificacion->calificacion = $calificaciones[$key];
                    $calificacion->lugar        = $lugares[$key];

                    $calificacion->save();

                    // aqui eliminamos de la tabla ganadores
                    $ganador = Juez::getGanador($calificacion->id);

                    if($ganador)
                        $ganadorUnico = $ganador;

                    array_push($arrayRepetidos,intval($e));
                }

                if($calificaciones[$key] == "Excelente" && $lugares[$key] == 1){

                    $arrayMejorEjemplar = array(

                        'calificacion_id'       => $calificacion->id,
                        'ejemplar_id'           => $ejemplares[$key],
                        'evento_id'             => $evento_id[0],
                        'ejemplar_evento_id'    => intval($e),
                        'categoria_id'          => $categoria_id[0],
                        'numero_prefijo'        => $numero_prefijos[$key],
                        'calificacion'          => $calificaciones[$key],
                        'raza'                  => $raza_id[0],
                        'sexo'                  => $sexo[0],
                        'grupo'                 => $grupo[0],
                        'lugar'                 => $lugares[$key],
                        'pista'                 => $num_pista

                    );

                }

            }

            // preguntamos si hay mejor de la categoria y agregamos al mejor
            if(count($arrayMejorEjemplar) > 0){

                // dd($ganador);

                if($ganadorUnico)
                    $ganador = Ganador::find($ganadorUnico->id);
                else
                    $ganador = new Ganador();


                $ganador->creador_id            = Auth::user()->id;
                $ganador->calificacion_id       = $arrayMejorEjemplar['calificacion_id'];
                $ganador->ejemplar_id           = $arrayMejorEjemplar['ejemplar_id'];
                $ganador->evento_id             = $arrayMejorEjemplar['evento_id'];
                $ganador->ejemplar_evento_id    = $arrayMejorEjemplar['ejemplar_evento_id'];
                $ganador->categoria_id          = $arrayMejorEjemplar['categoria_id'];
                $ganador->raza_id               = $arrayMejorEjemplar['raza'];
                $ganador->grupo_id              = $arrayMejorEjemplar['grupo'];
                $ganador->sexo                  = $arrayMejorEjemplar['sexo'];
                $ganador->numero_prefijo        = $arrayMejorEjemplar['numero_prefijo'];
                $ganador->calificacion          = $arrayMejorEjemplar['calificacion'];
                $ganador->lugar                 = $arrayMejorEjemplar['lugar'];
                $ganador->pista                 = $arrayMejorEjemplar['pista'];

                if($ganador->categoria_id == 5 || $ganador->categoria_id == 6 || $ganador->categoria_id == 7 || $ganador->categoria_id == 8)
                    $ganador->estado                = 0;
                else
                    $ganador->estado                = 1;
                

                $ganador->save();

                $ganadorConfir = true;

                // pra las categorias abiertas e intermedi
                if($ganador->categoria_id == 5 || $ganador->categoria_id == 6 || $ganador->categoria_id == 7 || $ganador->categoria_id == 8){
                    $data['intercambioCertificado'] = $ganador->id;
                    $swCambioCertificado = true;
                }else{
                    $data['intercambioCertificado'] = false;
                    $swCambioCertificado = false;
                }
                                        
                $data['ganadorhtml'] = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>'.(($swCambioCertificado)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador->numero_prefijo.'</td>
                                                    <td>'.$ganador->calificacion.'</td>
                                                    <td>'.$ganador->lugar.'</td>
                                                    '.(($swCambioCertificado)? '
                                                        <td>
                                                            <select id="puntos_calificados_'.$ganador->id.'" name="puntos_calificados_'.$ganador->id.'" class="form-control">
                                                                <option value="">Seleccione</option>                                                            
                                                                <option value="1">1</option>                                                            
                                                                <option value="2">2</option>                                                            
                                                                <option value="3">3</option>                                                            
                                                                <option value="4">4</option>                                                            
                                                                <option value="5">5</option>                                                            
                                                            </select>
                                                        </td>
                                                    ' : '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador->id.'">
                                                                '.(($swCambioCertificado)? '
                                                                    <input type="radio" id="darCertificacion_'.$ganador->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador->id.',[0])"/>
                                                                ' : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador->id.'" '.(($swCambioCertificado)? 'style="display: none"' : '').'>
                                                                '.
                                                                ((true)? '
                                                                    <button name="" id="button_escogeMejor_'.$ganador->id.'" onclick="escogerMejor('.$ganador->id.','."'".$ganador->numero_prefijo."'".','.json_encode([$ganador->id]).')" class="btn btn-success btn-icon btn-sm"><i class="fa fa-check"></i></button>
                                                                ' : '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

                // $data['categoria'] = str_replace(['(',')',' '],'',$categoria);

                $data['gandadorActivo'] = $ganador->id;
                
            }else{

                if($ganador)
                    Ganador::destroy($ganador->id);

                $data['ganadorhtml'] = '';


                $ganadorConfir = false;

            }

            $data['categoria'] = str_replace(['(',')',' '],'',$categoria);
            

            $data['status'] = 'success';
            $data['ganador'] = $ganadorConfir;

        }else{

            $data['status']             = 'error';
            $data['ejemplar_evento_id'] = $valida['ejemplar_evento_id'];

        }

        $data['ejemplar_enviados'] = $valida['ejemplar_enviados'];

        return json_encode($data);

    }

    public static function validaCalificaciones($ejemplares_eventos, $calificaciones, $lugares){

        $arrayEjemplaresRepetidos = array();
        $arrayCalificaciones = array();
        $arrayEjemplaresEnviados = array();

        $data['status'] = true;

        foreach ($ejemplares_eventos as $key => $eje){

            array_push($arrayEjemplaresEnviados, $eje);
            
            $datos = $calificaciones[$key].$lugares[$key];

            if(!in_array($datos, $arrayCalificaciones)){

                array_push($arrayCalificaciones, $datos);

            }else{

                $data['status'] = false;

                array_push($arrayEjemplaresRepetidos, $eje);

            }

        }

        $data['ejemplar_evento_id'] = $arrayEjemplaresRepetidos;
        $data['ejemplar_enviados'] = $arrayEjemplaresEnviados;

        return $data;
    }

    public function ajaxCategoriasCalificacion(Request $request){

        $categorias = $request->input('categorias');
        $raza_id    = $request->input('raza');
        $evento_id  = $request->input('evento');
        $num_pista  = $request->input('pista');

        $tablePrincipal = '';
        $data['tables'] = '';

        $cantidadCategorias = count($categorias);

        $arrayGanadores = array();

        if($cantidadCategorias == 1){
            
            // PREGUNTAMOS POR EL GANADOR
            $ganador = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[0]['categoria_id'], $raza_id, $num_pista);

            // dd($ganador);

            $sw = true;
            if($ganador){
                if($ganador->mejor_escogido == "Si"){
                    $sw = false;
                }
            }

            // para los bloqueos de BOTONES
            if($ganador)
                array_push($arrayGanadores, $ganador->id);

            // PARA LOS INTERMEDIA Y LOS ABIERTAS
            $arrayAbiertaIntermedia = array();    
            $swg1 = false;

            if($ganador){
                if($ganador->categoria_id == 5 || $ganador->categoria_id == 6 || $ganador->categoria_id == 7 || $ganador->categoria_id == 8){
                    $swg1 = true;
                    array_push($arrayAbiertaIntermedia, $ganador->id);
                }
            }



            $tableGanador = '';

            if($ganador){

                $tableGanador = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg1)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador->numero_prefijo.'</td>
                                                    <td>'.$ganador->calificacion.'</td>
                                                    <td>'.$ganador->lugar.'</td>
                                                    '.(($swg1)? '
                                                    <td>
                                                        <select name="puntos_calificados_'.$ganador->id.'" id="puntos_calificados_'.$ganador->id.'" class="form-control">
                                                            <option value="">Seleccione</option>
                                                            <option '.(($ganador->puntos == 1)? 'selected' : '').' value="1">1</option>
                                                            <option '.(($ganador->puntos == 2)? 'selected' : '').' value="2">2</option>
                                                            <option '.(($ganador->puntos == 3)? 'selected' : '').' value="3">3</option>
                                                            <option '.(($ganador->puntos == 4)? 'selected' : '').' value="4">4</option>
                                                            <option '.(($ganador->puntos == 5)? 'selected' : '').' value="5">5</option>
                                                        </select>
                                                    </td>
                                                    ' : '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador->id.'" '.(($ganador->estado == 1)? 'style="display: none"' : '').'>
                                                            '.((($ganador->categoria_id == 5 || $ganador->categoria_id == 6 || $ganador->categoria_id == 7 || $ganador->categoria_id == 8))?
                                                                '<input type="radio" id="darCertificacion_'.$ganador->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador->id.','.json_encode($arrayAbiertaIntermedia).')"/>'
                                                                : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador->id.'" '.(($ganador->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button id="button_escogeMejor_'.$ganador->id.'" onclick="escogerMejor('.$ganador->id.','."'".$ganador->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>
                                                                ': '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }

            $columna = 'class="col-md-12"';

            $data['divGanadoresCategorias'] = '<div class="row">
                                                    <div class="col-md-12">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[0]['nombre']).'"  '.(($ganador == null)? 'style="display: none;"' : '' ).' >
                                                            '.$tableGanador.'
                                                        </div>
                                                    </div>
                                                </div>';
        }elseif($cantidadCategorias == 2){

            // PREGUNTAMOS POR EL GANADOR
            // PARA EL GANADOR 1
            $ganador1 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[0]['categoria_id'], $raza_id, $num_pista);

            // PARA EL GANADOR 2
            $ganador2 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[1]['categoria_id'], $raza_id, $num_pista);

            // PARA LOS botones
            $sw = true;
            if($ganador1 && $ganador2){
                if($ganador2->mejor_escogido == "Si" || $ganador1->mejor_escogido == "Si"){
                    $sw = false; 
                }
            }

            // PARA LOS BOTNES DE BLOQUEO
            if($ganador1)
                array_push($arrayGanadores, $ganador1->id);

            if($ganador2)
                array_push($arrayGanadores, $ganador2->id);


            // PARA LOS INTERMEDIA Y LOS ABIERTAS
            $arrayAbiertaIntermedia = array();    
            $swg1 = false;
            $swg2 = false;

            if($ganador1){
                if($ganador1->categoria_id == 5 || $ganador1->categoria_id == 6 || $ganador1->categoria_id == 7 || $ganador1->categoria_id == 8){
                    $swg1 = true;
                    array_push($arrayAbiertaIntermedia, $ganador1->id);
                }
            }

            if($ganador2){
                if($ganador2->categoria_id == 5 || $ganador2->categoria_id == 6 || $ganador2->categoria_id == 7 || $ganador2->categoria_id == 8){
                    $swg2 = true;
                    array_push($arrayAbiertaIntermedia, $ganador2->id);
                }
            }


            // PARA EL GANADOR 1
            $tableGanador1 = '';

            if($ganador1){

                $tableGanador1 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg1)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador1->numero_prefijo.'</td>
                                                    <td>'.$ganador1->calificacion.'</td>
                                                    <td>'.$ganador1->lugar.'</td>
                                                    '.(($swg1)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador1->id.'" id="puntos_calificados_'.$ganador1->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador1->puntos == 1)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador1->puntos == 2)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador1->puntos == 3)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador1->puntos == 4)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador1->puntos == 5)? 'selected' : '').' value="5">5</option>
                                                            </select>
                                                        </td>
                                                    ' : '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador1->id.'" '.(($ganador1->estado == 1)? 'style="display: none";' : '').'>
                                                                '.((($ganador1->categoria_id == 5 || $ganador1->categoria_id == 6 || $ganador1->categoria_id == 7 || $ganador1->categoria_id == 8))?
                                                                    '<input type="radio" id="darCertificacion_'.$ganador1->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador1->id.','.json_encode($arrayAbiertaIntermedia).')"/>'
                                                                    : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador1->id.'" '.(($ganador1->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button  id="button_escogeMejor_'.$ganador1->id.'"  onclick="escogerMejor('.$ganador1->id.','."'".$ganador1->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>
                                                                ' : '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }


            // PARA EL GANADOR 2
            $tableGanador2 = '';

            if($ganador2){

                $tableGanador2 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg2)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador2->numero_prefijo.'</td>
                                                    <td>'.$ganador2->calificacion.'</td>
                                                    <td>'.$ganador2->lugar.'</td>
                                                    '.(($swg2)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador2->id.'" id="puntos_calificados_'.$ganador2->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador2->puntos == 1)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador2->puntos == 2)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador2->puntos == 3)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador2->puntos == 4)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador2->puntos == 5)? 'selected' : '').' value="5">5</option>
                                                            </select>
                                                        </td>
                                                    ' : '').
                                                    '<td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador2->id.'" '.(($ganador2->estado == 1)? 'style="display: none"' : '').'>
                                                                '.((($ganador2->categoria_id == 5 || $ganador2->categoria_id == 6 || $ganador2->categoria_id == 7 || $ganador2->categoria_id == 8))?
                                                                '<input type="radio" id="darCertificacion_'.$ganador2->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador2->id.','.json_encode($arrayAbiertaIntermedia).')"/>'
                                                                : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador2->id.'" '.(($ganador2->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button  id="button_escogeMejor_'.$ganador2->id.'"  onclick="escogerMejor('.$ganador2->id.','."'".$ganador2->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>
                                                                ' : '').'                                                                
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>'
                                        ;
            }

            $columna = 'class="col-md-6"';

            $data['divGanadoresCategorias'] = '<div class="row">
                                                    <div class="col-md-6">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[0]['nombre']).'" '.(($ganador1 == null)? 'style="display: none;"' : '' ).'>
                                                            '.$tableGanador1.'
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[1]['nombre']).'" '.(($ganador2 == null)? 'style="display: none;"' : '' ).'>
                                                            '.$tableGanador2.'
                                                        </div>
                                                    </div>
                                                </div>';
        }elseif($cantidadCategorias == 3){

            // PREGUNTAMOS POR EL GANADOR
            // PARA EL GANADOR 1
            $ganador1 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[0]['categoria_id'], $raza_id, $num_pista);

            // PARA EL GANADOR 2
            $ganador2 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[1]['categoria_id'], $raza_id, $num_pista);

            // PARA EL GANADOR 3
            $ganador3 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[2]['categoria_id'], $raza_id, $num_pista);

            // PARA LOS botones
            $sw = true;
            if($ganador1 && $ganador2 && $ganador3){
                if($ganador2->mejor_escogido == "Si" || $ganador1->mejor_escogido == "Si" || $ganador3->mejor_escogido == "Si"){
                    $sw = false; 
                }
            }
            
            // PARA LOS BOTNES DE BLOQUEO
            if($ganador1)
                array_push($arrayGanadores, $ganador1->id);

            if($ganador2)
                array_push($arrayGanadores, $ganador2->id);

            if($ganador3)
                array_push($arrayGanadores, $ganador3->id);


            // PARA LOS INTERMEDIA Y LOS ABIERTAS
            $arrayAbiertaIntermedia = array();    

            $swg1 = false;        
            $swg2 = false;        
            $swg3 = false;        

            if($ganador1){
                if($ganador1->categoria_id == 5 || $ganador1->categoria_id == 6 || $ganador1->categoria_id == 7 || $ganador1->categoria_id == 8){
                    array_push($arrayAbiertaIntermedia, $ganador1->id);
                    $swg1 = true;        
                }
            }

            if($ganador2){
                if($ganador2->categoria_id == 5 || $ganador2->categoria_id == 6 || $ganador2->categoria_id == 7 || $ganador2->categoria_id == 8){
                    array_push($arrayAbiertaIntermedia, $ganador2->id);
                    $swg2 = true;        
                }
            }

            if($ganador3){
                if($ganador3->categoria_id == 5 || $ganador3->categoria_id == 6 || $ganador3->categoria_id == 7 || $ganador3->categoria_id == 8){
                    array_push($arrayAbiertaIntermedia, $ganador3->id);
                    $swg3 = true;        
                }
            }

            

            // PARA EL GANADOR 1
            $tableGanador1 = '';

            if($ganador1){

                $tableGanador1 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg1)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador1->numero_prefijo.'</td>
                                                    <td>'.$ganador1->calificacion.'</td>
                                                    <td>'.$ganador1->lugar.'</td>
                                                    '.(($swg1)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador1->id.'" id="puntos_calificados_'.$ganador1->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador1->puntos == 1)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador1->puntos == 2)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador1->puntos == 3)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador1->puntos == 4)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador1->puntos == 5)? 'selected' : '').' value="5">5</option>
                                                            </select>
                                                        </td>
                                                    ' : '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador1->id.'" '.(($ganador1->estado == 1)? 'style="display: none;"' : '').'>
                                                                '.((($ganador1->categoria_id == 5 || $ganador1->categoria_id == 6 || $ganador1->categoria_id == 7 || $ganador1->categoria_id == 8))?
                                                                    '<input type="radio" id="darCertificacion_'.$ganador1->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador1->id.','.json_encode($arrayAbiertaIntermedia).')"/>'
                                                                    : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador1->id.'" '.(($ganador1->estado == 0)? 'style="display: none;"' : '').'>
                                                                '.(($sw)? '
                                                                    <button id="button_escogeMejor_'.$ganador1->id.'" onclick="escogerMejor('.$ganador1->id.','."'".$ganador1->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon btn-sm"><i class="fa fa-check"></i></button>
                                                                ' : '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }


            // PARA EL GANADOR 2
            $tableGanador2 = '';

            if($ganador2){

                $tableGanador2 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg2)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador2->numero_prefijo.'</td>
                                                    <td>'.$ganador2->calificacion.'</td>
                                                    <td>'.$ganador2->lugar.'</td>
                                                    '.(($swg2)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador2->id.'" id="puntos_calificados_'.$ganador2->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador2->puntos == 2)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador2->puntos == 3)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador2->puntos == 4)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador2->puntos == 5)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador2->puntos == 6)? 'selected' : '').' value="5">5</option>
                                                            </select>
                                                        </td>
                                                    ' : '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador2->id.'" '.(($ganador2->estado == 1)? 'style="display: none;"' : '').'>
                                                                '.(($sw)? '
                                                                    '.((($ganador2->categoria_id == 5 || $ganador2->categoria_id == 6 || $ganador2->categoria_id == 7 || $ganador2->categoria_id == 8))?
                                                                        '<input type="radio" id="darCertificacion_'.$ganador2->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador2->id.','.json_encode($arrayAbiertaIntermedia).')"/>' : '').'
                                                                ' : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador2->id.'" '.(($ganador2->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button onclick="escogerMejor('.$ganador2->id.','."'".$ganador2->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon btn-sm"><i class="fa fa-check"></i></button>
                                                                ' : '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }

            // PARA EL GANADOR 3
            $tableGanador3 = '';

            if($ganador3){

                $tableGanador3 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg3)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador3->numero_prefijo.'</td>
                                                    <td>'.$ganador3->calificacion.'</td>
                                                    <td>'.$ganador3->lugar.'</td>
                                                    '.(($swg3)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador3->id.'" id="puntos_calificados_'.$ganador3->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador3->puntos == 2)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador3->puntos == 3)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador3->puntos == 4)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador3->puntos == 5)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador3->puntos == 6)? 'selected' : '').' value="5">5</option>
                                                            </select>
                                                        </td>
                                                    ' : '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador3->id.'" '.(($ganador3->estado == 1)? 'style="display:none;"' : '').'>
                                                                '.((($ganador3->categoria_id == 5 || $ganador3->categoria_id == 6 || $ganador3->categoria_id == 7 || $ganador3->categoria_id == 8))?
                                                                    '<input type="radio" id="darCertificacion_'.$ganador3->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador3->id.','.json_encode($arrayAbiertaIntermedia).')"/>' : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador3->id.'" '.(($ganador3->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button onclick="escogerMejor('.$ganador3->id.','."'".$ganador3->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon btn-sm"><i class="fa fa-check"></i></button>
                                                                ': '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }

            // PREPARAMOS LOS TABLAS CON LOS COL
            $columna = 'class="col-md-4"';

            $data['divGanadoresCategorias'] = '<div class="row">
                                                    <div class="col-md-4">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[0]['nombre']).'"  '.(($ganador1 == null)? 'style="display: none;"' : '' ).'>
                                                            '.$tableGanador1.'
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[1]['nombre']).'"  '.(($ganador2 == null)? 'style="display: none;"' : '' ).'>
                                                            '.$tableGanador2.'
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[2]['nombre']).'"  '.(($ganador3 == null)? 'style="display: none;"' : '' ).'>
                                                            '.$tableGanador3.'
                                                        </div>
                                                    </div>
                                                </div>';
        }elseif($cantidadCategorias == 4){

            // PREGUNTAMOS POR EL GANADOR
            // PARA EL GANADOR 1
            $ganador1 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[0]['categoria_id'], $raza_id, $num_pista);
            
            // PARA EL GANADOR 2
            $ganador2 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[1]['categoria_id'], $raza_id, $num_pista);

            // PARA EL GANADOR 3
            $ganador3 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[2]['categoria_id'], $raza_id, $num_pista);

            // PARA EL GANADOR 4
            $ganador4 = Juez::getGanadoEventoSecretario($evento_id, Auth::user()->id, $categorias[3]['categoria_id'], $raza_id, $num_pista);

            // PARA LOS botones
            $sw = true;
            if($ganador1 && $ganador2 && $ganador3 && $ganador4){
                if($ganador2->mejor_escogido == "Si" || $ganador1->mejor_escogido == "Si" || $ganador3->mejor_escogido == "Si" || $ganador4->mejor_escogido == "Si"){
                    $sw = false; 
                }
            }

            // PARA LOS BOTNES DE BLOQUEO
            if($ganador1)
                array_push($arrayGanadores, $ganador1->id);

            if($ganador2)
                array_push($arrayGanadores, $ganador2->id);

            if($ganador3)
                array_push($arrayGanadores, $ganador3->id);

            if($ganador4)
                array_push($arrayGanadores, $ganador4->id);


            // PARA LOS INTERMEDIA Y LOS ABIERTAS
            $arrayAbiertaIntermedia = array();    

            $swg1 = false;        
            $swg2 = false;        
            $swg3 = false;        
            $swg4 = false;        

            if($ganador1){
                if($ganador1->categoria_id == 5 || $ganador1->categoria_id == 6 || $ganador1->categoria_id == 7 || $ganador1->categoria_id == 8){
                    array_push($arrayAbiertaIntermedia, $ganador1->id);
                    $swg1 = true;        
                }
            }

            if($ganador2){
                if($ganador2->categoria_id == 5 || $ganador2->categoria_id == 6 || $ganador2->categoria_id == 7 || $ganador2->categoria_id == 8){
                    array_push($arrayAbiertaIntermedia, $ganador2->id);
                    $swg2 = true;        
                }
            }

            if($ganador3){
                if($ganador3->categoria_id == 5 || $ganador3->categoria_id == 6 || $ganador3->categoria_id == 7 || $ganador3->categoria_id == 8){
                    array_push($arrayAbiertaIntermedia, $ganador3->id);
                    $swg3 = true;        
                }
            }

            if($ganador4){
                if($ganador4->categoria_id == 5 || $ganador4->categoria_id == 6 || $ganador4->categoria_id == 7 || $ganador4->categoria_id == 8){
                    array_push($arrayAbiertaIntermedia, $ganador4->id);
                    $swg4 = true;        
                }
            }

            // PARA EL GANADOR 1
            $tableGanador1 = '';

            if($ganador1){

                $tableGanador1 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg1)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador1->numero_prefijo.'</td>
                                                    <td>'.$ganador1->calificacion.'</td>
                                                    <td>'.$ganador1->lugar.'</td>
                                                    '.(($swg1)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador1->id.'" id="puntos_calificados_'.$ganador1->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador1->puntos == 1)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador1->puntos == 2)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador1->puntos == 3)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador1->puntos == 4)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador1->puntos == 5)? 'selected' : '').' value="5">5</option>
                                                            </select>
                                                        </td>
                                                    ': '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador1->id.'" '.(($ganador1->estado == 1)? 'style="display:none;"' : '').'>
                                                                '.((($ganador1->categoria_id == 5 || $ganador1->categoria_id == 6 || $ganador1->categoria_id == 7 || $ganador1->categoria_id == 8))?
                                                                '<input type="radio" id="darCertificacion_'.$ganador1->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador1->id.','.json_encode($arrayAbiertaIntermedia).')"/>' : '').'
                                                            </div>
                                                            <div class="col-md-6"  id="bloque_btn_escogeMejor_'.$ganador1->id.'" '.(($ganador1->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button onclick="escogerMejor('.$ganador1->id.','."'".$ganador1->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>
                                                                ' : '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }


            // PARA EL GANADOR 2
            $tableGanador2 = '';

            if($ganador2){

                $tableGanador2 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg2)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador2->numero_prefijo.'</td>
                                                    <td>'.$ganador2->calificacion.'</td>
                                                    <td>'.$ganador2->lugar.'</td>
                                                    '.(($swg2)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador2->id.'" id="puntos_calificados_'.$ganador2->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador2->puntos == 1)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador2->puntos == 2)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador2->puntos == 3)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador2->puntos == 4)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador2->puntos == 5)? 'selected' : '').' value="5">5</option>
                                                            </select>
                                                        </td>
                                                    ' : '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador2->id.'" '.(($ganador2->estado == 1)? 'style="display:none;"' : '').'>
                                                            '.(($sw)? '
                                                                '.((($ganador2->categoria_id == 5 || $ganador2->categoria_id == 6 || $ganador2->categoria_id == 7 || $ganador2->categoria_id == 8))?
                                                                '<input type="radio" id="darCertificacion_'.$ganador2->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador2->id.','.json_encode($arrayAbiertaIntermedia).')"/>' : '').'
                                                            ' : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador2->id.'" '.(($ganador2->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button onclick="escogerMejor('.$ganador2->id.','."'".$ganador2->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>
                                                                ' : '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }


            // PARA EL GANADOR 3
            $tableGanador3 = '';

            if($ganador3){

                $tableGanador3 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg3)? '
                                                        <th>Puntos</th>
                                                    ' : '').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador3->numero_prefijo.'</td>
                                                    <td>'.$ganador3->calificacion.'</td>
                                                    <td>'.$ganador3->lugar.'</td>
                                                    '.(($swg3)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador3->id.'" id="puntos_calificados_'.$ganador3->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador3->puntos == 1)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador3->puntos == 2)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador3->puntos == 3)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador3->puntos == 4)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador3->puntos == 5)? 'selected' : '').' value="5">5</option>
                                                            </select> 
                                                        </td>
                                                    ':'').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador3->id.'" '.(($ganador3->estado == 1)? 'style="display:none;"' : '').'>
                                                                '.((($ganador3->categoria_id == 5 || $ganador3->categoria_id == 6 || $ganador3->categoria_id == 7 || $ganador3->categoria_id == 8))?
                                                                '<input type="radio" id="darCertificacion_'.$ganador3->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador3->id.','.json_encode($arrayAbiertaIntermedia).')"/>' : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador3->id.'" '.(($ganador3->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button onclick="escogerMejor('.$ganador3->id.','."'".$ganador3->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>
                                                                ' : '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }


            // PARA EL GANADOR 4
            $tableGanador4 = '';

            if($ganador4){

                $tableGanador4 = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lug</th>
                                                    '.(($swg4)? '
                                                        <th>Lugar</th>  
                                                    ' :'').'
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>'.$ganador4->numero_prefijo.'</td>
                                                    <td>'.$ganador4->calificacion.'</td>
                                                    <td>'.$ganador4->lugar.'</td>
                                                    '.(($swg4)? '
                                                        <td>
                                                            <select name="puntos_calificados_'.$ganador4->id.'" id="puntos_calificados_'.$ganador4->id.'" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option '.(($ganador4->puntos == 1)? 'selected' : '').' value="1">1</option>
                                                                <option '.(($ganador4->puntos == 2)? 'selected' : '').' value="2">2</option>
                                                                <option '.(($ganador4->puntos == 3)? 'selected' : '').' value="3">3</option>
                                                                <option '.(($ganador4->puntos == 4)? 'selected' : '').' value="4">4</option>
                                                                <option '.(($ganador4->puntos == 5)? 'selected' : '').' value="5">5</option>
                                                            </select> 
                                                        </td>
                                                    ' : '').'
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-6" id="bloque_radio_escogeMejor_'.$ganador4->id.'" '.(($ganador4->estado == 1)? 'style="display:none;"' : '').'>
                                                                '.((($ganador4->categoria_id == 5 || $ganador4->categoria_id == 6 || $ganador4->categoria_id == 7 || $ganador4->categoria_id == 8))?
                                                                '<input type="radio" id="darCertificacion_'.$ganador4->id.'" name="darCertificacion" onclick="cambiaCertificado('.$ganador4->id.','.json_encode($arrayAbiertaIntermedia).')"/>' : '').'
                                                            </div>
                                                            <div class="col-md-6" id="bloque_btn_escogeMejor_'.$ganador4->id.'" '.(($ganador4->estado == 0)? 'style="display: none"' : '').'>
                                                                '.(($sw)? '
                                                                    <button onclick="escogerMejor('.$ganador4->id.','."'".$ganador4->numero_prefijo."'".', '.json_encode($arrayGanadores).')" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>
                                                                ' : '').'
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';

            }


            $columna = 'class="col-md-3"';

            $data['divGanadoresCategorias'] = '<div class="row">
                                                    <div class="col-md-3">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[0]['nombre']).'"  '.(($ganador1 == null)? 'style="display: none;"' : '' ).' >
                                                            '.$tableGanador1.'
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[1]['nombre']).'"  '.(($ganador2 == null)? 'style="display: none;"' : '' ).' >
                                                            '.$tableGanador2.'
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[2]['nombre']).'"  '.(($ganador3 == null)? 'style="display: none;"' : '' ).' >
                                                            '.$tableGanador3.'
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[3]['nombre']).'"  '.(($ganador4 == null)? 'style="display: none;"' : '' ).' >
                                                            '.$tableGanador4.'
                                                        </div>
                                                    </div>
                                                </div>';
        }

        $data['ganadoresEscojidos'] = $arrayGanadores;

        foreach($categorias as $ca){

            $tableCabeza = '';
            $tableFoooter= '';

            $tableCabeza =  $tableCabeza.'<div '.$columna.' >
                                            <form id="formulario_'.str_replace([' ','(',')'],'',$ca['nombre']).'">
                                                <table class="table table-hover text-center">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3">'.$ca['nombre'].'</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                $ejemplares = Juez::EjemplarCatalogoRaza($ca['categoria_id'], $raza_id, $evento_id);

                
                $tableBody = '';

                foreach ($ejemplares as $eje){

                    // VERIFICAMOS SI YA Esta calificado
                    $cali = Juez::getCalificaciones($evento_id, Auth::user()->id, $eje->id);

                    $grupo = Juez::getGrupo($eje->raza_id);

                    $tableBody = $tableBody.'<tr>
                                                <td>
                                                    <input type="hidden" name="ejemplar_evento_id_ejemplar[]" value="'.$eje->id.'">
                                                    <input type="hidden" name="raza_id_ejemplar[]" value="'.$raza_id.'">
                                                    <input type="hidden" name="evento_id_ejemplar[]" value="'.$evento_id.'">
                                                    <input type="hidden" name="categoria_id_ejemplar[]" value="'.$ca['categoria_id'].'">
                                                    <input type="hidden" name="sexo_ejemplar[]" value="'.$eje->sexo.'">
                                                    <input type="hidden" name="numero_prefijo_ejemplar[]" value="'.$eje->numero_prefijo.'">
                                                    <input type="hidden" name="ejemplar_id_ejemplar[]" value="'.$eje->ejemplar_id.'">
                                                    <input type="hidden" name="grupo_id[]" value="'.$grupo->grupo_id.'">
                                                    <input type="hidden" name="num_pista" value="'.$num_pista.'">
                                                    <h1 class="text-primary">'.$eje->numero_prefijo.'</h1>
                                                    <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                                                </td>
                                                <td>
                                                    <select name="calificacion_ejemplar[]" id="calificacion_ejemplar" class="form-control" '.((!$sw)? "disabled" : '').' >
                                                        <option '.(($cali)? (($cali->calificacion == 'Excelente')? 'selected' : '') : '').'  value="Excelente">Excelente</option>
                                                        <option '.(($cali)? (($cali->calificacion == 'Muy Bueno')? 'selected' : '') : '').'  value="Muy Bueno">Muy Bueno</option>
                                                        <option '.(($cali)? (($cali->calificacion == 'Bueno')? 'selected' : '') : '').'  value="Bueno">Bueno</option>
                                                        <option '.(($cali)? (($cali->calificacion == 'Descalificado')? 'selected' : '') : '').'  value="Descalificado">Descalificado</option>
                                                        <option '.(($cali)? (($cali->calificacion == 'Ausente')? 'selected' : '') : '').'  value="Ausente">Ausente</option>
                                                        <option '.(($cali)? (($cali->calificacion == 'Dispenzado')? 'selected' : '') : '').'  value="Dispenzado">Dispenzado</option>
                                                    </select>
                                                    <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                                                </td>
                                                <td>
                                                    <select name="lugar_ejemplar[]" id="lugar_ejemplar" class="form-control" '.((!$sw)? "disabled" : '').'>
                                                        <option '.(($cali)? (($cali->lugar == 1)? 'selected' : '') : '').' value="1">Primero</option>
                                                        <option '.(($cali)? (($cali->lugar == 2)? 'selected' : '') : '').' value="2">Segundo</option>
                                                        <option '.(($cali)? (($cali->lugar == 3)? 'selected' : '') : '').' value="3">Tercero</option>
                                                        <option '.(($cali)? (($cali->lugar == 4)? 'selected' : '') : '').' value="4">Cuarto</option>
                                                        <option '.(($cali)? (($cali->lugar == 5)? 'selected' : '') : '').' value="5">Quinto</option>
                                                    </select>
                                                    <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                                                </td>
                                            </tr>';

                    // $tableBody = $tableBody.'<tr>
                    //                             <td>
                    //                                 <input type="hidden" name="ejemplar_evento_id_ejemplar[]" value="'.$eje->id.'">
                    //                                 <input type="hidden" name="raza_id_ejemplar[]" value="'.$raza_id.'">
                    //                                 <input type="hidden" name="evento_id_ejemplar[]" value="'.$evento_id.'">
                    //                                 <input type="hidden" name="categoria_id_ejemplar[]" value="'.$ca['categoria_id'].'">
                    //                                 <input type="hidden" name="sexo_ejemplar[]" value="'.$eje->sexo.'">
                    //                                 <input type="hidden" name="numero_prefijo_ejemplar[]" value="'.$eje->numero_prefijo.'">
                    //                                 <input type="hidden" name="ejemplar_id_ejemplar[]" value="'.$eje->ejemplar_id.'">
                    //                                 <input type="hidden" name="grupo_id[]" value="'.$grupo->grupo_id.'">
                    //                                 <input type="hidden" name="num_pista" value="'.$num_pista.'">
                    //                                 <h1 class="text-primary">'.$eje->numero_prefijo.'</h1>
                    //                                 <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                    //                             </td>
                    //                             <td>
                    //                                 <select name="calificacion_ejemplar[]" id="calificacion_ejemplar" class="form-control" '.(($cali)? 'disabled' : '').' >
                    //                                     <option '.(($cali)? (($cali->calificacion == 'Excelente')? 'selected' : '') : '').'  value="Excelente">Excelente</option>
                    //                                     <option '.(($cali)? (($cali->calificacion == 'Muy Bien')? 'selected' : '') : '').'  value="Muy Bien">Muy Bien</option>
                    //                                     <option '.(($cali)? (($cali->calificacion == 'Bien')? 'selected' : '') : '').'  value="Bien">Bien</option>
                    //                                     <option '.(($cali)? (($cali->calificacion == 'Descalificado')? 'selected' : '') : '').'  value="Descalificado">Descalificado</option>
                    //                                     <option '.(($cali)? (($cali->calificacion == 'Ausente')? 'selected' : '') : '').'  value="Ausente">Ausente</option>
                    //                                 </select>
                    //                                 <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                    //                             </td>
                    //                             <td>
                    //                                 <select name="lugar_ejemplar[]" id="lugar_ejemplar" class="form-control" '.(($cali)? 'disabled' : '').' >
                    //                                     <option '.(($cali)? (($cali->lugar == 1)? 'selected' : '') : '').' value="1">Primero</option>
                    //                                     <option '.(($cali)? (($cali->lugar == 2)? 'selected' : '') : '').' value="2">Segundo</option>
                    //                                     <option '.(($cali)? (($cali->lugar == 3)? 'selected' : '') : '').' value="3">Tercero</option>
                    //                                     <option '.(($cali)? (($cali->lugar == 4)? 'selected' : '') : '').' value="4">Cuarto</option>
                    //                                     <option '.(($cali)? (($cali->lugar == 5)? 'selected' : '') : '').' value="5">Quinto</option>
                    //                                 </select>
                    //                                 <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                    //                             </td>
                    //                         </tr>';

                }
                    // PRIMERA VERSION LA QUE ESTA FUNCIONADO
                    // $tableFoooter = $tableFoooter.'</tbody>
                    //                             </table>
                    //                             '.(($cali == null)? '
                    //                                 <div class="row">
                    //                                     <div class="col-md-12">
                    //                                         <button id="button_'.str_replace([' ','(',')'],'',$ca['nombre']).'" type="button" class="btn btn-success btn-block" onclick="finalizarCalificacion('."'".str_replace([' ','(',')'],'',$ca['nombre'])."'".')">Finalizar</button>
                    //                                     </div>
                    //                                 </div>
                    //                             ' : '').'
                    //                         </form>
                    //                     </div>';

                    // SEGUNDA VERSION LA QUE NO TIEN RESTRICCIONES PERO FUNCION
                    // $tableFoooter = $tableFoooter.'</tbody>
                    //                     </table>
                    //                     <div class="row">
                    //                         <div class="col-md-12">
                    //                             <button id="button_'.str_replace([' ','(',')'],'',$ca['nombre']).'" type="button" class="btn btn-success btn-block" onclick="finalizarCalificacion('."'".str_replace([' ','(',')'],'',$ca['nombre'])."'".')">Finalizar</button>
                    //                         </div>
                    //                     </div>
                    //                 </form>
                    //             </div>';

                    // SEGUNDA VERSION LA QUE NO TIEN RESTRICCIONES PERO FUNCION
                    $tableFoooter = $tableFoooter.'</tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-12">
                                                '.(($sw)? '
                                                    <button id="button_'.str_replace([' ','(',')'],'',$ca['nombre']).'" type="button" class="btn btn-success btn-block" onclick="finalizarCalificacion('."'".str_replace([' ','(',')'],'',$ca['nombre'])."'".')">Finalizar</button>
                                                ' : '').'
                                            </div>
                                        </div>
                                    </form>
                                </div>';


            $data['tables'] = $data['tables'].$tablePrincipal.$tableCabeza.$tableBody.$tableFoooter;

        }

        // PARA EL MOJOR ESCOGIDO
        $array_categorias = array();

        foreach($categorias as $ca){
            array_push($array_categorias, $ca['categoria_id']);
        }

        $mejosEscogido = Juez::getMejoresEscogidos($evento_id, Auth::user()->id, $array_categorias, $num_pista, $raza_id);

        if($mejosEscogido){

            $data['mejorEscogido'] = true;

            if($mejosEscogido->categoria_id == 2 || $mejosEscogido->categoria_id == 11) {
                $mejor = "MEJOR CACHORRO";
            }else if($mejosEscogido->categoria_id == 3 || $mejosEscogido->categoria_id == 4 || $mejosEscogido->categoria_id == 12 || $mejosEscogido->categoria_id == 13){  
                $mejor = "MEJOR JOVEN";
            }else if($mejosEscogido->categoria_id == 5 || $mejosEscogido->categoria_id == 6 || $mejosEscogido->categoria_id == 7 || $mejosEscogido->categoria_id == 8 || $mejosEscogido->categoria_id == 9 || $mejosEscogido->categoria_id == 10 || $mejosEscogido->categoria_id == 14 || $mejosEscogido->categoria_id == 15){
                $mejor = "MEJOR ADULTO";
            }

            $data['mejorEscogidoHtml'] = '<div class="row text-center">
                                                <div class="col-md-6">
                                                    <h5 class="text-success">'.$mejor.'</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3 class="text-info">'.$mejosEscogido->numero_prefijo.'</h3>
                                                </div>
                                            </div>';

        }


        return json_encode($data);

    }

    public function ajaxCalificacionMejor(Request $request){

        $ganador_id = $request->input('ganador');

        $ganador = Ganador::find($ganador_id);

        $ganador->mejor_escogido = "Si";

        $ganador->save();

        $arrayCategorias = array();

        if($ganador->categoria_id == 2 || $ganador->categoria_id == 11) {
            $mejor = "MEJOR CACHORRO";

            $categoria = CategoriasPista::find(2);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(11);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));

        }else if($ganador->categoria_id == 3 || $ganador->categoria_id == 4 || $ganador->categoria_id == 12 || $ganador->categoria_id == 13){  
            $mejor = "MEJOR JOVEN";
            
            $categoria = CategoriasPista::find(3);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(4);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(12);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(13);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));

        }else if($ganador->categoria_id == 5 || $ganador->categoria_id == 6 || $ganador->categoria_id == 7 || $ganador->categoria_id == 8 || $ganador->categoria_id == 9 || $ganador->categoria_id == 10 || $ganador->categoria_id == 14 || $ganador->categoria_id == 15){
            $mejor = "MEJOR ADULTO";

            $categoria = CategoriasPista::find(5);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(6);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(7);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(8);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(9);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(10);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(14);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
            $categoria = CategoriasPista::find(15);
            array_push($arrayCategorias, str_replace([' ','(',')'],'',$categoria->nombre));
        }

        $data['mejor'] = '<div class="row text-center">
                            <div class="col-md-6">
                                <h5 class="text-success">'.$mejor.'</h5>
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-info">'.$ganador->numero_prefijo.'</h3>
                            </div>
                        </div>';

        $data['categoria'] = $arrayCategorias;

        return json_encode($data);

    }

    public function ajaxPlanilla(Request $request){

        $raza_id    = $request->input('raza');
        $evento_id  = $request->input('evento');
        
        // BUSCAMOS Y MANDAMOS LOS CACHORROS ABSOLUTOS
        $ejemplaresCachorroAbsolutos    = Juez::EjemplarCatalogoRaza(11, $raza_id, $evento_id);

        // BUSCAMOS Y MANDAMOS LOS JOVENES MACHOS
        $ejemplaresJoven                = Juez::EjemplarCatalogoRaza(3, $raza_id, $evento_id);

        // BUSCAMOS Y MANDAMOS LOS JOVENES CAMPEONES MACHOS
        $ejemplaresJovenCampeonMacho    = Juez::EjemplarCatalogoRaza(12, $raza_id, $evento_id);
        
        // BUSCAMOS Y MANDAMOS LOS INTERMEDIA MACHOS
        $ejemplaresIntermediaMacho      = Juez::EjemplarCatalogoRaza(5, $raza_id, $evento_id);

        // BUSCAMOS Y MANDAMOS LOS ABIERTA MACHOS
        $ejemplaresAbiertaMacho         = Juez::EjemplarCatalogoRaza(7, $raza_id, $evento_id);

        // BUSCAMOS Y MANDAMOS LOS CAMPEONES MACHOS
        $ejemplaresCampeonesMacho       = Juez::EjemplarCatalogoRaza(9, $raza_id, $evento_id);

        // BUSCAMOS Y MANDAMOS LOS GRANDES CAMPEONES MACHOS
        $ejemplaresGrandesCampeoesMacho = Juez::EjemplarCatalogoRaza(14, $raza_id, $evento_id);

        $data['planilla'] = view('juez.planilla', compact('ejemplaresCachorroAbsolutos', 'ejemplaresJoven', 'ejemplaresJovenCampeonMacho', 'ejemplaresIntermediaMacho', 'ejemplaresAbiertaMacho', 'ejemplaresCampeonesMacho', 'ejemplaresGrandesCampeoesMacho'))->render();

        return json_encode($data);
    }

    public function ajaxGanadores(Request $request){

        if($request->ajax()){

            $raza_id    = $request->input('raza');
            $evento_id  = $request->input('evento');
            $num_pista  = $request->input('pista');

            // PRIMERO PARA LOS MACHOS
            // CACHORRO
            $cachorro = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [11], "Macho", $num_pista);

            // JOVEN o JOVEN CAMPEON
            $joven = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [3, 12], "Macho", $num_pista);

            // ADULTO
            $adulto = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [5, 7, 9, 14], "Macho", $num_pista);

            // VENTERANO
            $veterano = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [16], "Macho", $num_pista);

            // PARA SABER EL MOJOR MACHO
            $sw = false;
            $swMR = false;
            $swMRSO = false;
            $mejorMacho = null;
            $mejorRaza = null;
            $mejorRazaSexoOpuesto = null;

            if($joven){
                if($joven->mejor_macho == "Si"){
                    $mejorMacho = $joven;
                    $sw = true;

                    // esto sera para el mejor de la raza
                    if($joven->mejor_raza == "Si"){
                        $mejorRaza =   $joven;
                        $swMR = true;
                    }else if($joven->sexo_opuesto_raza == "Si"){
                        $mejorRazaSexoOpuesto = $joven;
                        $swMRSO = true;
                    }
                }
            }

            if($adulto){
                if($adulto->mejor_macho == "Si"){
                    $mejorMacho = $adulto;
                    $sw = true;

                    // esto sera para el mejor de la raza
                    if($adulto->mejor_raza == "Si"){
                        $mejorRaza =   $adulto;
                        $swMR = true;
                    }else if($adulto->sexo_opuesto_raza == "Si"){
                        $mejorRazaSexoOpuesto = $adulto;
                        $swMRSO = true;
                    }
                }
            }
            
            if($veterano){
                if($veterano->mejor_macho == "Si"){
                    $mejorMacho = $veterano;
                    $sw = true;

                    // esto sera para el mejor de la raza
                    if($veterano->mejor_raza == "Si"){
                        $mejorRaza =   $veterano;
                        $swMR = true;
                    }else if($veterano->sexo_opuesto_raza == "Si"){
                        $mejorRazaSexoOpuesto = $veterano;
                        $swMRSO = true;
                    }
                }
            }

            $tableMacho = '<div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>CACHORRO</th>
                                                <th>JOVEN</th>
                                                <th>ADULTO</th>
                                                <th>VETERANO</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> 
                                                    <center>
                                                        <label class="radio radio-rounded radio-primary">
                                                            <small style="font-size:20px" class="text-primary">'.(($cachorro)? $cachorro->numero_prefijo : "").'</small>
                                                        </label>
                                                    </center>
                                                </td>
                                                <td>
                                                    <label class="radio radio-rounded radio-success">
                                                        <small style="font-size:20px" class="text-primary">'.(($joven)? $joven->numero_prefijo : "").'</small>
                                                        '.(($joven)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_joven" value="'.$joven->id.'" name="mejor_macho" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorMacho->id == $joven->id)? 'checked' : '') : '').' /><span></span>' : '').'
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio radio-rounded radio-success">
                                                        <small style="font-size:20px" class="text-primary">'.(($adulto)? $adulto->numero_prefijo : "").'</small>
                                                        '.(($adulto)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_adulto" value="'.$adulto->id.'" name="mejor_macho" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorMacho->id == $adulto->id)? 'checked' : '') : '').' /><span></span>' : '').'
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio radio-rounded radio-success">
                                                        <small style="font-size:20px" class="text-primary">'.(($veterano)? $veterano->numero_prefijo : "").'</small>
                                                        '.(($veterano)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_veterano" value="'.$veterano->id.'" name="mejor_macho" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorMacho->id == $veterano->id)? 'checked' : '') : '').' /><span></span>' : '').'
                                                    </label>
                                                </td>
                                                <td>
                                                    <button type="button" id="button_mejor_macho" onclick="mejorVencedores('."'macho'".')" class="btn btn-icon btn-success" '.(($sw)? 'disabled' : '').'><i class="fa fa-align-center" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                           </div>
                            ';

            // $tableMacho = '<div class="row">
            //                     <div class="col-md-6">
            //                         <div class="radio-inline">
            //                             <label class="radio radio-rounded radio-primary">
            //                                 CACHORRO => <small style="font-size:15px" class="text-primary border p-1">'.(($cachorro)? $cachorro->numero_prefijo : "").'</small>
            //                             </label>

            //                             <label class="radio radio-rounded radio-primary">
            //                                 JOVEN => <small style="font-size:15px" class="text-primary border p-1">'.(($joven)? $joven->numero_prefijo : "").'</small>
            //                                 '.(($joven)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_joven" value="'.$joven->id.'" name="mejor_macho" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorMacho->id == $joven->id)? 'checked' : '') : '').' /><span></span>' : '').'
            //                             </label>
            //                             <label class="radio radio-rounded radio-primary">
            //                                 ADULTO => <small style="font-size:15px" class="text-primary border p-1">'.(($adulto)? $adulto->numero_prefijo : "").'</small>
            //                                 '.(($adulto)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_adulto" value="'.$adulto->id.'" name="mejor_macho" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorMacho->id == $adulto->id)? 'checked' : '') : '').' /><span></span>' : '').'
            //                             </label>
            //                             <label class="radio radio-rounded radio-primary">
            //                                 VETERANO => <small style="font-size:15px" class="text-primary border p-1">'.(($veterano)? $veterano->numero_prefijo : "").'</small>
            //                                 '.(($veterano)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_veterano" value="'.$veterano->id.'" name="mejor_macho" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorMacho->id == $veterano->id)? 'checked' : '') : '').' /><span></span>' : '').'
            //                             </label>
            //                         </div>
            //                     </div>
            //                     <div class="col-md-6">
            //                         <div class="row">
            //                             <div class="col-md-12">
            //                                 <div class="row">
            //                                     <div class="col-md-3">
            //                                         <button type="button" id="button_mejor_macho" onclick="mejorVencedores('."'macho'".')" class="btn btn-icon btn-success" '.(($sw)? 'disabled' : '').'><i class="fa fa-align-center" aria-hidden="true"></i></button>
            //                                     </div>
            //                                     <div class="col-md-9">
            //                                         <div id="mejor_macho_vencedor" '.((!$sw)? 'style="display: none"' : '').'>'
            //                                             .(($sw)? '<div class="row">
            //                                                         <div class="col-md-12">
            //                                                             <h5 class="text-success text-center"> MEJOR MACHO => <span class="text-info">'.$mejorMacho->numero_prefijo.'</span></h5>
            //                                                         </div>
            //                                                     </div>' : '').
            //                                         '</div>
            //                                     </div>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                     </div>
            //                </div>
            //                 ';

            if($sw){
                $data['mejor_vencedor_macho'] = '<h5 class="text-success text-center">MEJOR MACHO <span class="text-info">'.($mejorMacho->numero_prefijo).'</span></h5>';
            }else{
                $data['mejor_vencedor_macho'] = '';
            }

            
            // SEGUNDO PARA LOS HEMBRAS
            // CACHORRO
            $cachorroHembra = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [2], "Hembra", $num_pista);

            // JOVEN o JOVEN CAMPEON
            $jovenHembra = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [4, 13], "Hembra", $num_pista);

            // ADULTO
            $adultoHembra = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [6, 8, 10, 15], "Hembra", $num_pista);

            // VENTERANO
            $veteranoHembra = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [17], "Hembra", $num_pista);

             // PARA SABER EL MOJOR HEMBRA
             $sw = false;
             $mejorHembra = null;
 
             if($jovenHembra){
 
                 if($jovenHembra->mejor_hembra == "Si"){
                     $mejorHembra = $jovenHembra;
                     $sw = true;

                     if($jovenHembra->mejor_raza == "Si"){
                        $mejorRaza =   $jovenHembra;
                        $swMR = true;
                     }else if($jovenHembra->sexo_opuesto_raza == "Si"){
                        $mejorRazaSexoOpuesto = $jovenHembra;
                        $swMRSO = true;
                     }
                 }
 
             }

             if($adultoHembra){
                 
                 if($adultoHembra->mejor_hembra == "Si"){
                     $mejorHembra = $adultoHembra;
                     $sw = true;

                     if($adultoHembra->mejor_raza == "Si"){
                        $mejorRaza =   $adultoHembra;
                        $swMR = true;
                     }else if($adultoHembra->sexo_opuesto_raza == "Si"){
                        $mejorRazaSexoOpuesto = $adultoHembra;
                        $swMRSO = true;
                     }
                 }
 
             }
             
            if($veteranoHembra){
 
                 if($veteranoHembra->mejor_hembra == "Si"){
                     $mejorHembra = $veteranoHembra;
                     $sw = true;

                     if($veteranoHembra->mejor_raza == "Si"){
                        $mejorRaza =   $veteranoHembra;
                        $swMR = true;
                     }else if($veteranoHembra->sexo_opuesto_raza == "Si"){
                        $mejorRazaSexoOpuesto = $veteranoHembra;
                        $swMRSO = true;
                     }
                 }
 
             }
            
            $tableHembra = '<div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>CACHORRO</th>
                                                <th>JOVEN</th>
                                                <th>ADULTO</th>
                                                <th>VETERANO</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> 
                                                    <label class="radio radio-rounded radio-danger">
                                                        <small style="color: #F94EE4;  font-size:20px">'.(($cachorroHembra)? $cachorroHembra->numero_prefijo : "").'</small>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio radio-rounded radio-danger">
                                                        <small style="color: #F94EE4;  font-size:20px">'.(($jovenHembra)? $jovenHembra->numero_prefijo : "").'</small>
                                                        '.(($jovenHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_joven" value="'.$jovenHembra->id.'" name="mejor_hembra" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorHembra->id == $jovenHembra->id)? 'checked' : '') : '').' /><span></span>' : '').'
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio radio-rounded radio-danger">
                                                        <small style="color: #F94EE4;  font-size:20px">'.(($adultoHembra)? $adultoHembra->numero_prefijo : "").'</small>
                                                        '.(($adultoHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_adulto" value="'.$adultoHembra->id.'" name="mejor_hembra" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorHembra->id == $adultoHembra->id)? 'checked' : '') : '').' /><span></span>' : '').'
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio radio-rounded radio-danger">
                                                        <small style="color: #F94EE4;  font-size:20px">'.(($veteranoHembra)? $veteranoHembra->numero_prefijo : "").'</small>
                                                        '.(($veteranoHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_jveterano" value="'.$veteranoHembra->id.'" name="mejor_hembra" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorHembra->id == $veteranoHembra->id)? 'checked' : '') : '').' /><span></span>' : '').'
                                                    </label>
                                                </td>
                                                <td>
                                                    <button id="button_mejor_hembra" type="button" onclick="mejorVencedores('."'hembra'".')" class="btn btn-icon" style="background: #F94EE4;" '.(($sw)? 'disabled' : '').'><i class="fa fa-align-center text-white" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            ';

            // $tableHembra = '
            //                 <div class="row">
            //                     <div class="col-md-6">
            //                         <div class="radio-inline">
            //                             <label class="radio radio-rounded radio-danger">
            //                                 CACHORRO => <small style="color: #F94EE4;  font-size:15px" class="border p-1">'.(($cachorroHembra)? $cachorroHembra->numero_prefijo : "").'</small>
            //                             </label>

            //                             <label class="radio radio-rounded radio-danger">
            //                                 JOVEN => <small style="color: #F94EE4;  font-size:15px" class="border p-1">'.(($jovenHembra)? $jovenHembra->numero_prefijo : "").'</small>
            //                                 '.(($jovenHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_joven" value="'.$jovenHembra->id.'" name="mejor_hembra" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorHembra->id == $jovenHembra->id)? 'checked' : '') : '').' /><span></span>' : '').'
            //                             </label>
            //                             <label class="radio radio-rounded radio-danger">
            //                                 ADULTO => <small style="color: #F94EE4;  font-size:15px" class="border p-1">'.(($adultoHembra)? $adultoHembra->numero_prefijo : "").'</small>
            //                                 '.(($adultoHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_adulto" value="'.$adultoHembra->id.'" name="mejor_hembra" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorHembra->id == $adultoHembra->id)? 'checked' : '') : '').' /><span></span>' : '').'
            //                             </label>
            //                             <label class="radio radio-rounded radio-danger">
            //                                 VETERANO => <small style="color: #F94EE4;  font-size:15px" class="border p-1">'.(($veteranoHembra)? $veteranoHembra->numero_prefijo : "").'</small>
            //                                 '.(($veteranoHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_jveterano" value="'.$veteranoHembra->id.'" name="mejor_hembra" '.(($sw)? 'disabled' : '').' '.(($sw)? (($mejorHembra->id == $veteranoHembra->id)? 'checked' : '') : '').' /><span></span>' : '').'
            //                             </label>
            //                         </div>
            //                     </div>
            //                     <div class="col-md-6">
            //                         <div class="row">
            //                             <div class="col-md-12">
            //                                 <div class="row">
            //                                     <div class="col-md-3">
            //                                         <button id="button_mejor_hembra" type="button" onclick="mejorVencedores('."'hembra'".')" class="btn btn-icon" style="background: #F94EE4;" '.(($sw)? 'disabled' : '').'><i class="fa fa-align-center text-white" aria-hidden="true"></i></button>
            //                                     </div>
            //                                     <div class="col-md-9">
            //                                         <div id="mejor_hembra_vencedor" '.((!$sw)? 'style="display: none"' : '').'>'.
            //                                         (($sw)? ('<div class="row">
            //                                                     <div class="col-md-12">
            //                                                         <h5 class="text-success text-center"> MEJOR HEMBRA => <span class="text-info">'.$mejorHembra->numero_prefijo.'</span></h5>
            //                                                     </div>
            //                                                 </div>') : '')
            //                                         .'</div>
            //                                     </div>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                     </div>
            //                 </div>
            //                 ';

            if($sw){
                $data['mejor_vencedor_hembra'] = '<h5 class="text-success text-center">MEJOR HEMBRA <span class="text-info">'.($mejorMacho->numero_prefijo).'</span></h5>';
            }else{
                $data['mejor_vencedor_hembra'] = '';
            }

            $data['status'] = 'success';
            $data['tableMachos'] = $tableMacho;
            $data['tableHembras'] = $tableHembra;



            // ************************ PARA EL MEJOR DE LA RAZA ********************************

            $mejorRazaHtml = '';
            $mejorRazaSexoOpuestoHtml = '';

            if($swMRSO){

                $mejorRazaSexoOpuestoHtml = $mejorRazaSexoOpuestoHtml. '<div class="row">
                                            <div class="col-md-12">
                                            <h5> SEXO OPUESTO DE LA RAZA => <span class="text-info">'.$mejorRazaSexoOpuesto->numero_prefijo.'</span></h5>
                                            </div>
                                        </div>';
            }

            if($swMR){

                $data['mejorRaza'] = "mejor_raza_calificado";

                $mejorRazaHtml = $mejorRazaHtml. '<div class="row">
                                                    <div class="col-md-12">
                                                        <h5> MEJOR DE LA RAZA => <span class="text-info">'.$mejorRaza->numero_prefijo.'</span></h5>
                                                    </div>
                                                </div>'.$mejorRazaSexoOpuestoHtml;

            }else{

                // PARA EL SELCE DE MEJRO RAZA
                $selecRaza = 'SELECCION MEJOR MEJOR RAZA<br><select  name="select_raza_mejor" id="select_raza_mejor" class="form-control">';

                $bodySelect = '';

                $datos = Juez::getMejorMachooHebra($raza_id, $evento_id, [3,4,5,6,7,8,9,10,12,13,14,15], $num_pista);


                if(count($datos) > 0)
                    $data['mejorRaza'] = "mejor_raza_sin_calificado";

                foreach ($datos as $d){
                    $bodySelect = $bodySelect.'<option value="'.$d->id.'">'.$d->numero_prefijo.'</option>';
                }

                $mejorRazaHtml = $selecRaza.$bodySelect.'</select><br><button type="button" id="button_guarda_mejo_raza" onclick="guardaMejor('."'".'raza'."'".')"   class="btn btn-success btn-block">Guardar Mejor de la Raza</button>';

            }

            $data['mejorRazaHtml'] = $mejorRazaHtml;
            

            // AHORA VAMOS A PONER LOS SELECT PARA SELECIONAR MEJRO CACHORRO, JOVEN Y RAZA
            // ************************** CACHORRO ******************************

            $selectBod= '';
            $swMC = false;

            if($cachorro){
                if($cachorro->mejor_cachorro == "Si"){
                    $swMC = true;
                }
                $selectBod = $selectBod.'<option '.(($swMC)? 'selected' : '').' value="'.$cachorro->id.'">'.$cachorro->numero_prefijo.'</option>';
            }
            if($cachorroHembra){
                if($cachorroHembra->mejor_cachorro == "Si"){
                    $swMC = true;
                }
                $selectBod = $selectBod.'<option '.(($swMC)? 'selected' : '').' value="'.$cachorroHembra->id.'">'.$cachorroHembra->numero_prefijo.'</option>';
            }
            
            $selectCachorro = 'SELECCION MEJOR CACHORRO<br><select class="form-control" name="select_cachorro_mejor" id="select_cachorro_mejor" '.(($swMC)? 'disabled' : '').'>';

            // SELLECIONAMOS SI HAY MEJOR CACHORRO
            if($cachorro || $cachorroHembra){
                
                $data['selectCachorro'] = $selectCachorro.$selectBod.'</select>
                                                                        <br>'.((!$swMC)? '
                                                                            <button type="button" id="button_guarda_mejo_cachorro" onclick="guardaMejor('."'".'cachorro'."'".')" class="btn btn-success btn-block">Guardar Mejor Cachorro</button>
                                                                        ' : '').'';

            }else{

                $data['selectCachorro'] = '';
                
            }

            // ******************* AHORA PARA LOS JOVENES **************************
            $selectBod= '';

            $swMJ = false;
            $mejoJoven = null;
            $sexoOpuesto  = null;

            if($joven){
                
                if($joven->mejor_joven == "Si"){

                    $mejoJoven = $joven;
                    $swMJ = true;

                    if($jovenHembra){
                        if($jovenHembra->sexo_opuesto_joven == "Si"){
                            $sexoOpuesto  = $jovenHembra;
                        }
                    }

                }
                
                $selectBod = $selectBod.'<option '.(($swMJ)? 'selected' : '').' value="'.$joven->id.'">'.$joven->numero_prefijo.'</option>';
            }

            if($jovenHembra){
                
                if($jovenHembra->mejor_joven == "Si"){

                    $mejoJoven = $jovenHembra;
                    $swMJ = true;

                    if($joven){
                        if($joven->sexo_opuesto_joven == "Si"){
                            $sexoOpuesto  = $joven;
                        }
                    }

                }

                $selectBod = $selectBod.'<option '.(($swMJ)? 'selected' : '').'  value="'.$jovenHembra->id.'">'.$jovenHembra->numero_prefijo.'</option>';
            }

            
            if($joven || $jovenHembra){

                if(!$swMJ){

                    $selectCachorro = 'SELECCION MEJOR jOVEN<br><select class="form-control" name="select_joven_mejor" id="select_joven_mejor" '.(($swMJ)? 'disabled' : '').'>';
                    
                    $data['selectJoven'] = $selectCachorro.$selectBod.'</select>
                                                                        <br>'.((!$swMJ)? '
                                                                            <button  type="button" id="button_guarda_mejo_joven" onclick="guardaMejor('."'".'joven'."'".')"  class="btn btn-success btn-block">Guardar Mejor Joven</button>
                                                                        ' : '').'';
                }else{

                    $data['selectJoven'] = '';

                }
                

                // ************** PARA MANDAR EL HTML MEJOR JOVEN Y SEXO OPUESTO **********
                if($mejoJoven){

                    $sexoOpuestoHtml = '';

                    if($sexoOpuesto){

                        $sexoOpuestoHtml = $sexoOpuestoHtml.'<div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>SEXO OPUESTO => <span class="text-info">'.($sexoOpuesto->numero_prefijo).'</span></h5>
                                                                </div>
                                                            </div>';
                    }

                    $data['htmlMejoOpuestoJoven'] = '<div class="row">
                                                        <div class="col-md-12">
                                                            <h5>MEJOR JOVEN => <span class="text-info">'.($mejoJoven->numero_prefijo).'</span></h5>
                                                        </div>
                                                    </div>
                                                    '.$sexoOpuestoHtml;

                    $data['MejoOpuestoJoven'] = true;


                }else{

                    $data['MejoOpuestoJoven'] = false;

                }

            }else{

                $data['selectJoven'] = '';

            }

            return json_encode($data);

        }

    }

    public function mejorVencedores(Request $request){

        if($request->ajax()){

            $ganador_id = $request->input('vencedor');
            $num_pista = $request->input('pista');

            $ganador = Ganador::find($ganador_id);

            if($ganador->sexo == 'Macho'){
                $ganador->mejor_macho = "Si";
            }else{
                $ganador->mejor_hembra = "Si";
            }

            $ganador->save();

            $data['status'] = 'success';
            $data['sexo'] = $ganador->sexo;

            $data['html'] = '<div class="row">
                                <div class="col-md-8">
                                    <h5 class="text-success text-center"> MEJOR '.(($ganador->sexo == 'Macho')? 'MACHO =>': 'HEMBRA =>').'<span class="text-info">'.$ganador->numero_prefijo.'</span></h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-9 col-form-label">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" id="certificacionCLACAB_'.$ganador->id.'" onclick="agregaCertificado(1, '.$ganador->id.')" name="Checkboxes6"/>
                                                    <span></span>
                                                    CLACAB
                                                </label>
                                                <label class="checkbox">
                                                    <input type="checkbox" id="certificacionCACIB_'.$ganador->id.'" onclick="agregaCertificado(2, '.$ganador->id.')" name="Checkboxes6"/>
                                                    <span></span>
                                                    CA CIB
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';

            // $data['html'] = '<div class="row">
            //                     <div class="col-md-8">
            //                         <h5 class="text-success text-center"> MEJOR '.(($ganador->sexo == 'Macho')? 'MACHO =>': 'HEMBRA =>').'<span class="text-info">'.$ganador->numero_prefijo.'</span></h5>
            //                     </div>
            //                     <div class="col-md-4">
            //                         <div class="form-group row">
            //                             <div class="col-9 col-form-label">
            //                                 <div class="checkbox-inline">
            //                                     <label class="checkbox">
            //                                         <input type="checkbox" id="certificacionCLACAB_'.$ganador->id.'" onclick="agregaCertificado(1, '.$ganador->id.')" name="Checkboxes6"/>
            //                                         <span></span>
            //                                         CLACAB
            //                                     </label>
            //                                     <label class="checkbox">
            //                                         <input type="checkbox" id="certificacionCACIB_'.$ganador->id.'" onclick="agregaCertificado(2, '.$ganador->id.')" name="Checkboxes6"/>
            //                                         <span></span>
            //                                         CA CIB
            //                                     </label>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                     </div>
            //                 </div>';

            // PARA EL SELCE DE MEJRO RAZA
            $selecRaza = 'SELECCION MEJOR MEJOR RAZA<br><select  name="select_raza_mejor" id="select_raza_mejor" class="form-control">';

            $bodySelect = '';

            $datos = Juez::getMejorMachooHebra($ganador->raza_id, $ganador->evento_id, [3,4,5,6,7,8,9,10,12,13,14,15], $num_pista);

            foreach ($datos as $d){
                $bodySelect = $bodySelect.'<option value="'.$d->id.'">'.$d->numero_prefijo.'</option>';
            }

            $data['selectMejoresRaza'] = $selecRaza.$bodySelect.'</select><br><button type="button" id="button_guarda_mejo_raza" onclick="guardaMejor('."'".'raza'."'".')"   class="btn btn-success btn-block">Guardar Mejor de la Raza</button>';

            return json_encode($data);

        }

    }

    public function mejorRazaFinPlanilla(Request $request){

        if($request->ajax()){

            $ganador_id      = $request->input('vencedor');
            $tipo            = $request->input('tipo');
            $num_pista       = $request->input('pista');

            $ganador = Ganador::find($ganador_id);

            $mejorSexopuesto = '';

            if($tipo == "cachorro"){

                $ganador->mejor_cachorro = "Si";

                $sexoOpuesto =  Juez::getsexoOpuesto($ganador->raza_id, $ganador->evento_id, [2, 11], $ganador->sexo, "mejor_cachorro", $num_pista);

                if($sexoOpuesto){

                    $sexoOpuesto->sexo_opuesto_cachorro = "Si";

                    $sexoOpuesto->save();
                }

            }elseif($tipo == "joven"){

                $ganador->mejor_joven = "Si";

                $sexoOpuesto =  Juez::getsexoOpuesto($ganador->raza_id, $ganador->evento_id, [3, 4, 12, 13], $ganador->sexo, "mejor_joven", $num_pista);

                if($sexoOpuesto){

                    $sexoOpuesto->sexo_opuesto_joven = "Si";

                    $sexoOpuesto->save();
                }

            }else{

                $ganador->mejor_raza = "Si";

                $sexoOpuesto =  Juez::getsexoOpuesto($ganador->raza_id, $ganador->evento_id, [3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17], $ganador->sexo, "mejor_raza", $num_pista);

                if($sexoOpuesto){

                    $sexoOpuesto->sexo_opuesto_raza = "Si";

                    $sexoOpuesto->save();
                }

            }

            $ganador->save();

            if($sexoOpuesto){

                $mejorSexopuesto = '<div class="row">
                                        <div class="col-md-12">
                                        <h5>SEXO OPUESTO <span class="text-info">'.$sexoOpuesto->numero_prefijo.'</span></h5>
                                        </div>
                                    </div>';
                                    
            }
            
            $data['mejor'] = '<div class="row">
                                    <div class="col-md-12">
                                       <h5> MEJOR '.(($tipo == "cachorro")? 'CACHORRO => ' : (($tipo == "joven")? 'JOVEN => ' : 'DE LA RAZA => ')).' <span class="text-info">'.$ganador->numero_prefijo.'</span></h5>
                                    </div>
                                </div>'.$mejorSexopuesto;

            $data['tipo'] = $tipo;
            $data['status'] = 'success';


            return json_encode($data);

        }

    }

    public function bestingGanadores(Request $request){

        if($request->ajax()){

            $tipo       = $request->input('tipo');
            $evento_id  = $request->input('evento');
            $num_pista  = $request->input('pista');

            if($tipo == "especiales"){
                $ganadores = Juez::ejemplaresCategoria('Especiales', $evento_id,[1,2,3,4,5,6,7,8,9,10], $num_pista); 
            }elseif($tipo == "absolutos"){
                $ganadores = Juez::getGanadores($evento_id, [2,11], 'mejor_cachorro', $num_pista);
            }elseif($tipo == "jovenes"){
                $ganadores = Juez::getGanadores($evento_id, [3,4,12,13], 'mejor_joven', $num_pista);
            }elseif($tipo == "adultos"){
                $ganadores = Juez::getGanadores($evento_id, [5,6,7,8,9,10,14,15], 'mejor_raza', $num_pista);
            }

            
            $data['status'] ='success';

            $data['table']  =  view('juez.besting', compact('ganadores','evento_id', 'tipo', 'num_pista'))->render();


            // ************************** PARA LOS FINALISTAS **************************
            $finalistas = Juez::finalistasBesting($evento_id, $tipo, $num_pista);
            
            $tbody = '';

            $sw = false;

            $arrayGruposExistentes = array();

            foreach ($finalistas as $key => $fi){

                if(!in_array($fi->grupo_id, $arrayGruposExistentes)){

                    array_push($arrayGruposExistentes, $fi->grupo_id);

                    // PREGUNTAMOS POR LO SLUGARES
                    $primero = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 1);
                    $segundo = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 2);
                    $tercer  = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 3);
                    $cuarto  = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 4);
                    $quinto  = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 5);

                    if($fi->lugar_finalista != null)
                        $sw = true;

                    $tbody = $tbody.'<td class="text-primary">
                                        <input type="hidden" value="'.$fi->id.'" name="bestinguids[]">
                                        <h2 class="text-center">'.$fi->numero_prefijo.'</h2>
                                        <br>
                                        <select name="posision_'.$key.'" id="calificacion_final_'.$fi->numero_prefijo.'" class="form-control">
                                            <option '.(($primero)? 'disabled' : '').' value="1">Mejor</option>
                                            <option '.(($segundo)? 'disabled' : '').' value="2">Segundo</option>
                                            <option '.(($tercer)? 'disabled' : '').' value="3">Tercero</option>
                                            <option '.(($cuarto)? 'disabled' : '').' value="4">Cuarto</option>
                                            <option '.(($quinto)? 'disabled' : '').' value="5">Quinto</option>
                                        </select>
                                        <small style="display: none;" class="text-warning" id="_calificacion_final_'.$fi->numero_prefijo.'">Calificacion repetida</small>
                                        <br>'.
                                        ((!$sw)? '<button class="btn btn-success btn-block" onclick="calificaFinal('.$key.', '.$fi->id.', '."'".$fi->numero_prefijo."'".')">CALIFICAR</button>' : '').'
                                    </td>';
                }

            }

            $tableFinalistas = '
                                <table class="table table-bordered table-hover table-striped" style="width:100%;">
                                    <tbody>
                                        <tr>
                                        '.$tbody.'
                                        </tr>
                                    </tbody>
                                </table>';

            $data['finalistas']  = $tableFinalistas;

            // MADAMOS YA LOS CALIFICADOS

            // PREGUNTAMOS POR LO SLUGARES
            $primero = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 1);
            $segundo = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 2);
            $tercer  = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 3);
            $cuarto  = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 4);
            $quinto  = Evento::ganadoresBesting($evento_id, $num_pista, $tipo, 5);

            $data['tablaFinalistasCalificados'] =  '<h3 class="text-primary text-center">GANADORES DE LA CATEGORIA</h3>
                                                    <table class="table table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>1ro</th>
                                                                <th>2do</th>
                                                                <th>3ro</th>
                                                                <th>4to</th>
                                                                <th>5to</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><span class="text-info fa-2x">'.(($primero)? $primero->numero_prefijo : '').'</span></td>
                                                                <td><span class="text-info fa-2x">'.(($segundo)? $segundo->numero_prefijo : '').'</span></td>
                                                                <td><span class="text-info fa-2x">'.(($tercer)? $tercer->numero_prefijo : '').'</span></td>
                                                                <td><span class="text-info fa-2x">'.(($cuarto)? $cuarto->numero_prefijo : '').'</span></td>
                                                                <td><span class="text-info fa-2x">'.(($quinto)? $quinto->numero_prefijo : '').'</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>';

            return json_encode($data);

        }

    }

    public function calificabesting(Request $request){

        if($request->ajax()){

            $evento_id          = $request->input('evento');
            $grupo_id           = $request->input('grupo');
            $tipo               = $request->input('tipo');
            $numero_prefijos    = $request->input('numeros');
            $calificaciones     = $request->input('calificaciones');
            $categorias_pistas  = $request->input('categorias_pistas');
            $ejempleres_id      = $request->input('ejempleres_id');
            $ganadores_id       = $request->input('ganadores_id');
            $ejemplares_eventos = $request->input('ejemplares_eventos');
            $razas_ids          = $request->input('razas_ids');
            $num_pistas         = $request->input('pista');

            $mejorGrupo = null;
            $mejorReserva = null;

            $validacion = $this->verificaBesting($ejemplares_eventos, $calificaciones);

            if(count($ejemplares_eventos) >= 4)
                $maximo = 4;
            else
                $maximo = count($ejemplares_eventos);


            if($validacion['status'] && $validacion['contador'] == $maximo){

                foreach($numero_prefijos as $key => $npr){

                    $besting =  new  Besting();

                    $besting->creador_id            = Auth::user()->id;
                    $besting->categoria_pista_id    = $categorias_pistas[$key];
                    $besting->ejemplar_evento_id    = $ejemplares_eventos[$key];
                    $besting->raza_id               = $razas_ids[$key];
                    $besting->grupo_id              = $grupo_id;
                    $besting->evento_id             = $evento_id;
                    $besting->ejemplar_id           = $ejempleres_id[$key];
                    $besting->ganador_id            = $ganadores_id[$key];
                    $besting->numero_prefijo        = $npr;
                    $besting->lugar                 = $calificaciones[$key];
                    $besting->tipo                  = $tipo;
                    $besting->pista                 = $num_pistas;

                    $besting->save();

                    // buscamos a al mejor del grupo
                    if($besting->lugar == 1)
                        $mejorGrupo = $besting;

                    // buscamos a la reserva
                    if($besting->lugar == 2)
                        $mejorReserva = $besting;

                }

                if($mejorGrupo){
                    $mejorGrupo->mejor_grupo = "Si";
                    $mejorGrupo->save();
                }

                if($mejorReserva){
                    $mejorReserva->recerva_grupo = "Si";
                    $mejorReserva->save();
                }

                $data['status']         = 'success';
                $data['mejor_grupo']    = ($mejorGrupo)? $mejorGrupo->numero_prefijo : null;
                $data['reserva_grupo']  = ($mejorReserva)? $mejorReserva->numero_prefijo : null;
                $data['grupo']          = $besting->grupo_id;

                // madamos al mejor y a la reserva apra que peudan modificar
                if($mejorGrupo){

                    $data['finalistaMejor'] = '<div>
                                    <div class="form-group">
                                        <label>MEJOR DE GRUPO</label><br>
                                        Mejor de grupo => <small style="font-size: 15px" class="text-info">'.$mejorGrupo->numero_prefijo.'</small>
                                    </div>
                                </div>';
                }

                if($mejorReserva){

                    $data['finalistaMejorRecerva'] = '<div>
                                    <div class="form-group">
                                        <label>RECERVA DE GRUPO</label><br>
                                        Recerva de grupo => <small style="font-size: 15px" class="text-info">'.$mejorReserva->numero_prefijo.'</small>
                                    </div>
                                </div>';
                }

                
            }else{

                if($validacion['status']){

                    $data['status']                 = 'error_no_calificado';
                    $data['cantidad']               = $maximo;

                }else if($validacion['contador'] != $maximo){

                    $data['status']                 = 'error_repeat';
                    $data['ejemplares_repetidos']   = $validacion['ejemplares_repetidos'];
                    $data['grupo']                  = $grupo_id;
                    $data['tipo']                   = $tipo;

                }

            }


            // para los finalistas
            $finalistas = Juez::finalistasBesting($evento_id, $tipo, $num_pistas);

            $tbody = '';

            foreach ($finalistas as $key => $fi){
                $tbody = $tbody.'<td class="text-primary">
                                    <input type="hidden" value="'.$fi->id.'" name="bestinguids[]">
                                    <h2 class="text-center">'.$fi->numero_prefijo.'</h2>
                                    <br>
                                    <select name="posision[]" id="calificacion_final_'.$fi->numero_prefijo.'" class="form-control">
                                        <option value="1">Mejor</option>
                                        <option value="2">Segundo</option>
                                        <option value="3">Tercero</option>
                                        <option value="4">Cuarto</option>
                                        <option value="5">Quinto</option>
                                    </select>
                                    <small style="display: none;" class="text-warning" id="_calificacion_final_'.$fi->numero_prefijo.'">Calificacion repetida</small><br>
                                    <button class="btn btn-success btn-block" onclick="calificaFinal('.$key.', '.$fi->id.', '."'".$fi->numero_prefijo."'".')">CALIFICAR</button>
                                </td>';
            }

            $tableFinalistas = '
                                <table class="table table-bordered table-hover table-striped" style="width:100%;">
                                    <tbody>
                                        <tr>
                                        '.$tbody.'
                                        </tr>
                                    </tbody>
                                </table>
                                ';

            $data['finalistas']  = $tableFinalistas;

            return json_encode($data);

        }

    }

    private function verificaBesting($arryEjemplaresEventos, $arrayCalificacionesEnviados){

        $arrayEjemplaresRepetidos = array();
        $arrayCalificaciones = array();

        $data['status'] = true ;

        $contadorCalificaciones = 0;

        foreach ($arryEjemplaresEventos  as $key => $eje){

            if($arrayCalificacionesEnviados[$key]){
                if(!in_array($arrayCalificacionesEnviados[$key], $arrayCalificaciones)){

                    array_push($arrayCalificaciones, $arrayCalificacionesEnviados[$key]);

                    $contadorCalificaciones++;

                }else{
                    array_push($arrayEjemplaresRepetidos, $eje );
                    $data['status'] = false ;
                }
            }


        }
        $data['contador'] = $contadorCalificaciones;
        $data['ejemplares_repetidos'] = $arrayEjemplaresRepetidos;

        return $data;

    }

    public function calificaFinales(Request $request){

        if($request->ajax()){

            $ganador_id     = $request->input('ganador');
            $calificacion   = $request->input('calificacion');

            $ganador = Besting::find($ganador_id);

            $ganador->lugar_finalista = $calificacion;

            $ganador->save();

            // ********************* MANDAMOS A LOS GANADORES ********************
            $finalistas = Juez::finalistasBesting($ganador->evento_id, $ganador->tipo, $ganador->pista);

            $tbody = '';
            
            $arrayGruposExistentes = array();
            
            // PREGUNTAMOS POR LO SLUGARES ES EL UNICO
            $primero = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 1);
            $segundo = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 2);
            $tercer  = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 3);
            $cuarto  = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 4);
            $quinto  = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 5);

            foreach ($finalistas as $key => $fi){

                // dd($fi);
                
                if(!in_array($fi->grupo_id, $arrayGruposExistentes)){

                    array_push($arrayGruposExistentes, $fi->grupo_id);

                    // PREGUNTAMOS POR LO SLUGARES
                    $primero = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 1);
                    $segundo = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 2);
                    $tercer  = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 3);
                    $cuarto  = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 4);
                    $quinto  = Evento::ganadoresBesting($ganador->evento_id, $ganador->pista, $ganador->tipo, 5);

                    if($fi->lugar_finalista == '' || $fi->lugar_finalista == null){

                        $tbody = $tbody.'<td class="text-primary">
                                            <input type="hidden" value="'.$fi->id.'" name="bestinguids[]">
                                            <h2 class="text-center">'.$fi->numero_prefijo.'</h2>
                                            <br>
                                            <select name="posision[]" id="calificacion_final_'.$fi->numero_prefijo.'" class="form-control" required>
                                                <option '.(($primero)? 'disabled' : '').' value="1">Mejor</option>
                                                <option '.(($segundo)? 'disabled' : '').' value="2">Segundo</option>
                                                <option '.(($tercer)? 'disabled' : '').'  value="3">Tercero</option>
                                                <option '.(($cuarto)? 'disabled' : '').'  value="4">Cuarto</option>
                                                <option '.(($quinto)? 'disabled' : '').'  value="5">Quinto</option>
                                            </select>
                                            <small style="display: none;" class="text-warning" id="_calificacion_final_'.$fi->numero_prefijo.'">Calificacion repetida</small>
                                            <br>
                                            <button class="btn btn-success btn-block" onclick="calificaFinal('.$key.', '.$fi->id.', '."'".$fi->numero_prefijo."'".')">CALIFICAR</button>
                                        </td>';

                    }
                    // else{

                    //     $recervaSiguiente = Juez::getReservaSinCalificarSiguiente($fi->pista, $fi->tipo, $fi->grupo_id, $fi->lugar);

                    //     if($recervaSiguiente){

                    //         $tbody = $tbody.'<td class="text-primary">
                    //                             <input type="hidden" value="'.$recervaSiguiente->id.'" name="bestinguids[]">
                    //                             <h2 class="text-center">'.$recervaSiguiente->numero_prefijo.'</h2>
                    //                             <br>
                    //                             <select name="posision[]" id="calificacion_final_'.$recervaSiguiente->numero_prefijo.'" class="form-control" required>
                    //                                 <option '.(($primero)? 'disabled' : '').' value="1">Mejor</option>
                    //                                 <option '.(($segundo)? 'disabled' : '').' value="2">Segundo</option>
                    //                                 <option '.(($tercer)? 'disabled' : '').' value="3">Tercero</option>
                    //                                 <option '.(($cuarto)? 'disabled' : '').' value="4">Cuarto</option>
                    //                                 <option '.(($quinto)? 'disabled' : '').' value="5">Quinto</option>
                    //                             </select>
                    //                             <small style="display: none;" class="text-warning" id="_calificacion_final_'.$recervaSiguiente->numero_prefijo.'">Calificacion repetida</small>
                    //                             <br>
                    //                             <button class="btn btn-success btn-block" onclick="calificaFinal('.$key.', '.$recervaSiguiente->id.', '."'".$recervaSiguiente->numero_prefijo."'".')">CALIFICAR</button>
                    //                         </td>';
                    //     }

                    // }
                }
            }

            $tableFinalistas = '
                                <table class="table table-bordered table-hover table-striped" style="width:100%;">
                                    <tbody>
                                        <tr>
                                        '.$tbody.'
                                        </tr>
                                    </tbody>
                                </table>
                                ';

            $data['finalistas']  = $tableFinalistas;


            // MANDAREMOS LA TABLA CON LOS FINALISTAS
            $data['tablaFinalistasCalificados'] =  '<h3 class="text-primary text-center">GANADORES DE LA CATEGORIA</h3>
                                                    <table class="table table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>1ro</th>
                                                                <th>2do</th>
                                                                <th>3ro</th>
                                                                <th>4to</th>
                                                                <th>5to</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><span class="text-info fa-2x">'.(($primero)? $primero->numero_prefijo : '').'</span></td>
                                                                <td><span class="text-info fa-2x">'.(($segundo)? $segundo->numero_prefijo : '').'</span></td>
                                                                <td><span class="text-info fa-2x">'.(($tercer)? $tercer->numero_prefijo : '').'</span></td>
                                                                <td><span class="text-info fa-2x">'.(($cuarto)? $cuarto->numero_prefijo : '').'</span></td>
                                                                <td><span class="text-info fa-2x">'.(($quinto)? $quinto->numero_prefijo : '').'</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>';

            $data['status'] = 'success';

            return json_encode($data);
            
        }

    }

    public function planillaPDF(Request $request, $evento_id, $pista){

        if($pista != 0){
            // MANDAMOS LA ASIGANCION
            $asignacion = Asignacion::where('num_pista',$pista)
                                    ->where('evento_id',$evento_id)
                                    ->get();
                                    // ->first();
        }else{
            // MANDAMOS LA ASIGANCION
            $asignacion = Asignacion::where('evento_id',$evento_id)
                                    ->get();
        }

        // SACAMOS LOS GRUPOS DEL EVENTO
        $grupos = Juez::gruposEvento($evento_id);

        $arrayEjemplares = array();
        $arrayEjemplaresTotal = array();

        foreach ($grupos as $g){

            $emplares = Juez::ejemplaresGrupos($evento_id, $g->grupo_id);

            $arrayEjemplares = array(
                'grupo' => 'Grupo '.$g->grupo_id,
                'ejemplares' => $emplares
            );

            array_push($arrayEjemplaresTotal,$arrayEjemplares);

        }

        $pdf    = PDF::loadView('juez.planillaPDF', compact('evento_id', 'pista', 'arrayEjemplaresTotal', 'asignacion'));

        $pdf->setPaper('letter', 'landscape');

        return $pdf->stream('Planilla_'.date('Y-m-d H:i:s').'.pdf');    

    }

    public function bestingPDF(Request $request, $evento_id, $pista){

        $tipos = ['especiales', 'absolutos', 'jovenes', 'adultos'];
        
        $arrayTipos = array();

        foreach ($tipos as $t){

            $ganadores = Evento::bestingTipos($t, $evento_id, $pista);

            $grupo1 = array();
            $grupo2 = array();
            $grupo3 = array();
            $grupo4 = array();
            $grupo5 = array();
            $grupo6 = array();
            $grupo7 = array();
            $grupo8 = array();
            $grupo9 = array();
            $grupo10 = array();
            $grupo11 = array();

            $arrayGrupo = array();

            foreach ($ganadores as $g){

                switch ($g->grupo_id) {
                    case 1:
                        array_push($grupo1,$g);
                        break;
                    case 2:
                        array_push($grupo2,$g);
                        break;
                    case 3:
                        array_push($grupo3,$g);
                        break;
                    case 4:
                        array_push($grupo4,$g);
                        break;
                    case 5:
                        array_push($grupo5,$g);
                        break;
                    case 6:
                        array_push($grupo6,$g);
                        break;
                    case 7:
                        array_push($grupo7,$g);
                        break;
                    case 8:
                        array_push($grupo8,$g);
                        break;
                    case 9:
                        array_push($grupo9,$g);
                        break;
                    case 10:
                        array_push($grupo10,$g);
                        break;
                    case 11:
                        array_push($grupo11,$g);
                        break;
                }  
            }

            array_push($arrayGrupo, $grupo1);
            array_push($arrayGrupo, $grupo2);
            array_push($arrayGrupo, $grupo3);
            array_push($arrayGrupo, $grupo4);
            array_push($arrayGrupo, $grupo5);
            array_push($arrayGrupo, $grupo6);
            array_push($arrayGrupo, $grupo7);
            array_push($arrayGrupo, $grupo8);
            array_push($arrayGrupo, $grupo9);
            array_push($arrayGrupo, $grupo10);
            array_push($arrayGrupo, $grupo11);

            // SACAMOS LOS GANADORES
            // primer
            $primerLugar = Evento::getPuestoGanador($evento_id, $t, 1, $pista);

            // segundo
            $segundoLugar = Evento::getPuestoGanador($evento_id, $t, 2, $pista);

            // tercer
            $tercerLugar = Evento::getPuestoGanador($evento_id, $t, 3, $pista);

            // cuarto
            $cuartoLugar = Evento::getPuestoGanador($evento_id, $t, 4, $pista);

            // quinto
            $quintoLugar = Evento::getPuestoGanador($evento_id, $t, 5, $pista);

            $besting = array(
                'tipo'      =>  $t,
                'grupos'    =>  $arrayGrupo,
                'primero'   =>  $primerLugar,
                'segundo'   =>  $segundoLugar,
                'tercer'    =>  $tercerLugar,
                'cuarto'    =>  $cuartoLugar,
                'quinto'    =>  $quintoLugar
            );

            array_push($arrayTipos, $besting);
        }
    

        if($pista != 0){
            // // BUSCAMOS AL JUEZ DEL EVENTO
            $juez = Evento::getJuez($evento_id, $pista);
        }else{
            // MANDAMOS LA ASIGANCION
            $juez = Asignacion::where('evento_id',$evento_id)
                                    ->get();
        }


        // $pdf    = PDF::loadView('evento.generaBestingPdf', compact('ganadores', 'tipo', 'arrayGrupo', 'primerLugar', 'segundoLugar', 'tercerLugar', 'cuartoLugar', 'quintoLugar', 'juez'))->setPaper('letter', 'landscape');
        $pdf    = PDF::loadView('juez.bestingPDF', compact('arrayTipos', 'juez'))->setPaper('letter', 'landscape');

        return $pdf->stream('Planilla_'.date('Y-m-d H:i:s').'.pdf');      

    }

    public function certificacionExtrangero(Request $request){

        if($request->ajax()){

            $ganador_id         = $request->input('ganador');
            $tipoCertificacion  = $request->input('tipoCertificacion');

            $ganador = Ganador::find($ganador_id);

            if($tipoCertificacion == 1){

                if($ganador->certificacionCLACAB == "Si")
                    $ganador->certificacionCLACAB = null;
                else
                    $ganador->certificacionCLACAB = "Si";

                
            }else if($tipoCertificacion == 2){

                if($ganador->certificacionCACIB == "Si")
                    $ganador->certificacionCACIB = null;
                else
                    $ganador->certificacionCACIB = "Si";

            }

            $ganador->save();

            $data['status'] = 'success';

            return json_encode($data);

        }
    }

    public function exportarExcel(Request $request, $evento_id){

        $evento = Evento::find($evento_id);

        $ejemplares = EjemplarEvento::select('ejemplares_eventos.nombre_completo',
                                            'ejemplares_eventos.raza_id',
                                            'ejemplares_eventos.sexo',
                                            'ejemplares_eventos.ejemplar_id',
                                            'ejemplares_eventos.codigo_nacionalizado',
                                            'ejemplares_eventos.fecha_nacimiento',
                                            'ejemplares_eventos.propietario',
                                            'calificaciones.calificacion',
                                            'calificaciones.lugar',
                                            'calificaciones.pista',
                                            'ganadores.certificacionCLACAB',
                                            'ganadores.certificacionCACIB',
                                            'ejemplares_eventos.numero_prefijo'
                                            )
                                            ->leftjoin('calificaciones', 'ejemplares_eventos.id','=','calificaciones.ejemplares_eventos_id')
                                            ->leftjoin('ganadores', 'ejemplares_eventos.id','=', 'ganadores.ejemplar_evento_id')
                                            ->leftjoin('bestings', 'ejemplares_eventos.id','=', 'bestings.ejemplar_evento_id')
                                            ->where('ejemplares_eventos.evento_id',$evento->id)
                                            ->distinct()
                                            ->get();

        // generacion del excel
        $fileName = 'CalificacionEvento'.str_replace(' ', '_',$evento->nombre).'.xlsx';
        $libro = new Spreadsheet();

        $hoja = $libro->getActiveSheet();
        
        $hoja->setCellValue('A1', 'LISTA DE EJEMPLARES DEL EVENTO '.strtoupper($evento->nombre));
        $hoja->setCellValue('B2', 'NOMBRE');
        $hoja->setCellValue('C2', 'NUMERO');
        $hoja->setCellValue('D2', 'RAZA');
        $hoja->setCellValue('E2', 'KCB');
        $hoja->setCellValue('F2', 'SEXO');
        $hoja->setCellValue('G2', 'FECHA NACIMIENTO');
        $hoja->setCellValue('H2', 'PROPIETARIO');
        $hoja->setCellValue('I2', 'CALIFICACION');
        $hoja->setCellValue('J2', 'LUGAR');
        $hoja->setCellValue('K2', 'CERTIFIACION CLACAB');
        $hoja->setCellValue('L2', 'CERTIFIACION CACIB');

        $libro->getActiveSheet()->mergeCells('A1:L1');

        $contador = 3;

        foreach($ejemplares as $key => $eje){

            if($eje->ejemplar){
                $kcb = $eje->ejemplar->kcb;
            }else{
                $kcb = $eje->codigo_nacionalizado;
            }

            $hoja->setCellValue("B$contador", $eje->nombre_completo);
            $hoja->setCellValue("C$contador", $eje->numero_prefijo);
            $hoja->setCellValue("D$contador", ($eje->raza)? $eje->raza->nombre : '');
            $hoja->setCellValue("E$contador", $kcb);
            $hoja->setCellValue("F$contador", $eje->sexo);
            $hoja->setCellValue("G$contador", $eje->fecha_nacimiento);
            $hoja->setCellValue("H$contador", $eje->propietario);
            $hoja->setCellValue("I$contador", $eje->calificacion);
            $hoja->setCellValue("J$contador", $eje->lugar);
            $hoja->setCellValue("K$contador", ($eje->certificacionCLACAB != null)? $eje->certificacionCLACAB : '');
            $hoja->setCellValue("L$contador", ($eje->certificacionCACIB != null)? $eje->certificacionCACIB : '');
            // $hoja->setCellValue("M$contador", $eje->pista);

            $contador++;
        }

        $fuenteNegritaTitulo = array(
        'font'  => array(
            'bold'  => true,
            // 'color' => array('rgb' => 'FF0000'),
            'size'  => 20,
            // 'name'  => 'Verdana'
        ));

        $libro->getActiveSheet()->getStyle("A1")->applyFromArray($fuenteNegritaTitulo);

        $estilobor = $contador-1;

        $libro->getActiveSheet()->getStyle("B2:L$estilobor")->applyFromArray(
            array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('argb' => '000000')
                    )
                )
            )
        );

        $fuenteNegrita = array(
        'font'  => array(
            'bold'  => true,
        ));

        $libro->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $libro->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $libro->getActiveSheet()->getColumnDimension('D')->setWidth(50);
        $libro->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $libro->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $libro->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $libro->getActiveSheet()->getColumnDimension('H')->setWidth(60);
        $libro->getActiveSheet()->getColumnDimension('I')->setWidth(12);
        $libro->getActiveSheet()->getColumnDimension('J')->setWidth(9);
        $libro->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $libro->getActiveSheet()->getColumnDimension('L')->setWidth(15);


        $libro->getActiveSheet()->getStyle('A2:L2')->applyFromArray($fuenteNegrita);

        $style = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            )
        );

        $hoja->getStyle("A1")->applyFromArray($style);
        $hoja->getStyle("A2:L2")->applyFromArray($style);

        // exportamos el excel
        $writer = new Xlsx($libro);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

    }

    public function addCategoriaAsignacion(Request $request){

        if($request->ajax()){

            // dd($request->all());
            $asignacion_id = $request->input('add_categoria_asignacion_id');

            $asignacion = Asignacion::find($asignacion_id);

            $asignacion->categorias = $request->input('categoriasAdd');

            $asignacion->save();

            $data['status'] = 'success';

            $asiganaciones = Asignacion::where('evento_id',$asignacion->evento_id)->get();
            $faltantes = 0;

            $data['listado'] = view('evento.ajaxListadoAsignacion', compact('asiganaciones', 'faltantes'))->render();

            return json_encode($data);

        }

    }

    public function categoriasAsignadas(Request $request){

        if($request->ajax()){

            $asignacion_id = $request->input('asigancion');

            $asignacion = Asignacion::find($asignacion_id);

            $data['status'] = 'success';

            $data['categorias'] = json_decode($asignacion->categorias);

            return json_encode($data);
        }

    }

    public function cambiaCertificado(Request $request){
        if($request->ajax()){

            $participantes  = $request->input('existentes');
            $eligido        = $request->input('ganador');

            // dd($request->all());
            $participante = null;

            foreach ($participantes as $p){

                
                if($eligido != $p && $p != 0){
                    
                    $participante = Ganador::find($p);

                    if($participante){
                        $participante->estado = 0;
                        $participante->puntos = null;
                        $participante->save();

                        // $data['perdedor'] = $participante->id;
                    }

                }else{

                    if($eligido == $p){

                        $ganador = Ganador::find($p);

                        // dd($gandor, $request->input('puntos'));
                        // dd($ganador->puntos);

                        $ganador->puntos = $request->input('puntos');

                        $ganador->save();

                    }

                    $restaurar = Ganador::find($p);

                    if($restaurar){
                        $restaurar->estado = 1;
                        $restaurar->save();
                    }

                    // $data['perdedor'] = 0;

                }
            }

            $data['status'] = 'success';

            if($participante)
                $data['perdedor'] = $participante->id;
            else
                $data['perdedor'] = 0;

            return json_encode($data);

        }
    }
}