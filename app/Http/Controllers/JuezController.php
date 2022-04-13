<?php

namespace App\Http\Controllers;

use App\Juez;
use App\Raza;
use App\Grupo;
use App\Evento;

use App\GrupoRaza;
use App\Asignacion;
use App\Calificacion;
use App\EjemplarEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;

use PDF;

class JuezController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listado(Request $request){

        $jueces = Juez::all();

        return view('juez.listado')->with(compact('jueces'));
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
        $juez->fecha_nacimiento         = $request->input('fecha_nacimiento');
        $juez->direccion                = $request->input('direccion');
        $juez->celulares                = $request->input('celulares');
        $juez->departamento             = $request->input('departamento');

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

        $cachorros = Calificacion::where('evento_id', $evento_id)
                                ->where('raza_id',$raza_id)
                                ->WhereIn('categoria_id',[1,2,11])
                                ->get();

        $joven = Calificacion::where('evento_id', $evento_id)
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[3,4])
                            ->get();

        $jovenCampeon = Calificacion::where('evento_id', $evento_id)
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[12,13])
                            ->get();

        $intermedia = Calificacion::where('evento_id', $evento_id)
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[5,6])
                            ->get();

        $abierta = Calificacion::where('evento_id', $evento_id)
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[7,8])
                            ->get();

        $campeones = Calificacion::where('evento_id', $evento_id)
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[9,10])
                            ->get();

        $GrandesCampeones = Calificacion::where('evento_id', $evento_id)
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[14,15])
                            ->get();

        $veteranos = Calificacion::where('evento_id', $evento_id)
                            ->where('raza_id',$raza_id)
                            ->WhereIn('categoria_id',[16,17])
                            ->get();

        // dd($cachorros);
        // dd("holas");

        // $anio = $request->input('anio');

        // $ejemplares = DB::table('ejemplares')
        //                 ->join('razas', 'ejemplares.raza_id', '=', 'razas.id')
        //                 ->groupBy('ejemplares.raza_id')
        //                 ->orderBy('razas.nombre', 'asc')
        //                 ->get();

        return view('juez.planilla')->with(compact('raza', 'cachorros', 'joven', 'jovenCampeon', 'intermedia', 'abierta', 'campeones', 'GrandesCampeones', 'veteranos'));

        // $pdf    = PDF::loadView('juez.planilla', compact('raza', 'cachorros', 'joven', 'jovenCampeon', 'intermedia', 'abierta', 'campeones', 'GrandesCampeones', 'veteranos'))->setPaper('letter');

        // return $pdf->stream('boletinInscripcion_'.date('Y-m-d H:i:s').'.pdf');        
    }
}
