<?php

namespace App\Http\Controllers;

use App\Raza;
use App\User;

use App\Ejemplar;
use App\ExamenMascota;
use App\Transferencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EjemplarController extends Controller
{
    public function formulario(Request $request, $id)
    {
        if ($id != 0) {
            $ejemplar = Ejemplar::find($id);
        } else {
            $ejemplar = null;
        }

        $razas = Raza::all();

        return view('ejemplar.formulario')->with(compact('ejemplar', 'razas'));
    }

    public function ajaxBuscaEjemplar(Request $request)
    {
        // dd($request->all());
        $queryEjemplares = Ejemplar::query();

        $queryEjemplares->where('sexo', $request->input('sexo'));

        if($request->filled('kcb')){
            $kcb = $request->input('kcb');
            $queryEjemplares->where('kcb', 'like', "%$kcb%");
        }

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $queryEjemplares->where('nombre', 'like', "%$nombre%");
        }

        $queryEjemplares->limit(8);

        $ejemplares = $queryEjemplares->get();

        return view('ejemplar.ajaxBuscaEjemplar')->with(compact('ejemplares'));
    }

    public function listado(Request $request)
    {
        $razas = Raza::all();
        $propietarios = User::where('perfil_id', 4)
                            ->get();

        return view('ejemplar.listado')->with(compact('ejemplares', 'razas', 'propietarios'));
    }

    public function ajaxListado(Request $request)
    {
        $queryEjemplares = Ejemplar::orderBy('id', 'desc');
                            
        if ($request->filled('kcb_buscar')) {
            $kcb = $request->input('kcb_buscar');
            $queryEjemplares->where('kcb', $kcb);
        }

        if ($request->filled('nombre_buscar')) {
            $nombre = $request->input('nombre_buscar');
            $queryEjemplares->where('nombre', 'like', "%$nombre%");
        }

        if ($request->filled('chip_buscar')) {
            $chip = $request->input('chip_buscar');
            $queryEjemplares->where('chip', 'like', "%$chip%");
        }

        if ($request->filled('raza_buscar')) {
            $raza_id = $request->input('raza_buscar');
            $queryEjemplares->where('raza_id', $raza_id);
        }

        if ($request->filled('propietario_buscar')) {
            $propietario_id = $request->input('propietario_buscar');
            $queryEjemplares->where('propietario_id', $propietario_id);
        }

        if ($request->filled('kcb_buscar') || $request->filled('nombre_buscar') || $request->filled('chip_buscar') || $request->filled('raza_buscar') || $request->filled('propietario_buscar')) {
            $queryEjemplares->limit(300);
        }else{
            $queryEjemplares->limit(200);
        }


        $ejemplares = $queryEjemplares->get();
        
        return view('ejemplar.ajaxListado')->with(compact('ejemplares'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si existe el ejemplar
        if($request->input('ejemplar_id') == 0){
            // en caso que sea nuevo el formulariuo mandara 0
            // y procedemos a crear un nuevo registro
            $ejemplar = new Ejemplar();
        }else{
            // en el caso que no sea 0 entonces mandara un id del ejemplar
            // buscamos el id del ejemplar para actualizar los datos mandados del formulario
            $ejemplar = Ejemplar::find($request->input('ejemplar_id'));
        }

        // Procedemos con el seteo 

        $ejemplar->user_id              = Auth::user()->id;
        $ejemplar->madre_id             = $request->input('madre_id');
        $ejemplar->padre_id             = $request->input('padre_id');
        $ejemplar->raza_id              = $request->input('raza_id'); 
        $ejemplar->criadero_id          = $request->input('criadero_id');
        $ejemplar->propietario_id       = $request->input('propietario_id');
        $ejemplar->kcb                  = $request->input('kcb');
        $ejemplar->codigo_nacionalizado = $request->input('codigo_nacionalizado');
        $ejemplar->num_tatuaje          = $request->input('num_tatuaje');
        $ejemplar->chip                 = $request->input('chip');
        $ejemplar->fecha_nacimiento     = $request->input('fecha_nacimiento');
        $ejemplar->color                = $request->input('color');
        $ejemplar->senas                = $request->input('senas');
        $ejemplar->nombre               = $request->input('nombre');
        $ejemplar->primero_mostrar      = $request->input('primero_mostrar');
        $ejemplar->prefijo              = $request->input('prefijo');
        $ejemplar->lechigada            = $request->input('lechigada');
        $ejemplar->sexo                 = $request->input('sexo');
        $ejemplar->origen               = $request->input('origen_nacionalizado');
        $ejemplar->consanguinidad       = $request->input('consanguinidad');
        $ejemplar->hermano              = $request->input('hermano');
        $ejemplar->departamento         = $request->input('departamento');
        $ejemplar->fecha_fallecido      = $request->input('fecha_fallecido');
        $ejemplar->fecha_emision        = $request->input('fecha_emision');
        $ejemplar->fecha_nacionalizado  = $request->input('fecha_nacionalizado');
        $criadero = Ejemplar::find($request->input('criadero_id'));
        if($request->input('primero_mostrar') == "Nombre"){
            $nombreCompleto = $ejemplar->nombre;
            if($request->input('prefijo') == ""){
                $nombreCompleto = $nombreCompleto." ";
            }else{
                $nombreCompleto = $nombreCompleto." ".$request->input('prefijo')." ";
            }
            $nombreCompleto = $nombreCompleto.$criadero->nombre;
        }else{
            $nombreCompleto = $criadero->nombre;
            if($request->input('prefijo') == ""){
                $nombreCompleto = $nombreCompleto." ";
            }else{
                $nombreCompleto = $nombreCompleto." ".$request->input('prefijo')." "; 
            }
            $nombreCompleto = $nombreCompleto." ".$ejemplar->nombre;
        }
        $ejemplar->nombre_completo      = $nombreCompleto;
        
        //precedemos con el guardado de datos 
        $ejemplar->save();

        // sacamos el id para mostrar el registro
        $ejemplarId = $ejemplar->id;

        // sacamos sus examenes
        // $examenes = ExamenMascota::where('ejemplar_id', $ejemplarId)
        //                 ->get();
        
        
        // dd($examenes);

        // redirigimos a la vista
        return redirect("Ejemplar/formulario/$ejemplarId");
        // return view('ejemplar.formulario')->with(compact('ejemplar', 'razas','examenes'));
    }

    public function ajaxGuardaExamen(Request $request){
        // dd($request->all());

        $nuevoExamen               = new ExamenMascota();
        $nuevoExamen->user_id      = 1;
        $nuevoExamen->ejemplar_id  = $request->input('ejemplar_examen_id');
        $nuevoExamen->examen_id    = 1;
        $nuevoExamen->fecha_examen = $request->input('fecha_examen');
        $nuevoExamen->resultado    = $request->input('resultado');
        $nuevoExamen->save();

        $examenesEjemplar = ExamenMascota::where('ejemplar_id', $request->input('ejemplar_examen_id'))
                            ->orderBy('id', 'desc')  
                            ->get();

        return view('ejemplar.ajaxGuardaExamen')->with(compact('examenesEjemplar'));

        
    }

    public function ajaxEliminaExamen(Request $request){

        $examenEjemplar = ExamenMascota::find($request->idExamen);

        $eliminaExamen = ExamenMascota::destroy($request->idExamen);

        $examenesEjemplar = ExamenMascota::where('ejemplar_id', $examenEjemplar->ejemplar_id)
                                            ->orderBy('id', 'desc')  
                                            ->get();

        return view('ejemplar.ajaxGuardaExamen')->with(compact('examenesEjemplar'));

    }


    // TRANSFERENCIAS

    public function ajaxGuardaTransferencia(request $request){

        $transferencia = new Transferencia();

        $transferencia->user_id                 = Auth::user()->id;
        $transferencia->propietario_id          = $request->input('transferencia_propietario_id');
        $transferencia->ejemplar_id             = $request->input('transferencia_ejemplar_id');
        $transferencia->fecha_transferencia     = $request->input('transferencia_fecha_transferencia');
        $transferencia->estado                  = $request->input('transferencia_estado');
        if($request->input('transferencia_pedigree') == null){
            $transferencia->pedigree_exportacion    = "No";
        }else{
            $transferencia->pedigree_exportacion    = "Si";
        }
        $transferencia->fecha_exportacion       = $request->input('transferencia_fecha_exportacion');
        $transferencia->pais_destino            = $request->input('transferencia_pais_destino');
        
        $transferencia->save();

        $ejemplarTransferencias = Transferencia::Where('ejemplar_id', $request->input('transferencia_ejemplar_id'))
                                        ->orderBy('id', 'desc')  
                                        ->get();

        return view('ejemplar.ajaxGuardaTransferencia')->with(compact('ejemplarTransferencias'));
    }

    public function ajaxEliminaTransferencia(Request $request){

        $transferencia = Transferencia::find($request->idTransferencia);

        $eliminaTransferencia = Transferencia::destroy($request->idTransferencia);

        $ejemplarTransferencias = Transferencia::where('ejemplar_id', $transferencia->ejemplar_id)
                                            ->orderBy('id', 'desc')  
                                            ->get();

        return view('ejemplar.ajaxGuardaTransferencia')->with(compact('ejemplarTransferencias'));


        // $examenEjemplar = ExamenMascota::find($request->idExamen);

        // $eliminaExamen = ExamenMascota::destroy($request->idExamen);

        // $examenesEjemplar = ExamenMascota::where('ejemplar_id', $examenEjemplar->ejemplar_id)
        //                                     ->orderBy('id', 'desc')  
        //                                     ->get();

        // return view('ejemplar.ajaxGuardaExamen')->with(compact('examenesEjemplar'));

    }

}
