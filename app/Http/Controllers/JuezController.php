<?php

namespace App\Http\Controllers;

use PDF;
use App\Juez;
use App\Raza;
use App\Grupo;

use App\Evento;
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

        // dd($request->all());
        
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
        // $juez->fecha_nacimiento         = $request->input('fecha_nacimiento');
        // $juez->direccion                = $request->input('direccion');
        // $juez->celulares                = $request->input('celulares');
        $juez->departamento             = $request->input('departamento');

        if($request->file('imgInp')){

            // subiendo el archivo al servidor
            $archivo    = $request->file('imgInp');

            $direcion   = "imagenesJueces/";
            $nombreArchivo = date('YmdHis').".".$archivo->getClientOriginalExtension();
            $archivo->move($direcion,$nombreArchivo);

            $juez->foto             = $nombreArchivo;

        }

        $juez->save();

        return redirect('Juez/listado');
    }

    public function elimina(Request $request, $juez_id){

        Juez::destroy($juez_id);
        
        return redirect('Juez/listado');
    }

    public function ajaxguardaAsignacionEvento(Request $request){

        $asignacion = new  Asignacion();

        $asignacion->user_id        = Auth::user()->id;
        $asignacion->juez_id        = $request->input('juez_id');
        $asignacion->secretario_id  = $request->input('secretario_id');
        $asignacion->evento_id      = $request->input('asignacion_evento_id');

        $asignacion->save();

        $evento_id = $request->input('asignacion_evento_id');
        
        $asiganaciones  = Asignacion::where('evento_id',$evento_id)->get();

        return view('evento.ajaxListadoAsignacion')->with(compact('asiganaciones'));
        // dd(Asignacion::all());
    }

    public function ajaxListadoAsignacion(Request $request){

        $evento_id = $request->input('evento_id');

        $asiganaciones  = Asignacion::where('evento_id',$evento_id)->get();

        return view('evento.ajaxListadoAsignacion')->with(compact('asiganaciones'));
    }

    public function ajaxEliminaAsignacion(Request $request){

        $asignacion_id = $request->input('asignacion_id');

        $evento_id = Asignacion::find($asignacion_id)->evento_id;

        Asignacion::destroy($asignacion_id);

        $asiganaciones  = Asignacion::where('evento_id',$evento_id)->get();

        return view('evento.ajaxListadoAsignacion')->with(compact('asiganaciones'));
    }

    public function calificacion(Request $request){

        // return view('juez.calificacion')->with(compact('asiganaciones'));

        $user_id = Auth::user()->id;

        $asignaciones = Asignacion::where('secretario_id',$user_id)->get();

        $cantidadAsignaciones = Asignacion::where('secretario_id',$user_id)->count();

        // dd($cantidadAsignaciones);

        return view('juez.calificacion')->with(compact('asignaciones','cantidadAsignaciones'));

    }

    public function ponderacion(Request $request, $evento_id, $grupo_id, $raza_id){

        $raza = Raza::find($raza_id);

        // return view('juez.calificacion')->with(compact());
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

        // dd($abiertas);

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
        // return view('juez.ponderacion')->with(compact('cachorros', 'jovenes', 'jovenesCampeones', 'intermedia', 'abiertas', 'campeones', 'GranCampeones', 'veteranos', 'evento'));
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

        // return redirect('Juez/ponderacion/'.$inscripcion->evento_id);
        
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

    // esta funcion me devuelve en PDF
    // public function planilla(Request $request, $evento_id, $grupo_id, $raza_id){

    //     $raza = Raza::find($raza_id);

    //     $cachorrosMacho = Calificacion::where('evento_id', $evento_id)
    //                             ->where('sexo',"Macho")
    //                             ->where('raza_id',$raza_id)
    //                             ->WhereIn('categoria_id',[1,2,11])
    //                             ->get();

    //     $jovenMacho = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Macho")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[3,4])
    //                         ->get();

    //     $jovenCampeonMacho = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Macho")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[12,13])
    //                         ->get();

    //     $intermediaMacho = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Macho")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[5,6])
    //                         ->get();

    //     $abiertaMacho = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Macho")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[7,8])
    //                         ->get();

    //     $campeonesMacho = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Macho")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[9,10])
    //                         ->get();

    //     $GrandesCampeonesMacho = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Macho")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[14,15])
    //                         ->get();

    //     $veteranosMacho = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Macho")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[16,17])
    //                         ->get();

    //     // hembras
    //     $cachorrosHembra = Calificacion::where('evento_id', $evento_id)
    //                             ->where('sexo',"Hembra")
    //                             ->where('raza_id',$raza_id)
    //                             ->WhereIn('categoria_id',[1,2,11])
    //                             ->get();

    //     $jovenHembra = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Hembra")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[3,4])
    //                         ->get();

    //     $jovenCampeonHembra = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Hembra")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[12,13])
    //                         ->get();

    //     $intermediaHembra = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Hembra")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[5,6])
    //                         ->get();

    //     $abiertaHembra = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Hembra")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[7,8])
    //                         ->get();

    //     $campeonesHembra = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Hembra")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[9,10])
    //                         ->get();

    //     $GrandesCampeonesHembra = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Hembra")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[14,15])
    //                         ->get();

    //     $veteranosHembra = Calificacion::where('evento_id', $evento_id)
    //                         ->where('sexo',"Hembra")
    //                         ->where('raza_id',$raza_id)
    //                         ->WhereIn('categoria_id',[16,17])
    //                         ->get();

    //     $datoPlanilla = Calificacion::where('evento_id', $evento_id)
    //                                 ->where('raza_id', $raza_id)
    //                                 ->where('grupo_id', $grupo_id)
    //                                 ->get();

    //     // return view('juez.planilla')->with(compact('raza', 'cachorrosMacho', 'jovenMacho', 'jovenCampeonMacho', 'intermediaMacho', 'abiertaMacho', 'campeonesMacho', 'GrandesCampeonesMacho', 'veteranosMacho', 'cachorrosHembra', 'jovenHembra', 'jovenCampeonHembra', 'intermediaHembra', 'abiertaHembra', 'campeonesHembra', 'GrandesCampeonesHembra', 'veteranosHembra', 'datoPlanilla'));

    //     $pdf    = PDF::loadView('juez.planilla', compact('raza', 'cachorrosMacho', 'jovenMacho', 'jovenCampeonMacho', 'intermediaMacho', 'abiertaMacho', 'campeonesMacho', 'GrandesCampeonesMacho', 'veteranosMacho', 'cachorrosHembra', 'jovenHembra', 'jovenCampeonHembra', 'intermediaHembra', 'abiertaHembra', 'campeonesHembra', 'GrandesCampeonesHembra', 'veteranosHembra', 'datoPlanilla'))->setPaper('letter', 'landscape');

    //     return $pdf->stream('Planilla_'.date('Y-m-d H:i:s').'.pdf');        
    // }

    public function categorias(Request $request, $evento_id){

        
        $evento = Evento::find($evento_id);
        
        $arrayEjemplares = array();
        $arrayEjemplaresTotal = array();

        for($i = 1; $i <= 10 ; $i++){

            $emplares = Juez::ejemplaresGrupos($evento_id, $i);

            $arrayEjemplares = array(
                'grupo' => 'Grupo '.$i,
                'ejemplares' => $emplares
            );

            array_push($arrayEjemplaresTotal,$arrayEjemplares);

        }

        return view('juez.categorias')->with(compact('evento', 'arrayEjemplaresTotal'));


        
        // $ejemplaresEspeciales = EjemplarEvento::select(DB::raw('count(raza_id) as cantRaza, raza_id'))
        //                             ->where("categoria_pista_id",1)
        //                             ->where("evento_id",$evento_id)
        //                             ->groupBy('raza_id')
        //                             ->get();

        // $arrayEjemplares = array(
        //     'nombre'        => 'Especiales',
        //     'ejemplares'    => $ejemplaresEspeciales
        // );

        // array_push($arrayEjemplaresTotal,$arrayEjemplares);

        // $ejemplaresAbsolutos = EjemplarEvento::select(DB::raw('count(raza_id) as cantRaza, raza_id'))
        //                             ->where(function($query){
        //                                 $query->orwhere("categoria_pista_id",11)
        //                                 ->orwhere("categoria_pista_id",2);
        //                             })
        //                             ->where("evento_id",$evento_id)
        //                             ->groupBy('raza_id')
        //                             ->get();

                                    
        // $arrayEjemplares = array(
        //     'nombre'        => 'Absolutos',
        //     'ejemplares'    => $ejemplaresAbsolutos
        // );

        // array_push($arrayEjemplaresTotal,$arrayEjemplares);

        // $ejemplaresJovenes = EjemplarEvento::select(DB::raw('count(raza_id) as cantRaza, raza_id'))
        //                             ->where("evento_id",$evento_id)
        //                             ->whereIn("categoria_pista_id",[3,4,12,13])
        //                             ->groupBy('raza_id')
        //                             ->get();

        // $arrayEjemplares = array(
        //     'nombre'        => 'Jovenes',
        //     'ejemplares'    => $ejemplaresJovenes
        // );

        // array_push($arrayEjemplaresTotal,$arrayEjemplares);

        // $ejemplaresAdulto = EjemplarEvento::select(DB::raw('count(raza_id) as cantRaza, raza_id'))
        //                             ->where("evento_id",$evento_id)
        //                             ->whereIn("categoria_pista_id",[5,6,7,8,9,10,14,15,16,17,18,19,20])
        //                             ->groupBy('raza_id')
        //                             ->get();

        // $arrayEjemplares = array(
        //     'nombre'        => 'Adultos',
        //     'ejemplares'    => $ejemplaresAdulto
        // );

        // array_push($arrayEjemplaresTotal,$arrayEjemplares);

        // // dd($arrayEjemplaresTotal);

        // return view('juez.categorias')->with(compact('evento', 'arrayEjemplaresTotal'));

        // return view('juez.categorias')->with(compact('evento', 'ejemplaresEspeciales', 'ejemplaresAbsolutos', 'ejemplaresJovenes', 'ejemplaresAdulto'));

    }

    // public function AjaxPlanillaCalificacion(Request $request){

    //     $evento_id  = $request->input('evento_id');
    //     $ejemplares = $request->input('ejemplares');

    //     $arrayEjemplaresDevuetos = array();

    //     foreach ($ejemplares as $eje){

    //         $arraySeparado = explode(",", $eje);

    //         $dato = Juez::ejemplaresCategoria($arraySeparado[0], $evento_id, $arraySeparado[1 ]);

    //         array_push($arrayEjemplaresDevuetos, $dato);

    //     }

    //     $data['formulario'] = view('juez.AjaxformularioCalificaion', compact('arrayEjemplaresDevuetos'))->render();

    //     return json_encode($data);
    // }

    // public function AjaxEjemplarCatalogoRaza(Request $request){

    //     $categoria_id  = $request->input('categoria');
    //     $raza_id  = $request->input('raza');
    //     $evento_id  = $request->input('evento');

    //     $ejemplares = Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

    //     if($ejemplares[0]->sexo == "Hembra"){
    //         $color = 'style="color: #F94EE4 ;"';
    //     }else{
    //         $color = 'class="text-primary"';
    //     }

    //     $htmlIni = '
    //         <form action="" id="formularioCalificacionCategoria">
    //             <table class="table table-hover text-center">
    //                 <thead>
    //                     <tr>
    //                         <th '.$color.' colspan="3">
    //                             <h2>EJEMPLARES</h2>
    //                         </th>
    //                     </tr>
    //                     <tr  '.$color.' >
    //                         <th>
    //                             N~
    //                         </th>
    //                         <th>
    //                             Calif.
    //                         </th>
    //                         <th>
    //                             Lugar
    //                         </th>
    //                     </tr>
    //                 </thead>
    //                 <tbody>
    //                 ';
    //                     $htmlBody ='';

    //                     foreach ($ejemplares as $eje){

    //                         $htmlBody = $htmlBody.'<tr>
    //                                                     <td>
    //                                                         <input type="hidden" name="ejemplar_evento_id_ejemplar[]" value="'.$eje->id.'">
    //                                                         <input type="hidden" name="raza_id_ejemplar[]" value="'.$raza_id.'">
    //                                                         <input type="hidden" name="evento_id_ejemplar[]" value="'.$evento_id.'">
    //                                                         <input type="hidden" name="categoria_id_ejemplar[]" value="'.$categoria_id.'">
    //                                                         <input type="hidden" name="sexo_ejemplar[]" value="'.$eje->sexo.'">
    //                                                         <input type="hidden" name="numero_prefijo_ejemplar[]" value="'.$eje->numero_prefijo.'">
    //                                                         <input type="hidden" name="ejemplar_id_ejemplar[]" value="'.$eje->ejemplar_id.'">
    //                                                         <h1 '.$color.'>'.$eje->numero_prefijo.'</h1>
    //                                                         <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
    //                                                     </td>
    //                                                     <td>
    //                                                         <select name="calificacion_ejemplar[]" id="calificacion_ejemplar" class="form-control">
    //                                                             <option value="Excelente">Excelente</option>
    //                                                             <option value="Muy Bien">Muy Bien</option>
    //                                                             <option value="Bien">Bien</option>
    //                                                             <option value="Descalificado">Descalificado</option>
    //                                                             <option value="Ausente">Ausente</option>
    //                                                         </select>
    //                                                         <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
    //                                                     </td>
    //                                                     <td>
    //                                                         <select name="lugar_ejemplar[]" id="lugar_ejemplar" class="form-control">
    //                                                             <option value="1">1</option>
    //                                                             <option value="2">2</option>
    //                                                             <option value="3">3</option>
    //                                                             <option value="4">4</option>
    //                                                             <option value="5">5</option>
    //                                                         </select>
    //                                                         <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
    //                                                     </td>
    //                                                 </tr>';
                            
    //                     }

    //     $htmlFin = '
    //                 </tbody>
    //             </table>
    //         </form>

    //             <hr>
    //             <div class="row">
    //                 <div class="col-md-12">
    //                     <button onclick="finalizarCalificacion()" type="button" class="btn btn-success btn-block">Finalizar Calificacion</button>
    //                 </div>
    //             </div>
    //             ';

    //     $table =  $htmlIni.$htmlBody.$htmlFin;

    //     $data['table'] = $table;
    //     $data['status'] = 'success';

    //     return json_encode($data);
    // }
    
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

        $categoria = CategoriasPista::find($categoria_id)[0]->nombre;
        
        // verificamos si las calificaciones o el lugar esta repoedido 
        $valida = $this->validaCalificaciones($ejemplares_eventos, $calificaciones, $lugares);

        $arrayRepetidos = array();
        $arrayMejorEjemplar = array();

        if($valida['status']){

            foreach ($ejemplares_eventos as $key => $e){

                $cantidadEjemplarRepetido = Juez::verificaEjemplar(intval($e), $categoria_id[0], $numero_prefijos[$key]);

                if($cantidadEjemplarRepetido == 0){

                    $calificacion = new  Calificacion();
        
                    $calificacion->creador_id               = Auth::user()->id;
                    $calificacion->ejemplares_eventos_id    = intval($e);
                    $calificacion->evento_id                = $evento_id[0];
                    $calificacion->ejemplar_id              = $ejemplares[$key];
                    $calificacion->raza_id                  = $raza_id[0];
                    $calificacion->categoria_id             = $categoria_id[0];
                    $calificacion->sexo                     = $sexo[0];
                    $calificacion->grupo_id                 = $grupo[0];
                    $calificacion->numero_prefijo           = $numero_prefijos[$key];
                    $calificacion->calificacion             = $calificaciones[$key];
                    $calificacion->lugar                    = $lugares[$key];
        
                    $calificacion->save();

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
                            'grupo'              => $grupo[0],
                            'lugar'                 => $lugares[$key]

                        );

                    }

                }else{

                    array_push($arrayRepetidos,intval($e));
                }

    
            }

            // preguntamos si hay mejor de la categoria y agregamos al mejor
            if(count($arrayMejorEjemplar) > 0){

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

                $ganador->save();

                $ganadorConfir = true;

                // $data['ganadorhtml'] = '<div class="row">
                //                             <div class="col-md-4">
                //                                 <input type="text" class="form-control" disabled value="'.$ganador->numero_prefijo.'">
                //                             </div>
                //                             <div class="col-md-4">
                //                                 <input type="text" class="form-control" disabled value="'.$ganador->calificacion.'">
                //                             </div>
                //                             <div class="col-md-4">
                //                                 <input type="text" class="form-control" disabled value="'.$ganador->lugar.'">
                //                             </div>
                //                         </div>';

                                        
                $data['ganadorhtml'] = '<table class="table table-hover" id="tabla_ganador">
                                            <thead>
                                                <tr>
                                                    <th>N~</th>
                                                    <th>Calificacion</th>
                                                    <th>Lugar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr onclick="escogerMejor('.$ganador->id.','."'".$ganador->numero_prefijo."'".')">
                                                    <td>'.$ganador->numero_prefijo.'</td>
                                                    <td>'.$ganador->calificacion.'</td>
                                                    <td>'.$ganador->lugar.'</td>
                                                </tr>
                                            </tbody>
                                        </table>';

                $data['categoria'] = str_replace(['(',')',' '],'',$categoria);;
                
            }else{

                $ganadorConfir = false;

            }
            

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

    // public function ajaxGanadores(Request $request){

    //     $raza_id = $request->input('raza');
    //     $evento_id = $request->input('evento');

    //     // ESTO ES PARA LOS MACHOS
    //     $tableBodytd = '';
    //     $tableCabezaraTh = '';

    //     $cachorroMacho              = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 11);

    //     if($cachorroMacho){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>CACHORRO</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$cachorroMacho->numero_prefijo.'</td>';

    //     }

    //     $jovenMacho                 = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 3);

    //     if($jovenMacho){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>JOVEN</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$jovenMacho->numero_prefijo.'</td>';
            
    //     }

    //     $jovenCampeonMacho          = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 12);

    //     if($jovenCampeonMacho){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>JOVEN CAMPEON</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$jovenCampeonMacho->numero_prefijo.'</td>';
            
    //     }
        
    //     $intermediaMacho            = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 5);

    //     if($intermediaMacho){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>INTERMEDIA</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$intermediaMacho->numero_prefijo.'</td>';
            
    //     }
        
    //     $abiertaMacho               = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 7);

    //     if($abiertaMacho){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>ABIERTA</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$abiertaMacho->numero_prefijo.'</td>';
            
    //     }
        
    //     $campeonMacho               = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 9);

    //     if($campeonMacho){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>CAMPEON</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$campeonMacho->numero_prefijo.'</td>';
            
    //     }
        
    //     $grandesCampeonesMacho      = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 14);

    //     if($grandesCampeonesMacho){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>GRANDES CAMPEONES</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$grandesCampeonesMacho->numero_prefijo.'</td>';
            
    //     }

    //     $tableCabeza = '
    //         <table class="table table-hover text-center">
    //             <thead>
    //                 <tr>
    //                 '.$tableCabezaraTh.'
    //                 </tr>
    //             </thead>
    //             <tbody>
    //                 <tr>
    //         ';
            
    //     $tablePie = '
    //                 </tr>
    //             </tbody>
    //         </table>
    //     ';

    //     $table = $tableCabeza.$tableBodytd.$tablePie;

    //     $data['table_machos'] = $table;


    //     // AHORA PARA LAS HEMBRAS
    //     $tableBodytd = '';
    //     $tableCabezaraTh = '';
    //     $jovenes = false;

    //     $cachorroHembra              = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 2);

    //     if($cachorroHembra){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>CACHORRO</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$cachorroHembra->numero_prefijo.'</td>';

    //     }

    //     $jovenHembra                 = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 4);

    //     if($jovenHembra){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>JOVEN</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$jovenHembra->numero_prefijo.'</td>';
            
    //     }

    //     $jovenCampeonHembra          = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 13);

    //     if($jovenCampeonHembra){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>JOVEN CAMPEON</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$jovenCampeonHembra->numero_prefijo.'</td>';
            
    //     }

    //     if($jovenHembra && $jovenCampeonHembra){

    //         $jovenes = true;

    //     }
        
    //     $intermediaHembra            = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 6);

    //     if($intermediaHembra){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>INTERMEDIA</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$intermediaHembra->numero_prefijo.'</td>';
            
    //     }
        
    //     $abiertaHembra               = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 8);

    //     if($abiertaHembra){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>ABIERTA</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$abiertaHembra->numero_prefijo.'</td>';
            
    //     }
        
    //     $campeonHembra               = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 10);

    //     if($campeonHembra){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>CAMPEON</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$campeonHembra->numero_prefijo.'</td>';
            
    //     }
        
    //     $grandesCampeonesHembra      = Juez::ganadorEjemplarEvento($raza_id, $evento_id, 15);

    //     if($grandesCampeonesHembra){

    //         $tableCabezaraTh    = $tableCabezaraTh.'<th>GRANDES CAMPEONES</th>';
    //         $tableBodytd = $tableBodytd.'<td>'.$grandesCampeonesHembra->numero_prefijo.'</td>';
            
    //     }

    //     $tableCabeza = '
    //         <table class="table table-hover text-center">
    //             <thead>
    //                 <tr>
    //                 '.$tableCabezaraTh.'
    //                 </tr>
    //             </thead>
    //             <tbody>
    //                 <tr>
    //         ';

    //     if($jovenes){

    //         $pie = '<select class="form-control">
    //                     <option value="">SELECCIONE MEJOR JOVEN HEMBRA</option>
    //                     <option value="">'.$jovenHembra->numero_prefijo.'</option>
    //                     <option value="">'.$jovenCampeonHembra->numero_prefijo.'</option>
    //                 </select>';

    //     }else{
    //         $pie = '';
    //     }
            
    //     $tablePie = '
    //                 </tr>
    //             </tbody>
    //             <tfoot>
    //                 <tr>
    //                     <th></th>
                        
    //                     <th colspan="2">'.$pie.'</th>
    //                 </tr>
    //             </tfoot>
    //         </table>
    //     ';

    //     $table = $tableCabeza.$tableBodytd.$tablePie;

    //     $data['table_hembras'] = $table;


    //     return json_encode($data);

    // }

    public function ajaxCategoriasCalificacion(Request $request){

        // dd($request->all());

        $categorias = $request->input('categorias');
        $raza_id    = $request->input('raza');
        $evento_id  = $request->input('evento');

        $tablePrincipal = '';
        $data['tables'] = '';

        $cantidadCategorias = count($categorias);

        if($cantidadCategorias == 1){
            $columna = 'class="col-md-12"';

            $data['divGanadoresCategorias'] = '<div class="row">
                                                    <div class="col-md-12">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[0]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                </div>';
        }elseif($cantidadCategorias == 2){
            $columna = 'class="col-md-6"';

            $data['divGanadoresCategorias'] = '<div class="row">
                                                    <div class="col-md-6">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[0]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[1]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                </div>';
        }elseif($cantidadCategorias == 3){
            $columna = 'class="col-md-4"';

            $data['divGanadoresCategorias'] = '<div class="row">
                                                    <div class="col-md-4">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[0]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[1]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[2]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                </div>';
        }elseif($cantidadCategorias == 4){
            $columna = 'class="col-md-3"';

            $data['divGanadoresCategorias'] = '<div class="row">
                                                    <div class="col-md-3">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[0]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[1]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[2]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div id="ganador_'.str_replace([' ','(',')'],'',$categorias[3]['nombre']).'" style="display: none;"></div>
                                                    </div>
                                                </div>';
        }


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

                                                    <h1 class="text-primary">'.$eje->numero_prefijo.'</h1>
                                                    <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                                                </td>
                                                <td>
                                                    <select name="calificacion_ejemplar[]" id="calificacion_ejemplar" class="form-control">
                                                        <option value="Excelente">Excelente</option>
                                                        <option value="Muy Bien">Muy Bien</option>
                                                        <option value="Bien">Bien</option>
                                                        <option value="Descalificado">Descalificado</option>
                                                        <option value="Ausente">Ausente</option>
                                                    </select>
                                                    <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                                                </td>
                                                <td>
                                                    <select name="lugar_ejemplar[]" id="lugar_ejemplar" class="form-control">
                                                        <option value="1">Primero</option>
                                                        <option value="2">Segundo</option>
                                                        <option value="3">Tercero</option>
                                                        <option value="4">Cuarto</option>
                                                        <option value="5">Quinto</option>
                                                    </select>
                                                    <small style="display: none;" class="_'.$eje->id.' text-warning">Dato repetido</small>
                                                </td>
                                            </tr>';

            }

                    $tableFoooter = $tableFoooter.'</tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button id="button_'.str_replace([' ','(',')'],'',$ca['nombre']).'" type="button" class="btn btn-success btn-block" onclick="finalizarCalificacion('."'".str_replace([' ','(',')'],'',$ca['nombre'])."'".')">Finalizar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>';

            $data['tables'] = $data['tables'].$tablePrincipal.$tableCabeza.$tableBody.$tableFoooter;

        }

        return json_encode($data);

    }

    public function ajaxCalificacionMejor(Request $request){

        $ganador_id = $request->input('ganador');

        $ganador = Ganador::find($ganador_id);

        $ganador->mejor_escogido = "Si";

        $ganador->save();

        if($ganador->categoria_id == 2 || $ganador->categoria_id == 11) {
            $mejor = "MEJOR CACHORRO";
        }else if($ganador->categoria_id == 3 || $ganador->categoria_id == 4 || $ganador->categoria_id == 12 || $ganador->categoria_id == 13){  
            $mejor = "MEJOR JOVEN";
        }else if($ganador->categoria_id == 5 || $ganador->categoria_id == 6 || $ganador->categoria_id == 7 || $ganador->categoria_id == 8 || $ganador->categoria_id == 9 || $ganador->categoria_id == 10 || $ganador->categoria_id == 14 || $ganador->categoria_id == 15){
            $mejor = "MEJOR ADULTO";
        }

        $data['mejor'] = '<div class="row text-center">
                            <div class="col-md-6">
                                <h5 class="text-success">'.$mejor.'</h5>
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-info">'.$ganador->numero_prefijo.'</h3>
                            </div>
                        </div>';

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


        // dd($ejemplaresJoven);

        // dd($request->all());

        $data['planilla'] = view('juez.planilla', compact('ejemplaresCachorroAbsolutos', 'ejemplaresJoven', 'ejemplaresJovenCampeonMacho', 'ejemplaresIntermediaMacho', 'ejemplaresAbiertaMacho', 'ejemplaresCampeonesMacho', 'ejemplaresGrandesCampeoesMacho'))->render();

        return json_encode($data);
    }

    public function ajaxGanadores(Request $request){

        if($request->ajax()){

            // dd($request->all());

            $raza_id    = $request->input('raza');
            $evento_id  = $request->input('evento');

            // PRIMERO PARA LOS MACHOS
            // CACHORRO
            $cachorro = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [11], "Macho");

            // JOVEN o JOVEN CAMPEON
            $joven = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [3, 12], "Macho");

            // ADULTO
            $adulto = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [5, 7, 9, 14], "Macho");

            // VENTERANO
            $veterano = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [16], "Macho");
            
            $tableMacho = '<div class="row">
                                <div class="col-md-6">
                                    <div class="radio-inline">
                                        <label class="radio radio-rounded radio-primary">
                                            CACHORRO => <small style="font-size:15px" class="text-primary border p-1">'.(($cachorro)? $cachorro->numero_prefijo : "").'</small>
                                        </label>

                                        <label class="radio radio-rounded radio-primary">
                                            JOVEN => <small style="font-size:15px" class="text-primary border p-1">'.(($joven)? $joven->numero_prefijo : "").'</small>
                                            '.(($joven)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_joven" value="'.$joven->id.'" name="mejor_macho"/><span></span>' : '').'
                                        </label>
                                        <label class="radio radio-rounded radio-primary">
                                            ADULTO => <small style="font-size:15px" class="text-primary border p-1">'.(($adulto)? $adulto->numero_prefijo : "").'</small>
                                            '.(($adulto)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_adulto" value="'.$adulto->id.'" name="mejor_macho"/><span></span>' : '').'
                                        </label>
                                        <label class="radio radio-rounded radio-primary">
                                            VETERANO => <small style="font-size:15px" class="text-primary border p-1">'.(($veterano)? $veterano->numero_prefijo : "").'</small>
                                            '.(($veterano)? '<p class="pl-1"></p><input type="radio" id="mejor_macho_veterano" value="'.$veterano->id.'" name="mejor_macho"/><span></span>' : '').'
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <button type="button" onclick="mejorVencedores('."'macho'".')" class="btn btn-icon btn-success"><i class="fa fa-align-center" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-md-9">
                                                    <div id="mejor_macho_vencedor" style="display: none"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                           </div>
                            ';


            // SEGUNDO PARA LOS HEMBRAS
            // CACHORRO
            $cachorroHembra = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [2], "Hembra");

            // JOVEN o JOVEN CAMPEON
            $jovenHembra = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [4, 13], "Hembra");

            // ADULTO
            $adultoHembra = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [6, 8, 10, 15], "Hembra");

            // VENTERANO
            $veteranoHembra = Juez::ganadorEjemplarEvento($raza_id, $evento_id, [17], "Hembra");
            
            $tableHembra = '
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="radio-inline">
                                        <label class="radio radio-rounded radio-danger">
                                            CACHORRO => <small style="color: #F94EE4;  font-size:15px" class="border p-1">'.(($cachorroHembra)? $cachorroHembra->numero_prefijo : "").'</small>
                                        </label>

                                        <label class="radio radio-rounded radio-danger">
                                            JOVEN => <small style="color: #F94EE4;  font-size:15px" class="border p-1">'.(($jovenHembra)? $jovenHembra->numero_prefijo : "").'</small>
                                            '.(($jovenHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_joven" value="'.$jovenHembra->id.'" name="mejor_hembra"/><span></span>' : '').'
                                        </label>
                                        <label class="radio radio-rounded radio-danger">
                                            ADULTO => <small style="color: #F94EE4;  font-size:15px" class="border p-1">'.(($adultoHembra)? $adultoHembra->numero_prefijo : "").'</small>
                                            '.(($adultoHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_adulto" value="'.$adultoHembra->id.'" name="mejor_hembra"/><span></span>' : '').'
                                        </label>
                                        <label class="radio radio-rounded radio-danger">
                                            VETERANO => <small style="color: #F94EE4;  font-size:15px" class="border p-1">'.(($veteranoHembra)? $veteranoHembra->numero_prefijo : "").'</small>
                                            '.(($veteranoHembra)? '<p class="pl-1"></p><input type="radio" id="mejor_hembra_jveterano" value="'.$veteranoHembra->id.'" name="mejor_hembra"/><span></span>' : '').'
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <button type="button" onclick="mejorVencedores('."'hembra'".')" class="btn btn-icon" style="background: #F94EE4;"><i class="fa fa-align-center text-white" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="col-md-9">
                                                    <div id="mejor_hembra_vencedor" style="display: none"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';

            $data['status'] = 'success';
            $data['tableMachos'] = $tableMacho;
            $data['tableHembras'] = $tableHembra;


            // AHORA VAMOS A PONER LOS SELECT PARA SELECIONAR MEJRO CACHORRO, JOVEN Y RAZA
            // CACHORRO
            $selectCachorro = '<select class="form-control" name="select_cachorro_mejor" id="select_cachorro_mejor">';

            $selectBod= '';

            if($cachorro){
                $selectBod = $selectBod.'<option value="'.$cachorro->id.'">'.$cachorro->numero_prefijo.'</option>';
            }
            if($cachorroHembra){
                $selectBod = $selectBod.'<option value="'.$cachorroHembra->id.'">'.$cachorroHembra->numero_prefijo.'</option>';
            }
            
            $data['selectCachorro'] = $selectCachorro.$selectBod.'</select><br><button type="button" onclick="guardaMejor('."'".'cachorro'."'".')" class="btn btn-success btn-block">Guardar Mejor Cachorro</button>';

            // AHORA PARA LOS JOVENES
            $selectCachorro = '<select class="form-control" name="select_joven_mejor" id="select_joven_mejor">';

            $selectBod= '';

            if($joven){
                $selectBod = $selectBod.'<option value="'.$joven->id.'">'.$joven->numero_prefijo.'</option>';
            }
            if($jovenHembra){
                $selectBod = $selectBod.'<option value="'.$jovenHembra->id.'">'.$jovenHembra->numero_prefijo.'</option>';
            }

            $data['selectJoven'] = $selectCachorro.$selectBod.'</select><br><button  type="button" onclick="guardaMejor('."'".'joven'."'".')"  class="btn btn-success btn-block">Guardar Mejor Joven</button>';



            return json_encode($data);

        }

    }

    public function mejorVencedores(Request $request){

        if($request->ajax()){

            $ganador_id = $request->input('vencedor');

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
                                <div class="col-md-12">
                                    <h5 class="text-success text-center"> MEJOR '.(($ganador->sexo == 'Macho')? 'MACHO =>': 'HEMBRA =>').'<span class="text-info">'.$ganador->numero_prefijo.'</span></h5>
                                </div>
                            </div>';

            // PARA EL SELCE DE MEJRO RAZA
            $selecRaza = '<select  name="select_raza_mejor" id="select_raza_mejor" class="form-control">';

            $bodySelect = '';

            $datos = Juez::getMejorMachooHebra($ganador->raza_id, $ganador->evento_id, [3,4,5,6,7,8,9,10,14,15]);

            foreach ($datos as $d){
                $bodySelect = $bodySelect.'<option value="'.$d->id.'">'.$d->numero_prefijo.'</option>';
            }

            $data['selectMejoresRaza'] = $selecRaza.$bodySelect.'</select><br><button type="button"  onclick="guardaMejor('."'".'raza'."'".')"   class="btn btn-success btn-block">Guardar Mejor de la Raza</button>';

            return json_encode($data);

        }

    }

    public function mejorRazaFinPlanilla(Request $request){

        // dd($request->all());
        if($request->ajax()){
            $ganador_id = $request->input('vencedor');
            $tipo       = $request->input('tipo');

            $ganador = Ganador::find($ganador_id);

            $mejorSexopuesto = '';

            if($tipo == "cachorro"){

                $ganador->mejor_cachorro = "Si";

                $sexoOpuesto =  Juez::getsexoOpuesto($ganador->raza_id, $ganador->evento_id, [2, 11], $ganador->sexo, "mejor_cachorro");

                if($sexoOpuesto){

                    $sexoOpuesto->sexo_opuesto_cachorro = "Si";

                    $sexoOpuesto->save();


                }

            }elseif($tipo == "joven"){

                $ganador->mejor_joven = "Si";

                $sexoOpuesto =  Juez::getsexoOpuesto($ganador->raza_id, $ganador->evento_id, [3, 4, 12, 13], $ganador->sexo, "mejor_joven");

                if($sexoOpuesto){

                    $sexoOpuesto->sexo_opuesto_joven = "Si";

                    $sexoOpuesto->save();
                }

            }else{

                $ganador->mejor_raza = "Si";

                $sexoOpuesto =  Juez::getsexoOpuesto($ganador->raza_id, $ganador->evento_id, [3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17], $ganador->sexo, "mejor_raza");

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

            $tipo = $request->input('tipo');
            $evento_id = $request->input('evento');

            if($tipo == "especiales"){
                $ganadores = Juez::ejemplaresCategoria('Especiales', $evento_id,[1,2,3,4,5,6,7,8,9,10]); 
            }elseif($tipo == "absolutos"){
                $ganadores = Juez::getGanadores($evento_id, [2,11], 'mejor_cachorro');
            }elseif($tipo == "jovenes"){
                $ganadores = Juez::getGanadores($evento_id, [3,4,12,13], 'mejor_joven');
            }elseif($tipo == "adultos"){
                $ganadores = Juez::getGanadores($evento_id, [5,6,7,8,9,10,14,15], 'mejor_raza');
            }

            
            $data['table']  =  view('juez.besting', compact('ganadores'))->render();

            return json_encode($data);

        }

    }
}
