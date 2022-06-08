<?php

namespace App\Http\Controllers;

use PDF;
use App\Juez;
use App\Raza;
use App\Grupo;

use App\Evento;
use App\GrupoRaza;
use App\Asignacion;
use App\Calificacion;
use App\CategoriaJuez;
use App\EjemplarEvento;
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

    public function planilla(Request $request, $evento_id, $grupo_id, $raza_id){

        $raza = Raza::find($raza_id);

        $cachorrosMacho = Calificacion::where('evento_id', $evento_id)
                                ->where('sexo',"Macho")
                                ->where('raza_id',$raza_id)
                                ->WhereIn('categoria_id',[1,2,11])
                                ->get();

        $jovenMacho = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Macho")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[3,4])
                            ->get();

        $jovenCampeonMacho = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Macho")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[12,13])
                            ->get();

        $intermediaMacho = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Macho")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[5,6])
                            ->get();

        $abiertaMacho = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Macho")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[7,8])
                            ->get();

        $campeonesMacho = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Macho")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[9,10])
                            ->get();

        $GrandesCampeonesMacho = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Macho")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[14,15])
                            ->get();

        $veteranosMacho = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Macho")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[16,17])
                            ->get();

        // hembras
        $cachorrosHembra = Calificacion::where('evento_id', $evento_id)
                                ->where('sexo',"Hembra")
                                ->where('raza_id',$raza_id)
                                ->WhereIn('categoria_id',[1,2,11])
                                ->get();

        $jovenHembra = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Hembra")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[3,4])
                            ->get();

        $jovenCampeonHembra = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Hembra")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[12,13])
                            ->get();

        $intermediaHembra = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Hembra")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[5,6])
                            ->get();

        $abiertaHembra = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Hembra")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[7,8])
                            ->get();

        $campeonesHembra = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Hembra")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[9,10])
                            ->get();

        $GrandesCampeonesHembra = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Hembra")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[14,15])
                            ->get();

        $veteranosHembra = Calificacion::where('evento_id', $evento_id)
                            ->where('sexo',"Hembra")
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[16,17])
                            ->get();

        $datoPlanilla = Calificacion::where('evento_id', $evento_id)
                                    ->where('raza_id', $raza_id)
                                    ->where('grupo_id', $grupo_id)
                                    ->get();

        // return view('juez.planilla')->with(compact('raza', 'cachorrosMacho', 'jovenMacho', 'jovenCampeonMacho', 'intermediaMacho', 'abiertaMacho', 'campeonesMacho', 'GrandesCampeonesMacho', 'veteranosMacho', 'cachorrosHembra', 'jovenHembra', 'jovenCampeonHembra', 'intermediaHembra', 'abiertaHembra', 'campeonesHembra', 'GrandesCampeonesHembra', 'veteranosHembra', 'datoPlanilla'));

        $pdf    = PDF::loadView('juez.planilla', compact('raza', 'cachorrosMacho', 'jovenMacho', 'jovenCampeonMacho', 'intermediaMacho', 'abiertaMacho', 'campeonesMacho', 'GrandesCampeonesMacho', 'veteranosMacho', 'cachorrosHembra', 'jovenHembra', 'jovenCampeonHembra', 'intermediaHembra', 'abiertaHembra', 'campeonesHembra', 'GrandesCampeonesHembra', 'veteranosHembra', 'datoPlanilla'))->setPaper('letter', 'landscape');

        return $pdf->stream('Planilla_'.date('Y-m-d H:i:s').'.pdf');        
    }

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

    public function AjaxPlanillaCalificacion(Request $request){

        $evento_id  = $request->input('evento_id');
        $ejemplares = $request->input('ejemplares');

        $arrayEjemplaresDevuetos = array();

        foreach ($ejemplares as $eje){

            $arraySeparado = explode(",", $eje);

            $dato = Juez::ejemplaresCategoria($arraySeparado[0], $evento_id, $arraySeparado[1 ]);

            array_push($arrayEjemplaresDevuetos, $dato);

        }

        $data['formulario'] = view('juez.AjaxformularioCalificaion', compact('arrayEjemplaresDevuetos'))->render();

        return json_encode($data);
    }

    public function AjaxEjemplarCatalogoRaza(Request $request){

        $categoria_id  = $request->input('categoria');
        $raza_id  = $request->input('raza');
        $evento_id  = $request->input('evento');

        $ejemplares = Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

        
        if($ejemplares[0]->sexo == "Hembra"){
            $color = 'style="color: #F94EE4 ;"';
        }else{
            $color = 'class="text-primary"';
        }

        $htmlIni = '
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th '.$color.' colspan="3">
                                <h2>EJEMPLARES</h2>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                        $htmlBody ='';

                        foreach ($ejemplares as $eje){

                            $htmlBody = $htmlBody.'<tr>
                                                        <td>
                                                            <h1 '.$color.'>'.$eje->numero_prefijo.'</h1>
                                                        </td>
                                                        <td>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">Excelente</option>
                                                                <option value="">Muy Bien</option>
                                                                <option value="">Bien</option>
                                                                <option value="">Descalificado</option>
                                                                <option value="">Ausente</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">1</option>
                                                                <option value="">2</option>
                                                                <option value="">3</option>
                                                                <option value="">4</option>
                                                                <option value="">5</option>
                                                            </select>
                                                        </td>
                                                    </tr>';
                            
                        }

        $htmlFin = '
                    </tbody>
                </table>
                ';

            $table =  $htmlIni.$htmlBody.$htmlFin;

        // while ($contador < $cantEjemplares){

        //     $html = $html.'<div class="row">';

        //     for($i = 0; $i < 4; $i++){
        //         if($contador < $cantEjemplares){
                                    
        //             $html = $html." <div class='col-md-3'>
        //                                 <p style='20px'></p>
        //                                 <button onclick='calificar(\"".$ejemplares[$contador]->numero_prefijo."\")' class='btn btn-success btn-block'><b class='text-white' style='font-size: 20px;'>".$ejemplares[$contador]->numero_prefijo."</b></button>
        //                             </div>";

        //             $contador++;
        //         }
        //     }

        //     $html = $html.'</div>';

        // }

        $data['table'] = $table;
        $data['status'] = 'success';

        return json_encode($data);
    }
}
