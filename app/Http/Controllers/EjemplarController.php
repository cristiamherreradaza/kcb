<?php

namespace App\Http\Controllers;

use App\Raza;
use App\User;

use App\Camada;
use App\Examen;
use App\Titulo;
use App\Alquiler;
use App\Criadero;
use App\Ejemplar;
use App\ExamenMascota;
use App\Modificacione;
use App\Transferencia;
use App\TituloEjemplar;
use Illuminate\Http\Request;
use App\ModificacionEspecifico;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EjemplarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formulario(Request $request, $id)
    {
        if ($id != 0) {
            $ejemplar = Ejemplar::find($id);
        } else {
            $ejemplar = null;
        }

        $razas = Raza::all();

        $titulos = Titulo::all();

        $examenes = Examen::all();

        return view('ejemplar.formulario')->with(compact('ejemplar', 'razas', 'titulos', 'examenes'));
    }

    public function ajaxBuscaEjemplar(Request $request)
    {
        // dd($request->all());
        $queryEjemplares = Ejemplar::query();

        if($request->input('sexo') != "todos"){
            $queryEjemplares->where('sexo', $request->input('sexo'));
            $camada = false;
        }else{
            $camada = true;
        }

        if($request->filled('kcb')){
            $kcb = $request->input('kcb');
            $queryEjemplares->where('kcb', 'like', "%$kcb%");
        }

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $queryEjemplares->where('nombre', 'like', "%$nombre%");
        }
        
        if($request->filled('raza')){
            $raza = $request->input('raza');
            $queryEjemplares->where('raza_id',$raza);
        }

        $queryEjemplares->limit(8);

        $ejemplares = $queryEjemplares->get();

        
        return view('ejemplar.ajaxBuscaEjemplar')->with(compact('ejemplares', 'camada'));
    }


    public function ajaxBuscaEjemplarEdita(Request $request)
    {
        // dd($request->all());
        $queryEjemplares = Ejemplar::query();

        $raza = $request->input('raza');
        $queryEjemplares->where('raza_id', '=', "$raza");

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

        return view('ejemplar.ajaxBuscaEjemplarEdita')->with(compact('ejemplares'));
    }

    public function listado(Request $request)
    {
        $razas = Raza::all();
        $propietarios = User::where('perfil_id', 4)
                            ->get();

        return view('ejemplar.listado')->with(compact('razas', 'propietarios'));
    }

    public function listadoExtranjero(Request $request)
    {
        $razas = Raza::all();
        $propietarios = User::where('perfil_id', 4)
                            ->get();

        return view('ejemplar.listadoExtranjero')->with(compact('razas', 'propietarios'));
    }

    public function ajaxListadoExtranjero(Request $request)
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

        $queryEjemplares->where('extranjero', 'si');

        if ($request->filled('kcb_buscar') || $request->filled('nombre_buscar') || $request->filled('chip_buscar') || $request->filled('raza_buscar') || $request->filled('propietario_buscar')) {
            $queryEjemplares->limit(300);
        }else{
            $queryEjemplares->limit(200);
        }


        $ejemplares = $queryEjemplares->get();
        
        return view('ejemplar.ajaxListadoExtranjero')->with(compact('ejemplares'));
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

        $queryEjemplares->whereNull('extranjero');

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
        // dd($request->all());
        // dd($request->input('extranjero'));
        // preguntamos si existe el ejemplar
        if($request->input('ejemplar_id') == 0){
            // en caso que sea nuevo el formulariuo mandara 0
            // y procedemos a crear un nuevo registro
            $ejemplar = new Ejemplar();
        }else{
            // en el caso que no sea 0 entonces mandara un id del ejemplar
            // buscamos el id del ejemplar para actualizar los datos mandados del formulario
            $ejemplar = Ejemplar::find($request->input('ejemplar_id'));
            // $datosEjemplarOriginal = Ejemplar::where('id', $request->input('ejemplar_id'))
                                                // ->get();
            $datosOriginales = $ejemplar->attributesToArray();

            // dd($datosOriginales);

            //implementar caso para log en la tabla modificaciones
            // enviamos los valores para el guardado de logs en la tabla
            $this->guardaModificacion('ejemplares', $request->input('ejemplar_id'), $datosOriginales, $request->all());
        }

        // Procedemos con el seteo 

        $ejemplar->user_id              = Auth::user()->id;
        $ejemplar->madre_id             = $request->input('madre_id');
        $ejemplar->padre_id             = $request->input('padre_id');
        $ejemplar->raza_id              = $request->input('raza_id'); 
        $ejemplar->criadero_id          = $request->input('criadero_id');
        $ejemplar->propietario_id       = $request->input('propietario_id');
        $ejemplar->kcb                  = $request->input('kcb');
        if($request->input('extranjero')){
            $ejemplar->extranjero       = 'si';
        }else{
            $ejemplar->extranjero       = null;
        }
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
        $ejemplar->fecha_perdido        = $request->input('fecha_perdido');
        $ejemplar->fecha_emision        = $request->input('fecha_emision');
        $ejemplar->descripcion_perdido  = $request->input('descripcion_perdido');
        $ejemplar->fecha_nacionalizado  = $request->input('fecha_nacionalizado');

        if($request->input('criadero_id')){
            $criadero = Criadero::find($request->input('criadero_id'));
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
        }else{
            $ejemplar->nombre_completo      = $request->input('nombre');
        }
        
        
        //precedemos con el guardado de datos 
        $ejemplar->save();

        // sacamos el id para mostrar el registro
        $ejemplarId = $ejemplar->id;

        // agregar un nuevo alquiler de camadas
        if($request->input('alquiler_value')){
            // dd("si");
            $alquiler = new Alquiler();

            $alquiler->user_id                      = Auth::user()->id;
            $alquiler->criadero_id                  = $request->input('criadero_id');
            $alquiler->ejemplar_id                  = $ejemplarId;
            $alquiler->propietario_original_id      = $request->input('propietario_id');
            $alquiler->propietario_alquilado_id     = $request->input('alquiler_propietario_id');
            $ultimoNumero                           = Alquiler::where("criadero_id",$request->input('criadero_id'))
                                                    ->latest()
                                                    ->first();
            if($ultimoNumero){
                // sacamos el ultimo registro
                $alquiler->numero                   = $ultimoNumero->numero + 1;
            }else{
                // no existe el alquilados de este criadero asi que comenzamos de 1
                $alquiler->numero                   = 1;
            }
            $alquiler->fecha                        = $request->input('alquiler_propietario_fecha');
            
            // proseguimos al guardado del nuevo alquiler

            $alquiler->save();
            // $alquiler->numero
        }

        // redirigimos a la vista
        return redirect("Ejemplar/formulario/$ejemplarId");
        // return view('ejemplar.formulario')->with(compact('ejemplar', 'razas','examenes'));
    }

    public function ajaxGuardaExamen(Request $request){
        // dd($request->all());
        if($request->input('examen-ejemplar-id') != 0){
            $nuevoExamen = ExamenMascota::find($request->input('examen-ejemplar-id'));
            $nuevoExamen->modificador_id           = Auth::user()->id;
        }else{
            $nuevoExamen                    = new ExamenMascota();
            $nuevoExamen->user_id           = Auth::user()->id;
        }
        $nuevoExamen->ejemplar_id       = $request->input('ejemplar_examen_id');
        $nuevoExamen->examen_id         = $request->input('nombre_examen');
        $nuevoExamen->fecha_examen      = $request->input('fecha_examen');
        $nuevoExamen->dcf               = $request->input('examen_dcf');
        $nuevoExamen->resultado         = $request->input('resultado');
        $nuevoExamen->observacion       = $request->input('obserbacion');
        $nuevoExamen->numero_formulario = $request->input('examen_num_formulario');
        $nuevoExamen->revisor           = $request->input('doctor_examen');
        $nuevoExamen->save();

        $examenesEjemplar = ExamenMascota::where('ejemplar_id', $request->input('ejemplar_examen_id'))
                            ->orderBy('id', 'desc')  
                            ->get();

        $this->addbitacora($request->input('ejemplar_examen_id'), 'EXAMEN', '',$nuevoExamen->examen->nombre, 'Agregado');

        return view('ejemplar.ajaxGuardaExamen')->with(compact('examenesEjemplar'));
    }

    public function ajaxEliminaExamen(Request $request){

        $examenEjemplar = ExamenMascota::find($request->idExamen);

        $examenEjemplar->eliminador_id = Auth::user()->id;

        $eliminaExamen = ExamenMascota::destroy($request->idExamen);

        $examenesEjemplar = ExamenMascota::where('ejemplar_id', $examenEjemplar->ejemplar_id)
                                            ->orderBy('id', 'desc')  
                                            ->get();
                    
        $examenEjemplar->save();

        // dd($examenEjemplar->nombre);

        // de aqui guardamos en la tabnla modificaiones especificas

        $this->addbitacora($examenEjemplar->ejemplar_id, 'EXAMEN', '',$examenEjemplar->examen->nombre, 'Eliminado');




        return view('ejemplar.ajaxGuardaExamen')->with(compact('examenesEjemplar'));

    }

    // TRANSFERENCIAS

    public function ajaxGuardaTransferencia(request $request){

        // ponemos anteriror a todas las demas transferencias por que habra uno nuevo qeu sera el dueño actual
        $ejemplares_anteriores = Transferencia::where('ejemplar_id',$request->input('transferencia_ejemplar_id'))
                                            ->get();

        foreach($ejemplares_anteriores as $ea){

            $ea->estado = "Anterior";
            $ea->save();

        }

        // cambiamos en la tabla ejemplares el nuevo id del nuevo propietarios
        $ejemplar = Ejemplar::find($request->input('transferencia_ejemplar_id'));
        $ejemplar->propietario_id = $request->input('transferencia_propietario_id');
        $ejemplar->save();

        //registramos el nuevo camio de propietario en la tabla transferenciuas
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

        $this->addbitacora($request->input('transferencia_ejemplar_id'), 'TRAMSFERENCIA', '',$transferencia->propietario->name, 'Agregado');


        return view('ejemplar.ajaxGuardaTransferencia')->with(compact('ejemplarTransferencias'));
    }

    public function ajaxEliminaTransferencia(Request $request){

        $transferencia = Transferencia::find($request->idTransferencia);

        $transferencia->eliminador_id = Auth::user()->id;


        $eliminaTransferencia = Transferencia::destroy($request->idTransferencia);

        $ejemplarTransferencias = Transferencia::where('ejemplar_id', $transferencia->ejemplar_id)
                                            ->orderBy('id', 'desc')  
                                            ->get();

        $transferencia->save();

        $this->addbitacora($transferencia->ejemplar_id, 'TRAMSFERENCIA', '',$transferencia->propietario->name, 'Eliminado');

        return view('ejemplar.ajaxGuardaTransferencia')->with(compact('ejemplarTransferencias'));
    }


    // TITULOS
    public function ajaxGuardaTitulo(request $request){

        $titulosEjemplar = new TituloEjemplar();

        $titulosEjemplar->user_id           = Auth::user()->id;
        $titulosEjemplar->titulo_id         = $request->input('titulo_titulo_id');
        $titulosEjemplar->ejemplar_id       = $request->input('titulo_ejemplar_id');
        $titulosEjemplar->fecha_obtencion   = $request->input('titulo_fecha_obtencion');

        $titulosEjemplar->save();

        $titulosEjemplares                  = TituloEjemplar::where('ejemplar_id', $request->input('titulo_ejemplar_id'))
                                                            ->orderBy('id', 'desc')
                                                            ->get();

        $this->addbitacora($request->input('titulo_ejemplar_id'), 'TITULO', '',$titulosEjemplar->titulo->nombre, 'Agregado');

        
        return view('ejemplar.ajaxGuardaTitulo')->with(compact('titulosEjemplares'));
    }

    public function ajaxEliminaTitulo(Request $request){

        $tituloEjemplar = TituloEjemplar::find($request->idTituloEjemplar);

        $tituloEjemplar->eliminador_id = Auth::user()->id;


        $eliminaTitulo = TituloEjemplar::destroy($request->idTituloEjemplar);

        $titulosEjemplares = TituloEjemplar::where('ejemplar_id', $tituloEjemplar->ejemplar_id)
                                            ->orderBy('id', 'desc')  
                                            ->get();

        $tituloEjemplar->save();

        $this->addbitacora($tituloEjemplar->ejemplar_id, 'TITULO', '',$tituloEjemplar->titulo->nombre, 'Eliminado');


        return view('ejemplar.ajaxGuardaTitulo')->with(compact('titulosEjemplares'));
    }

    public function informacion(Request $request, $ejemplarId)
    {
        // dd($id);
        $ejemplar = Ejemplar::find($ejemplarId);
        // dd($ejemplar);

        $transferencia = TRansferencia::where('ejemplar_id',$ejemplarId)
                                        -> get();
        if($ejemplar->padre_id){
            $camadasPadre = DB::table('ejemplares')
                        ->select('padre_id', DB::raw('COUNT(padre_id) as num_cachorros'), 'fecha_nacimiento', 'madre_id')
                        ->groupBy('padre_id', 'fecha_nacimiento', 'madre_id')
                        // ->join('ejemplares', 'users.id', '=', 'contacts.user_id')
                        // ->havingRaw('SUM(price) > ?', [2500])
                        ->where('padre_id', '=', $ejemplar->padre_id)
                        ->orderBy('fecha_nacimiento', 'desc')
                        // ->where('padre_id', '=', $ejemplar->padre_id)
                        ->get();   
        }else{
            $camadasPadre = null;
        }
                                    // ->toSql();
        // dd($camadasPadre);

        if($ejemplar->madre_id){
            $camadasMadre = DB::table('ejemplares')
                        ->select('madre_id', DB::raw('COUNT(madre_id) as num_cachorros'), 'fecha_nacimiento', 'padre_id')
                        ->groupBy('madre_id', 'fecha_nacimiento', 'padre_id')
                        // ->havingRaw('SUM(price) > ?', [2500])
                        ->where('madre_id', '=', $ejemplar->madre_id)
                        ->orderBy('fecha_nacimiento', 'desc')
                        // ->where('padre_id', '=', $ejemplar->padre_id)
                        ->get();   
        }else{
            $camadasMadre = null;
        }

        // dd($camadasMadre);
        return view('ejemplar.informacion')->with(compact('ejemplar','transferencia','camadasPadre','camadasMadre'));
    }

    public static function consultaPadres($ejemplarId)
    {
        $padres = Ejemplar::find($ejemplarId);
        return $padres;
    }

    public function formularioCamada()
    {
        $razas = Raza::all();

        return view('ejemplar.formularioCamada')->with(compact('razas'));
    }

    public function guardaCamada(Request $request)
    {
        // registramos a la camada

        $camada = new Camada();

        $camada->user_id            = Auth::user()->id;
        $camada->padre_id           = $request->input('padre_id');
        $camada->madre_id           = $request->input('madre_id');
        $camada->criadero_id        = $request->input('criadero_id'); 
        $camada->raza_id            = $request->input('raza_id');
        $camada->lechigada          = $request->input('lechigada');
        $camada->camada             = $request->input('camada');
        $camada->fecha_nacimiento   = $request->input('fecha_nacimiento');
        $camada->lechigada          = $request->input('lechigada');
        $numeroCamadasMadre         = Camada::where('id',$request->input('madre_id'))->count();
        $camada->num_parto_madre    = $numeroCamadasMadre + 1;
        $camada->departamento       = $request->input('departamento');
        $camada->fecha_registro     = now();

        // guradamos el registro de camada en
        $camada->save();

        // sacamos el id de la camda

        $IdCamada = $camada->id;



        // echo $_POST["[0][nombre]"];
        // echo $request->input();
        // dd($request->input());
        $cantidadEjemplares = count($request->input("ejemplar"));
        for ($i=0; $i < $cantidadEjemplares; $i++) { 
            $ejemplar = new Ejemplar();

            $ejemplar->user_id          = Auth::user()->id;
            $ejemplar->madre_id         = $request->input('madre_id');
            $ejemplar->padre_id         = $request->input('padre_id');
            $ejemplar->raza_id          = $request->input('raza_id');
            $ejemplar->criadero_id      = $request->input('criadero_id');
            $ejemplar->propietario_id   = $request->input('propietario_id');
            $ejemplar->camada_id        = $IdCamada;
            $ejemplar->kcb              = $request->input("ejemplar.$i.kcb");
            $ejemplar->num_tatuaje      = $request->input("ejemplar.$i.num_tatuaje");
            $ejemplar->chip             = $request->input("ejemplar.$i.chip");
            $ejemplar->fecha_nacimiento = $request->input('fecha_nacimiento');
            $ejemplar->color            = $request->input("ejemplar.$i.color");
            $ejemplar->senas            = $request->input("ejemplar.$i.senas");
            $ejemplar->nombre           = $request->input("ejemplar.$i.nombre");
             
            $criadero = Criadero::find($request->input('criadero_id'));
            if($request->input('primero_mostrar') == "Nombre"){
                $nombreCompleto         = $ejemplar->nombre;
                if($request->input('prefijo') == ""){
                    $nombreCompleto     = $nombreCompleto." ";
                }else{
                    $nombreCompleto     = $nombreCompleto." ".$request->input('prefijo')." ";
                }
                $nombreCompleto         = $nombreCompleto.$criadero->nombre;
            }else{
                $nombreCompleto         = $criadero->nombre;
                if($request->input('prefijo') == ""){
                    $nombreCompleto     = $nombreCompleto." ";
                }else{
                    $nombreCompleto     = $nombreCompleto." ".$request->input('prefijo')." "; 
                }
                $nombreCompleto         = $nombreCompleto." ".$ejemplar->nombre;
            }
            $ejemplar->nombre_completo  = $nombreCompleto;

            $ejemplar->primero_mostrar  = $request->input('primero_mostrar');
            $ejemplar->prefijo          = $request->input('prefijo');
            $ejemplar->lechigada        = $request->input('lechigada');
            $ejemplar->sexo             = $request->input("ejemplar.$i.sexo");
            $ejemplar->departamento     = $request->input("departamento");
            $ejemplar->fecha_emision    = $request->input("fecha_emision");

            // guardamos el ejemplar
            $ejemplar->save();
            // echo $request->input("ejemplar.$i.nombre"). "<br />";
        }
        
        return redirect("Ejemplar/listadoCamada/$IdCamada");
        // dd(count($request->input("ejemplar")));

    }

    public function listadoCamada(Request $request, $camada_id) {
        
        $ejemplaresCamada = Ejemplar::where('camada_id',$camada_id)->get();
        $camada = Camada::where('id',$camada_id)->first();
        return view('ejemplar.listadoCamada')->with(compact('ejemplaresCamada', 'camada'));
    }

    public function eliminaEjemplarCamada(Request $request, $ejemplar_id) {
        
        // buscamos el ejemplar a eliminar de la camada
        $ejemplar = Ejemplar::where('id',$ejemplar_id)->first(); 

        // rescatamos el id de la camda
        $camadaId           = $ejemplar->camada_id;

        // seteamos el campo camda_id para que no pertenesca a la camada
        $ejemplar->camada_id = null;

        $ejemplar->save();

        return redirect("Ejemplar/listadoCamada/$camadaId");
    }

    public function guardaEjemplarCamada(request $request,$camada_id,$ejemplar_id){
        $ejemplar = Ejemplar::where('id',$ejemplar_id)->first();

        $ejemplar->camada_id = $camada_id;

        $ejemplar->save();

        return redirect("Ejemplar/listadoCamada/$camada_id");
    }

    public function guardaEjemplarEdita(Request $request){

        // dd($request->all());

        $idEjemplarEditar = $request->input('edicion_ejemplar_id_editar');

        $idEjemplar = $request->input("edicion_ejemplar_id");
        
        $ejemplar = Ejemplar::find($idEjemplarEditar); 

        if($request->input("edicion_madre_id")){
            $ejemplar->madre_id = $request->input("edicion_madre_id");
        }else{
            $ejemplar->madre_id = null;
        }
        if($request->input("edicion_padre_id")){
            $ejemplar->padre_id = $request->input("edicion_padre_id");
        }else{
            $ejemplar->padre_id = null;
        }

        $ejemplar->save();

        return redirect("Ejemplar/formulario/$idEjemplar");
    }

    public function generaExcelPedigree(Request $request, $ejemplarId)
    {
        // dd($ejemplarId);
        $ejemplar = Ejemplar::find($ejemplarId);
        // generacion del excel
        $fileName = 'pedigree.xlsx';
        // return Excel::download(new CertificadoExport($carrera_persona_id), 'certificado.xlsx');
        $spreadsheet = new Spreadsheet();
        // activamos la hoja en la que trabajaremos
        $sheet = $spreadsheet->getActiveSheet();
        // asignamos el primer valor a la celda C3
        if($ejemplar->criadero){
            $nom_criadero   = $ejemplar->criadero->nombre;
            $num_fci        = $ejemplar->criadero->registro_fci;
        }else{
            $num_fci        = '';
            $nom_criadero = '';
        }

        if($ejemplar->propietario){
            $nom_propietario        = $ejemplar->propietario->name;
            $pro_direccion          = $ejemplar->propietario->direccion;
            $pro_departamento       = $ejemplar->propietario->departamento;
            $pro_celulares          = $ejemplar->propietario->celulares;
        }else{
            $nom_propietario = '';
            $pro_direccion          = '';
            $pro_departamento       = '';
            $pro_celulares          = '';
        }
        // dd($ejemplar->criadero);

        // ESTILOS DE LA HOJA 

        /*************** ENCABEZADO ***********************/
        $cabezera = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '305496'),
                'size'  => 16,
                // 'name'  => 'Verdana'
            )
        );

        
        $sheet->getStyle('C3')->applyFromArray($cabezera);
        $sheet->getStyle('L3')->applyFromArray($cabezera);
        $sheet->getStyle('C5')->applyFromArray($cabezera);
        $sheet->getStyle('L4')->applyFromArray($cabezera);
        
        /*************** DATOS DEL EJEMPLAR ***********************/
        $datosEjemplar = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '305496'),
                'size'  => 11,
                // 'name'  => 'Verdana'
            )
        );

        
        $sheet->getStyle('C6')->applyFromArray($datosEjemplar);
        $sheet->getStyle('C7')->applyFromArray($datosEjemplar);
        $sheet->getStyle('C8')->applyFromArray($datosEjemplar);
        $sheet->getStyle('E6')->applyFromArray($datosEjemplar);
        $sheet->getStyle('E7')->applyFromArray($datosEjemplar);
        $sheet->getStyle('H5')->applyFromArray($datosEjemplar);
        $sheet->getStyle('H6')->applyFromArray($datosEjemplar);
        $sheet->getStyle('H7')->applyFromArray($datosEjemplar);
        $sheet->getStyle('L6')->applyFromArray($datosEjemplar);

        $sheet->getStyle('L5')->applyFromArray(
            array(
                'font'  => array(
                    'bold'  => true,
                    'color' => array('rgb' => '305496'),
                    'size'  => 10,
                    // 'name'  => 'Verdana'
                )
            )
        );


        /*************** ARBOL GENEALOGICO "PADRES" ***********************/

        $estilosPadre = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '305496'),
                'size'  => 11,
                // 'name'  => 'Verdana'
            )
        );

        $sheet->getStyle('B11')->applyFromArray($estilosPadre);
        $sheet->getStyle('B19')->applyFromArray($estilosPadre);

        /*************** ARBOL GENEALOGICO "ABUELOS" ***********************/

        $estilosAbuelos = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '305496'),
                'size'  => 10,
                // 'name'  => 'Verdana'
            )
        );

        $sheet->getStyle('F11')->applyFromArray($estilosAbuelos);
        $sheet->getStyle('F15')->applyFromArray($estilosAbuelos);
        $sheet->getStyle('F19')->applyFromArray($estilosAbuelos);
        $sheet->getStyle('F23')->applyFromArray($estilosAbuelos);

        /*************** ARBOL GENEALOGICO "TERCERA GENERACION" ***********************/
        
        $estilosTerceraGeneracion = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '305496'),
                'size'  => 9,
                // 'name'  => 'Verdana'
            )
        );

        $sheet->getStyle('I11')->applyFromArray($estilosTerceraGeneracion);
        $sheet->getStyle('I13')->applyFromArray($estilosTerceraGeneracion);
        $sheet->getStyle('I15')->applyFromArray($estilosTerceraGeneracion);
        $sheet->getStyle('I17')->applyFromArray($estilosTerceraGeneracion);
        $sheet->getStyle('I19')->applyFromArray($estilosTerceraGeneracion);
        $sheet->getStyle('I21')->applyFromArray($estilosTerceraGeneracion);
        $sheet->getStyle('I23')->applyFromArray($estilosTerceraGeneracion);
        $sheet->getStyle('I25')->applyFromArray($estilosTerceraGeneracion);

        /*************** ARBOL GENEALOGICO "ABUELOS" ***********************/

        $estilosCuartaGeneracion = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '305496'),
                'size'  => 8,
                // 'name'  => 'Verdana'
            )
        );

        $sheet->getStyle('L11')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L12')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L13')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L14')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L15')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L16')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L17')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L18')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L19')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L20')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L21')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L22')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L23')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L24')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L25')->applyFromArray($estilosCuartaGeneracion);
        $sheet->getStyle('L26')->applyFromArray($estilosCuartaGeneracion);


        /*************** FOOTER ***********************/

        $estilosFooter = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '305496'),
                'size'  => 11,
                // 'name'  => 'Verdana'
            )
        );

        $sheet->getStyle('E29')->applyFromArray($estilosFooter);
        $sheet->getStyle('E31')->applyFromArray($estilosFooter);

        // *************   ORIENTACION DE LA HOJA  *****************
        
        $sheet->getPageSetup()->setOrientation("landscape");

        // END ESTILOS DE LA HOJA 

        // *************   cabecera *****************
        $sheet->setCellValue('C3', "$ejemplar->nombre_completo");
        // $sheet->setSize(10);

        $sheet->setCellValue('L3', $nom_criadero." FCI: ".$num_fci);
        $sheet->setCellValue('L4', $nom_propietario);
        $sheet->setCellValue('C5', $ejemplar->raza->nombre);
        $sheet->setCellValue('H5', $ejemplar->color);
        $sheet->setCellValue('L5', $pro_direccion." - ".$pro_departamento);
        $sheet->setCellValue('C6', $ejemplar->sexo);
        $sheet->setCellValue('E6', $ejemplar->fecha_nacimiento);
        $sheet->setCellValue('H6', "-------------------");
        $sheet->setCellValue('L6', $pro_celulares);
        $sheet->setCellValue('C7', $ejemplar->kcb);
        $sheet->setCellValue('E7', $ejemplar->num_tatuaje);
        $sheet->setCellValue('H7', $ejemplar->chip);
        $sheet->setCellValue('C8', $ejemplar->hermano);

        // padres
        $sheet->mergeCells('C3:H3');
        $sheet->mergeCells('B11:E18');
        $sheet->mergeCells('F11:H14');
        $sheet->mergeCells('F15:H18');
        $sheet->mergeCells('I11:K12');
        $sheet->mergeCells('I13:K14');
        $sheet->mergeCells('I15:K16');
        $sheet->mergeCells('I17:K18');
        $sheet->mergeCells('L11:Q11');
        $sheet->mergeCells('L12:Q12');
        $sheet->mergeCells('L13:Q13');
        $sheet->mergeCells('L14:Q14');
        $sheet->mergeCells('L15:Q15');
        $sheet->mergeCells('L16:Q16');
        $sheet->mergeCells('L17:Q17');
        $sheet->mergeCells('L18:Q18');

        // madres
        $sheet->mergeCells('B19:E26');
        $sheet->mergeCells('F19:H22');
        $sheet->mergeCells('F23:H26');
        $sheet->mergeCells('I19:K20');
        $sheet->mergeCells('I21:K22');
        $sheet->mergeCells('I23:K24');
        $sheet->mergeCells('I25:K26');
        $sheet->mergeCells('L19:Q19');
        $sheet->mergeCells('L20:Q20');
        $sheet->mergeCells('L21:Q21');
        $sheet->mergeCells('L22:Q22');
        $sheet->mergeCells('L23:Q23');
        $sheet->mergeCells('L24:Q24');
        $sheet->mergeCells('L25:Q25');
        $sheet->mergeCells('L26:Q26');

        // $sheet->setCellValue('B11', "Este esta comvinado");

        // ************** Curpo Arbol gernealogico ***************

                // ****************** PADRE *****************************
            // sacamos las generaciones
        $ejemplarOrigen = Ejemplar::find($ejemplar->id);
        // definimos las variables del padre
        $kcbAbuelo = '';
        $nombreAbuelo = '';
        $kcbAbuela = '';
        $nombreAbuela = '';
        $kcbTGPadre = '';
        $nombreTGPadre = '';
        $kcbTGMadre = '';
        $nombreTGMadre = '';
        $kcbCGPadre = '';
        $nombreCGPadre = '';
        $kcbCGMadre = '';
        $nombreCGMadre = '';
        
        $kcbTGMadreP1 = '';
        $nombreTGMadreP1 = '';  
        
        $kcbTGMadreM2 = '';
        $nombreTGMadreM2 = '';

        
        $kcbAbueloTG1 = '';
        $nombreAbueloTG1 = '';

        $kcbAbuelaTG1 = '';
        $nombreAbuelaTG1 = '';
    
        $kcbAbueloCG1 = '';
        $nombreAbueloCG1 = '';

        $kcbAbueloCG1M = '';
        $nombreAbueloCG1M = '';

        $kcbAbueloTG1M1 = '';
        $nombreAbueloTG1M1 = '';
        
        $kcbAbuelaTG1M1 = '';
        $nombreAbuelaTG1M1 = '';

        if($ejemplarOrigen->padre_id != null){
            $papa = Ejemplar::find($ejemplarOrigen->padre_id);

            $kcbPapa = ($papa)?$papa->kcb:'';
            $nombrePapa = ($papa != null)?$papa->nombre_completo:'';

            $examenMascotaPapa = ExamenMascota::where('ejemplar_id','=',$papa->id)
                                            ->where('examen_id','=',3)
                                            ->first();
            if($examenMascotaPapa){
                $examenPapa = $examenMascotaPapa->examen->nombre;
                $resultadoPapa = $examenMascotaPapa->resultado;
            }else{
                $examenPapa = "";
                $resultadoPapa = "";
            }

            $sheet->setCellValue('B11', $nombrePapa.PHP_EOL."K.C.B. ".$kcbPapa.PHP_EOL."No. x Raza ".$papa->num_tatuaje.PHP_EOL."Chip ".$papa->chip.PHP_EOL."$examenPapa".PHP_EOL."$resultadoPapa".PHP_EOL."Color: ".$papa->color);
            $sheet->getStyle('B11')->getAlignment()->setWrapText(true);
            
            // preguntamos si el papa tiene padre
            // para sacar al abuelo
            if($papa->padre_id != null){

                $abuelo = Ejemplar::find($papa->padre_id);

                $kcbAbuelo = ($abuelo)?$abuelo->kcb:'';
                $nombreAbuelo = ($abuelo != null)?$abuelo->nombre_completo:'';
                
                $examenMascotaAbuelo = ExamenMascota::where('ejemplar_id','=',$abuelo->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                if($examenMascotaAbuelo){
                    $examenAbuelo = $examenMascotaAbuelo->examen->nombre;
                    $resultadoAbuelo = $examenMascotaAbuelo->resultado;
                }else{
                    $examenAbuelo = "";
                    $resultadoAbuelo = "";
                }

                $sheet->setCellValue('F11', $nombreAbuelo.PHP_EOL."K.C.B. ".$kcbAbuelo.PHP_EOL."No. x Raza ".$abuelo->num_tatuaje.PHP_EOL."Chip ".$abuelo->chip.PHP_EOL."$examenAbuelo".PHP_EOL."$resultadoAbuelo".PHP_EOL."Color: ".$abuelo->color);
                $sheet->getStyle('F11')->getAlignment()->setWrapText(true);

                // preguntamos si el abuelo tiene padre
                // para sacar al tecera generacion padre
                if($abuelo->padre_id != null){

                    $tGPadre = Ejemplar::find($abuelo->padre_id);

                    $kcbTGPadre = ($tGPadre)?$tGPadre->kcb:'';
                    $nombreTGPadre = ($tGPadre != null)?$tGPadre->nombre_completo:'';

                    $examenMascotatGPadre = ExamenMascota::where('ejemplar_id','=',$tGPadre->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                    if($examenMascotatGPadre){
                        $examentGPadre = $examenMascotatGPadre->examen->nombre;
                        $resultadotGPadre = $examenMascotatGPadre->resultado;
                    }else{
                        $examentGPadre = "";
                        $resultadotGPadre = "";
                    }

                    $sheet->setCellValue('I11', $nombreTGPadre.PHP_EOL."K.C.B. ".$kcbTGPadre.PHP_EOL."No. x Raza ".$tGPadre->num_tatuaje.PHP_EOL."Chip ".$tGPadre->chip.PHP_EOL."$examentGPadre".PHP_EOL."$resultadotGPadre".PHP_EOL."Color: ".$tGPadre->color);
                    $sheet->getStyle('I11')->getAlignment()->setWrapText(true);

                    // preguntamos si la tercera generacion tiene padre
                    // para sacar al cuarta generacion padre
                    if($tGPadre->padre_id != null){

                        $cGPadre = Ejemplar::find($tGPadre->padre_id);
                        
                        $kcbCGPadre = ($cGPadre)?$cGPadre->kcb:'';
                        $nombreCGPadre = ($cGPadre != null)?$cGPadre->nombre_completo:'';

                        $examenMascotacGPadre = ExamenMascota::where('ejemplar_id','=',$cGPadre->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotacGPadre){
                            $examencGPadre = $examenMascotacGPadre->examen->nombre;
                            $resultadocGPadre = $examenMascotacGPadre->resultado;
                        }else{
                            $examencGPadre = "";
                            $resultadocGPadre = "";
                        }

                        $sheet->setCellValue('L11', $nombreCGPadre." K.C.B. ".$kcbCGPadre." No. x Raza ".$cGPadre->num_tatuaje." Chip ".$cGPadre->chip."$examencGPadre "." $resultadocGPadre"." Color: ".$cGPadre->color);
                        // $sheet->getStyle('L11')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L11', $nombreCGPadre.PHP_EOL."K.C.B. ".$kcbCGPadre.PHP_EOL."No. x Raza ".$cGPadre->num_tatuaje.PHP_EOL."Chip ".$cGPadre->chip.PHP_EOL."$examencGPadre".PHP_EOL."$resultadocGPadre".PHP_EOL."Color: ".$cGPadre->color);
                        // $sheet->getStyle('L11')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbCGPadre = '';
                        $nombreCGPadre = '';
                    }

                    // preguntamos si la tercera generacion tiene madre
                    // para sacar al cuarta generacion madre
                    if($tGPadre->madre_id != null){

                        $cGMadre = Ejemplar::find($tGPadre->madre_id);
                        
                        $kcbCGMadre = ($cGMadre)?$cGMadre->kcb:'';
                        $nombreCGMadre = ($cGMadre != null)?$cGMadre->nombre_completo:'';

                        $examenMascotacGMadre = ExamenMascota::where('ejemplar_id','=',$cGMadre->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotacGMadre){
                            $examencGMadre = $examenMascotacGMadre->examen->nombre;
                            $resultadocGMadre = $examenMascotacGMadre->resultado;
                        }else{
                            $examencGMadre = "";
                            $resultadocGMadre = "";
                        }

                        $sheet->setCellValue('L12', $nombreCGMadre." K.C.B. ".$kcbCGMadre." No. x Raza ".$cGMadre->num_tatuaje." Chip ".$cGMadre->chip." $examencGMadre " . " $resultadocGMadre"." Color: ".$cGMadre->color);
                        // $sheet->getStyle('L12')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L12', $nombreCGMadre.PHP_EOL."K.C.B. ".$kcbCGMadre.PHP_EOL."No. x Raza ".$cGMadre->num_tatuaje.PHP_EOL."Chip ".$cGMadre->chip.PHP_EOL."$examencGMadre".PHP_EOL."$resultadocGMadre".PHP_EOL."Color: ".$cGMadre->color);
                        // $sheet->getStyle('L12')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbCGMadre = '';
                        $nombreCGMadre = '';
                    }

                }else{
                    $kcbTGPadre = '';
                    $nombreTGPadre = '';
                }

                // preguntamos si el abuelo tiene madre
                // para sacar al tecera generacion madre
                if($abuelo->madre_id != null){

                    $tGMadre = Ejemplar::find($abuelo->madre_id);

                    $kcbTGMadre = ($tGMadre)?$tGMadre->kcb:'';
                    $nombreTGMadre = ($tGMadre != null)?$tGMadre->nombre_completo:'';

                    $examenMascotatGMadre = ExamenMascota::where('ejemplar_id','=',$tGMadre->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                    if($examenMascotatGMadre){
                        $examentGMadre = $examenMascotatGMadre->examen->nombre;
                        $resultadotGMadre = $examenMascotatGMadre->resultado;
                    }else{
                        $examentGMadre = "";
                        $resultadotGMadre = "";
                    }

                    $sheet->setCellValue('I13', $nombreTGMadre.PHP_EOL."K.C.B. ".$kcbTGMadre.PHP_EOL."No. x Raza ".$tGMadre->num_tatuaje.PHP_EOL."Chip ".$tGMadre->chip.PHP_EOL."$examentGMadre".PHP_EOL."$resultadotGMadre".PHP_EOL."Color: ".$tGMadre->color);
                    $sheet->getStyle('I13')->getAlignment()->setWrapText(true);

                    if($tGMadre->padre_id != null){

                        $CGMadreP = Ejemplar::find($tGMadre->padre_id);

                        $kcbTGMadreP1 = ($CGMadreP)?$CGMadreP->kcb:'';
                        $nombreTGMadreP1 = ($CGMadreP)?$CGMadreP->nombre_completo:'';  
                        
                        $examenMascotaCGMadreP = ExamenMascota::where('ejemplar_id','=',$CGMadreP->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaCGMadreP){
                            $examenCGMadreP = $examenMascotaCGMadreP->examen->nombre;
                            $resultadoCGMadreP = $examenMascotaCGMadreP->resultado;
                        }else{
                            $examenCGMadreP = "";
                            $resultadoCGMadreP = "";
                        }
                        $sheet->setCellValue('L13', $nombreTGMadreP1." K.C.B. ".$kcbTGMadreP1." No. x Raza ".$CGMadreP->num_tatuaje." Chip ".$CGMadreP->chip."$examenCGMadreP "." $resultadoCGMadreP"."Color: ".$CGMadreP->color);
                        // $sheet->getStyle('L13')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L13', $nombreTGMadreP1.PHP_EOL."K.C.B. ".$kcbTGMadreP1.PHP_EOL."No. x Raza ".$CGMadreP->num_tatuaje.PHP_EOL."Chip ".$CGMadreP->chip.PHP_EOL."$examenCGMadreP".PHP_EOL."$resultadoCGMadreP".PHP_EOL."Color: ".$CGMadreP->color);
                        // $sheet->getStyle('L13')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbTGMadreP1 = '';
                        $nombreTGMadreP1 = '';    
                    }

                    // para la madre de del atercera generacion
                    if($tGMadre->madre_id != null){

                        $CGMadreM2 = Ejemplar::find($tGMadre->madre_id);

                        $kcbTGMadreM2 = ($CGMadreM2)?$CGMadreM2->kcb:'';
                        $nombreTGMadreM2 = ($CGMadreM2)?$CGMadreM2->nombre_completo:'';    

                        $examenMascotaCGMadreM2 = ExamenMascota::where('ejemplar_id','=',$CGMadreM2->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaCGMadreM2){
                            $examenCGMadreM2 = $examenMascotaCGMadreM2->examen->nombre;
                            $resultadoCGMadreM2 = $examenMascotaCGMadreM2->resultado;
                        }else{
                            $examenCGMadreM2 = "";
                            $resultadoCGMadreM2 = "";
                        }
                        
                        $sheet->setCellValue('L14', $nombreTGMadreM2." K.C.B. ".$kcbTGMadreM2." No. x Raza ".$CGMadreM2->num_tatuaje." Chip ".$CGMadreM2->chip."$examenCGMadreM2 "." $resultadoCGMadreM2"." Color: ".$CGMadreM2->color);
                        // $sheet->getStyle('L14')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L14', $nombreTGMadreM2.PHP_EOL."K.C.B. ".$kcbTGMadreM2.PHP_EOL."No. x Raza ".$CGMadreM2->num_tatuaje.PHP_EOL."Chip ".$CGMadreM2->chip.PHP_EOL."$examenCGMadreM2".PHP_EOL."$resultadoCGMadreM2".PHP_EOL."Color: ".$CGMadreM2->color);
                        // $sheet->getStyle('L14')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbTGMadreM2 = '';
                        $nombreTGMadreM2 = '';    
                    }

                }else{
                    $kcbtGMadre = '';
                    $nombretGMadre = '';
                }

            }else{
                $kcbAbuelo = '';
                $nombreAbuelo = '';
            }

            // preguntamos si el papa tiene madre
            // para sacar al abuela
            if($papa->madre_id != null){

                $abuela = Ejemplar::find($papa->madre_id);

                $kcbAbuela = ($abuela)?$abuela->kcb:'';
                $nombreAbuela = ($abuela != null)?$abuela->nombre_completo:'';

                $examenMascotaabuela = ExamenMascota::where('ejemplar_id','=',$abuela->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                if($examenMascotaabuela){
                    $examenabuela = $examenMascotaabuela->examen->nombre;
                    $resultadoabuela = $examenMascotaabuela->resultado;
                }else{
                    $examenabuela = "";
                    $resultadoabuela = "";
                }

                $sheet->setCellValue('F15', $nombreAbuela.PHP_EOL."K.C.B. ".$kcbAbuela.PHP_EOL."No. x Raza ".$abuela->num_tatuaje.PHP_EOL."Chip ".$abuela->chip.PHP_EOL."$examenabuela".PHP_EOL."$resultadoabuela".PHP_EOL."Color: ".$abuela->color);
                $sheet->getStyle('F15')->getAlignment()->setWrapText(true);

                if($abuela->padre_id != null){

                    $abueloTG = Ejemplar::find($abuela->padre_id);

                    $kcbAbueloTG1 = ($abueloTG)?$abueloTG->kcb:'';
                    $nombreAbueloTG1 = ($abueloTG)?$abueloTG->nombre_completo:'';

                    $examenMascotaabueloTG = ExamenMascota::where('ejemplar_id','=',$abueloTG->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                    if($examenMascotaabueloTG){
                        $examenabueloTG = $examenMascotaabueloTG->examen->nombre;
                        $resultadoabueloTG = $examenMascotaabueloTG->resultado;
                    }else{
                        $examenabueloTG = "";
                        $resultadoabueloTG = "";
                    }

                    $sheet->setCellValue('I15', $nombreAbueloTG1.PHP_EOL."K.C.B. ".$kcbAbueloTG1.PHP_EOL."No. x Raza ".$abueloTG->num_tatuaje.PHP_EOL."Chip ".$abueloTG->chip.PHP_EOL."$examenabueloTG".PHP_EOL."$resultadoabueloTG".PHP_EOL."Color: ".$abueloTG->color);
                    $sheet->getStyle('I15')->getAlignment()->setWrapText(true);

                    if($abueloTG->padre_id != null){

                        $abueloCG = Ejemplar::find($abueloTG->padre_id);

                        $kcbAbueloCG1 = ($abueloCG)?$abueloCG->kcb:'';
                        $nombreAbueloCG1 = ($abueloCG)?$abueloCG->nombre_completo:'';

                        $examenMascotaabueloCG = ExamenMascota::where('ejemplar_id','=',$abueloCG->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaabueloCG){
                            $examenabueloCG = $examenMascotaabueloCG->examen->nombre;
                            $resultadoabueloCG = $examenMascotaabueloCG->resultado;
                        }else{
                            $examenabueloCG = "";
                            $resultadoabueloCG = "";
                        }

                        $sheet->setCellValue('L15', $nombreAbueloCG1." K.C.B. ".$kcbAbueloCG1." No. x Raza ".$abueloCG->num_tatuaje." Chip ".$abueloCG->chip." $examenabueloCG "." $resultadoabueloCG"." Color: ".$abueloCG->color);
                        // $sheet->getStyle('L15')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L15', $nombreAbueloCG1.PHP_EOL."K.C.B. ".$kcbAbueloCG1.PHP_EOL."No. x Raza ".$abueloCG->num_tatuaje.PHP_EOL."Chip ".$abueloCG->chip.PHP_EOL."$examenabueloCG".PHP_EOL."$resultadoabueloCG".PHP_EOL."Color: ".$abueloCG->color);
                        // $sheet->getStyle('L15')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbAbueloCG1 = '';
                        $nombreAbueloCG1 = '';
                    }

                    if($abueloTG->madre_id != null){

                        $abueloCGM = Ejemplar::find($abueloTG->madre_id);

                        $kcbAbueloCG1M = ($abueloCGM)?$abueloCGM->kcb:'';
                        $nombreAbueloCG1M = ($abueloCGM)?$abueloCGM->nombre_completo:'';

                        $examenMascotaabueloCGM = ExamenMascota::where('ejemplar_id','=',$abueloCGM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaabueloCGM){
                            $examenabueloCGM = $examenMascotaabueloCGM->examen->nombre;
                            $resultadoabueloCGM = $examenMascotaabueloCGM->resultado;
                        }else{
                            $examenabueloCGM = "";
                            $resultadoabueloCGM = "";
                        }

                        $sheet->setCellValue('L16', $nombreAbueloCG1M." K.C.B. ".$kcbAbueloCG1M." No. x Raza ".$abueloCGM->num_tatuaje." Chip ".$abueloCGM->chip." $examenabueloCGM "." $resultadoabueloCGM"." Color: ".$abueloCGM->color);
                        // $sheet->getStyle('L16')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L16', $nombreAbueloCG1M.PHP_EOL."K.C.B. ".$kcbAbueloCG1M.PHP_EOL."No. x Raza ".$abueloCGM->num_tatuaje.PHP_EOL."Chip ".$abueloCGM->chip.PHP_EOL."$examenabueloCGM".PHP_EOL."$resultadoabueloCGM".PHP_EOL."Color: ".$abueloCGM->color);
                        // $sheet->getStyle('L16')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbAbueloCG1M = '';
                        $nombreAbueloCG1M = '';
                    }
                }else{
                    $kcbAbueloTG1 = '';
                    $nombreAbueloTG1 = '';
                }

                // hacemos para su mama de la abuela
                if($abuela->madre_id != null){

                    $abuelaTG = Ejemplar::find($abuela->madre_id);

                    $kcbAbuelaTG1 = ($abuelaTG)?$abuelaTG->kcb:'';
                    $nombreAbuelaTG1 = ($abuelaTG)?$abuelaTG->nombre_completo:'';

                    $examenMascotaabuelaTG = ExamenMascota::where('ejemplar_id','=',$abuelaTG->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                    if($examenMascotaabuelaTG){
                        $examenabuelaTG = $examenMascotaabuelaTG->examen->nombre;
                        $resultadoabuelaTG = $examenMascotaabuelaTG->resultado;
                    }else{
                        $examenabuelaTG = "";
                        $resultadoabuelaTG = "";
                    }

                    $sheet->setCellValue('I17', $nombreAbuelaTG1.PHP_EOL."K.C.B. ".$kcbAbuelaTG1.PHP_EOL."No. x Raza ".$abuelaTG->num_tatuaje.PHP_EOL."Chip ".$abuelaTG->chip.PHP_EOL."$examenabuelaTG".PHP_EOL."$resultadoabuelaTG".PHP_EOL."Color: ".$abuelaTG->color);
                    $sheet->getStyle('I17')->getAlignment()->setWrapText(true);

                    // aqui hay que hacer para la cuarte generracion tanto como padre y madres
                    if($abuelaTG->padre_id != null){

                        $abueloTGM1 = Ejemplar::find($abuelaTG->padre_id);

                        $kcbAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->kcb:'';
                        $nombreAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->nombre_completo:'';

                        $examenMascotaabueloTGM1 = ExamenMascota::where('ejemplar_id','=',$abueloTGM1->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaabueloTGM1){
                            $examenabueloTGM1 = $examenMascotaabueloTGM1->examen->nombre;
                            $resultadoabueloTGM1 = $examenMascotaabueloTGM1->resultado;
                        }else{
                            $examenabueloTGM1 = "";
                            $resultadoabueloTGM1 = "";
                        }

                        
                        $sheet->setCellValue('L17', $nombreAbueloTG1M1." K.C.B. ".$kcbAbueloTG1M1." No. x Raza ".$abueloTGM1->num_tatuaje." Chip ".$abueloTGM1->chip." $examenabueloTGM1 "." $resultadoabueloTGM1"." Color: ".$abueloTGM1->color);
                        // $sheet->getStyle('L17')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L17', $nombreAbueloTG1M1.PHP_EOL."K.C.B. ".$kcbAbueloTG1M1.PHP_EOL."No. x Raza ".$abueloTGM1->num_tatuaje.PHP_EOL."Chip ".$abueloTGM1->chip.PHP_EOL."$examenabueloTGM1".PHP_EOL."$resultadoabueloTGM1".PHP_EOL."Color: ".$abueloTGM1->color);
                        // $sheet->getStyle('L17')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbAbueloTG1M1 = '';
                        $nombreAbueloTG1M1 = '';
                    }
                    if($abuelaTG->madre_id != null){

                        $abuelaTGM1 = Ejemplar::find($abuelaTG->madre_id);

                        $kcbAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->kcb:'';
                        $nombreAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->nombre_completo:'';

                        $examenMascotaabuelaTGM1 = ExamenMascota::where('ejemplar_id','=',$abuelaTGM1->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaabuelaTGM1){
                            $examenabuelaTGM1 = $examenMascotaabuelaTGM1->examen->nombre;
                            $resultadoabuelaTGM1 = $examenMascotaabuelaTGM1->resultado;
                        }else{
                            $examenabuelaTGM1 = "";
                            $resultadoabuelaTGM1 = "";
                        }
                        
                        $sheet->setCellValue('L18', $nombreAbuelaTG1M1." K.C.B. ".$kcbAbuelaTG1M1." No. x Raza ".$abuelaTGM1->num_tatuaje." Chip ".$abuelaTGM1->chip." $examenabuelaTGM1 "." $resultadoabuelaTGM1"." Color: ".$abuelaTGM1->color);
                        // $sheet->getStyle('L18')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L18', $nombreAbuelaTG1M1." K.C.B. ".$kcbAbuelaTG1M1.PHP_EOL."No. x Raza ".$abuelaTGM1->num_tatuaje.PHP_EOL."Chip ".$abuelaTGM1->chip.PHP_EOL."$examenabuelaTGM1".PHP_EOL."$resultadoabuelaTGM1".PHP_EOL."Color: ".$abuelaTGM1->color);
                        // $sheet->getStyle('L18')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbAbuelaTG1M1 = '';
                        $nombreAbuelaTG1M1 = '';
                    }
                }else{
                    $kcbAbuelaTG1 = '';
                    $nombreAbuelaTG1 = '';
                }
            }else{
                $kcbAbuela = '';
                $nombreAbuela = '';
            }

        }else{
            $kcbPapa = '';
            $nombrePapa = '';        
        }

        // ****************** MADRE *****************************

        // definimos las variables de la madre
        $kcbAbueloM = '';
        $nombreAbueloM = '';
        $kcbAbuelaM = '';
        $nombreAbuelaM = '';
        $kcbTGPadreM = '';
        $nombreTGPadreM = '';
        $kcbTGMadreM = '';
        $nombreTGMadreM = '';
        $kcbCGPadreM = '';
        $nombreCGPadreM = '';
        $kcbCGMadreM = '';
        $nombreCGMadreM = '';
        
        $kcbCGPadreM1 = '';
        $nombreCGPadreM1 = '';
        $kcbCGPadreM2 = '';
        $nombreCGPadreM2 = '';
        $kcbabueloMSG  = '' ;
        $nombreabueloMSG  = '' ;
        
        $kcbabueloMSG2  = '' ;
        $nombreabueloMSG2  = '' ;
        
        $kcbabueloMTG1  = '' ;
        $nombreabueloMTG1  = '' ;
        
        $kcbabueloMTG11  = '' ;
        $nombreabueloMTG11  = '' ;
        
        $kcbabueloMSG22  = '' ;
        $nombreabueloMSG22  = '' ;

        $kcbabueloMSG222  = '' ;
        $nombreabueloMSG222  = '' ;
        if($ejemplarOrigen->madre_id != null){
            $mama = Ejemplar::find($ejemplarOrigen->madre_id);

            $kcbMama = ($mama != null)?$mama->kcb:'';
            $nombreMama = ($mama != null)?$mama->nombre_completo:'';

            $examenMascotamama = ExamenMascota::where('ejemplar_id','=',$mama->id)
                                            ->where('examen_id','=',3)
                                            ->first();
            if($examenMascotamama){
                $examenmama = $examenMascotamama->examen->nombre;
                $resultadomama = $examenMascotamama->resultado;
            }else{
                $examenmama = "";
                $resultadomama = "";
            }

            $sheet->setCellValue('B19', $nombreMama.PHP_EOL."K.C.B. ".$kcbMama.PHP_EOL."No. x Raza ".$mama->num_tatuaje.PHP_EOL."Chip ".$mama->chip.PHP_EOL."$examenmama".PHP_EOL."$resultadomama".PHP_EOL."Color: ".$mama->color);
            $sheet->getStyle('B19')->getAlignment()->setWrapText(true);

            if($mama->padre_id != null){

                $abueloM = Ejemplar::find($mama->padre_id);

                $kcbAbueloM     = ($abueloM)? $abueloM->kcb: '';
                $nombreAbueloM  = ($abueloM)? $abueloM->nombre_completo: '';

                $examenMascotaabueloM = ExamenMascota::where('ejemplar_id','=',$abueloM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                if($examenMascotaabueloM){
                    $examenabueloM = $examenMascotaabueloM->examen->nombre;
                    $resultadoabueloM = $examenMascotaabueloM->resultado;
                }else{
                    $examenabueloM = "";
                    $resultadoabueloM = "";
                }

                $sheet->setCellValue('F19', $nombreAbueloM.PHP_EOL."K.C.B. ".$kcbAbueloM.PHP_EOL."No. x Raza ".$abueloM->num_tatuaje.PHP_EOL."Chip ".$abueloM->chip.PHP_EOL."$examenabueloM".PHP_EOL."$resultadoabueloM".PHP_EOL."Color: ".$abueloM->color);
                $sheet->getStyle('F19')->getAlignment()->setWrapText(true);

                if($abueloM->padre_id != null){
                    
                    $tGPadreM = Ejemplar::find($abueloM->padre_id);

                    $kcbTGPadreM = ($tGPadreM)?$tGPadreM->kcb:'';
                    $nombreTGPadreM = ($tGPadreM)?$tGPadreM->nombre_completo:'';

                    $examenMascotatGPadreM = ExamenMascota::where('ejemplar_id','=',$tGPadreM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                    if($examenMascotatGPadreM){
                        $examentGPadreM = $examenMascotatGPadreM->examen->nombre;
                        $resultadotGPadreM = $examenMascotatGPadreM->resultado;
                    }else{
                        $examentGPadreM = "";
                        $resultadotGPadreM = "";
                    }

                    $sheet->setCellValue('I19', $nombreTGPadreM.PHP_EOL."K.C.B. ".$kcbTGPadreM.PHP_EOL."No. x Raza ".$tGPadreM->num_tatuaje.PHP_EOL."Chip ".$tGPadreM->chip.PHP_EOL."$examentGPadreM".PHP_EOL."$resultadotGPadreM".PHP_EOL."Color: ".$tGPadreM->color);
                    $sheet->getStyle('I19')->getAlignment()->setWrapText(true);

                    if($tGPadreM->padre_id != null){

                        $CGPadreM1 = Ejemplar::find($tGPadreM->padre_id);

                        $kcbCGPadreM1 = ($CGPadreM1)?$CGPadreM1->kcb:'';
                        $nombreCGPadreM1 = ($CGPadreM1)?$CGPadreM1->nombre_completo:'';

                        $examenMascotaCGPadreM1 = ExamenMascota::where('ejemplar_id','=',$CGPadreM1->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaCGPadreM1){
                            $examenCGPadreM1 = $examenMascotaCGPadreM1->examen->nombre;
                            $resultadoCGPadreM1 = $examenMascotaCGPadreM1->resultado;
                        }else{
                            $examenCGPadreM1 = "";
                            $resultadoCGPadreM1 = "";
                        }
                        
                        $sheet->setCellValue('L19', $nombreCGPadreM1." K.C.B. ".$kcbCGPadreM1." No. x Raza ".$CGPadreM1->num_tatuaje." Chip ".$CGPadreM1->chip." $examenCGPadreM1 "." $resultadoCGPadreM1"." Color: ".$CGPadreM1->color);
                        // $sheet->getStyle('L19')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L19', $nombreCGPadreM1.PHP_EOL."K.C.B. ".$kcbCGPadreM1.PHP_EOL."No. x Raza ".$CGPadreM1->num_tatuaje.PHP_EOL."Chip ".$CGPadreM1->chip.PHP_EOL."$examenCGPadreM1".PHP_EOL."$resultadoCGPadreM1".PHP_EOL."Color: ".$CGPadreM1->color);
                        // $sheet->getStyle('L19')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbCGPadreM1 = '';
                        $nombreCGPadreM1 = '';
                    }
                    if($tGPadreM->madre_id != null){

                        $CGPadreM2 = Ejemplar::find($tGPadreM->madre_id);

                        $kcbCGPadreM2 = ($CGPadreM2)?$CGPadreM2->kcb:'';
                        $nombreCGPadreM2 = ($CGPadreM2)?$CGPadreM2->nombre_completo:'';

                        $examenMascotaCGPadreM2 = ExamenMascota::where('ejemplar_id','=',$CGPadreM2->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaCGPadreM2){
                            $examenCGPadreM2 = $examenMascotaCGPadreM2->examen->nombre;
                            $resultadoCGPadreM2 = $examenMascotaCGPadreM2->resultado;
                        }else{
                            $examenCGPadreM2 = "";
                            $resultadoCGPadreM2 = "";
                        }

                        $sheet->setCellValue('L20', $nombreCGPadreM2." K.C.B. ".$kcbCGPadreM2." No. x Raza ".$CGPadreM2->num_tatuaje." Chip ".$CGPadreM2->chip." $examenCGPadreM2 "." $resultadoCGPadreM2"." Color: ".$CGPadreM2->color);
                        // $sheet->getStyle('L20')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L20', $nombreCGPadreM2.PHP_EOL."K.C.B. ".$kcbCGPadreM2.PHP_EOL."No. x Raza ".$CGPadreM2->num_tatuaje.PHP_EOL."Chip ".$CGPadreM2->chip.PHP_EOL."$examenCGPadreM2".PHP_EOL."$resultadoCGPadreM2".PHP_EOL."Color: ".$CGPadreM2->color);
                        // $sheet->getStyle('L20')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbCGPadreM2 = '';
                        $nombreCGPadreM2 = '';
                    }

                }else{
                    $kcbTGPadreM = '';
                    $nombreTGPadreM = '';
                }

                if($abueloM->madre_id != null){

                    $tGMadreM = Ejemplar::find($abueloM->madre_id);

                    $kcbTGMadreM = ($tGMadreM)?$tGMadreM->kcb:'';
                    $nombreTGMadreM = ($tGMadreM)?$tGMadreM->nombre_completo:'';

                    $examenMascotatGMadreM = ExamenMascota::where('ejemplar_id','=',$tGMadreM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                    if($examenMascotatGMadreM){
                        $examentGMadreM = $examenMascotatGMadreM->examen->nombre;
                        $resultadotGMadreM = $examenMascotatGMadreM->resultado;
                    }else{
                        $examentGMadreM = "";
                        $resultadotGMadreM = "";
                    }

                    $sheet->setCellValue('I21', $nombreTGMadreM.PHP_EOL."K.C.B. ".$kcbTGMadreM.PHP_EOL."No. x Raza ".$tGMadreM->num_tatuaje.PHP_EOL."Chip ".$tGMadreM->chip.PHP_EOL."$examentGMadreM".PHP_EOL."$resultadotGMadreM".PHP_EOL."Color: ".$tGMadreM->color);
                    $sheet->getStyle('I21')->getAlignment()->setWrapText(true);

                    if($tGMadreM->padre_id != null){

                        $CGPadreM = Ejemplar::find($tGMadreM->padre_id);

                        $kcbCGPadreM = ($CGPadreM)? $CGPadreM->kcb:'';                   
                        $nombreCGPadreM = ($CGPadreM)? $CGPadreM->nombre_completo:'';

                        $examenMascotaCGPadreM = ExamenMascota::where('ejemplar_id','=',$CGPadreM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaCGPadreM){
                            $examenCGPadreM = $examenMascotaCGPadreM->examen->nombre;
                            $resultadoCGPadreM = $examenMascotaCGPadreM->resultado;
                        }else{
                            $examenCGPadreM = "";
                            $resultadoCGPadreM = "";
                        }

                        $sheet->setCellValue('L21', $nombreCGPadreM." K.C.B. ".$kcbCGPadreM." No. x Raza ".$CGPadreM->num_tatuaje." Chip ".$CGPadreM->chip." $examenCGPadreM "." $resultadoCGPadreM"." Color: ".$CGPadreM->color);
                        // $sheet->getStyle('L21')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L21', $nombreCGPadreM.PHP_EOL."K.C.B. ".$kcbCGPadreM.PHP_EOL."No. x Raza ".$CGPadreM->num_tatuaje.PHP_EOL."Chip ".$CGPadreM->chip.PHP_EOL."$examenCGPadreM".PHP_EOL."$resultadoCGPadreM".PHP_EOL."Color: ".$CGPadreM->color);
                        // $sheet->getStyle('L21')->getAlignment()->setWrapText(true);

                    }else{

                        $kcbCGPadreM = '';                   
                        $nombreCGPadreM = '';                   
                    }
                    if($tGMadreM->madre_id != null){

                        $CGMadreM = Ejemplar::find($tGMadreM->madre_id);

                        $kcbCGMadreM = ($CGMadreM)? $CGMadreM->kcb:'';                   
                        $nombreCGMadreM = ($CGMadreM)? $CGMadreM->nombre_completo:'';                   

                        $examenMascotaCGMadreM = ExamenMascota::where('ejemplar_id','=',$CGMadreM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaCGMadreM){
                            $examenCGMadreM = $examenMascotaCGMadreM->examen->nombre;
                            $resultadoCGMadreM = $examenMascotaCGMadreM->resultado;
                        }else{
                            $examenCGMadreM = "";
                            $resultadoCGMadreM = "";
                        }

                        $sheet->setCellValue('L22', $nombreCGMadreM." K.C.B. ".$kcbCGMadreM." No. x Raza ".$CGMadreM->num_tatuaje." Chip ".$CGMadreM->chip." $examenCGMadreM "." $resultadoCGMadreM"." Color: ".$CGMadreM->color);
                        // $sheet->getStyle('L22')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L22', $nombreCGMadreM.PHP_EOL."K.C.B. ".$kcbCGMadreM.PHP_EOL."No. x Raza ".$CGMadreM->num_tatuaje.PHP_EOL."Chip ".$CGMadreM->chip.PHP_EOL."$examenCGMadreM".PHP_EOL."$resultadoCGMadreM".PHP_EOL."Color: ".$CGMadreM->color);
                        // $sheet->getStyle('L22')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbCGMadreM = '';                   
                        $nombreCGPadreM = '';                   
                    }
                }else{
                    $kcbTGMadreM = '';
                    $nombreTGMadreM = '';
                }

            }else{

                $kcbAbueloM     = '';
                $nombreAbueloM  = '';
            }

            if($mama->madre_id != null){

                $abuelaM = Ejemplar::find($mama->madre_id);

                $kcbAbuelaM     = ($abuelaM)?$abuelaM->kcb:'';
                $nombreAbuelaM  = ($abuelaM)?$abuelaM->nombre_completo:'';

                $examenMascotaabuelaM = ExamenMascota::where('ejemplar_id','=',$abuelaM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                if($examenMascotaabuelaM){
                    $examenabuelaM = $examenMascotaabuelaM->examen->nombre;
                    $resultadoabuelaM = $examenMascotaabuelaM->resultado;
                }else{
                    $examenabuelaM = "";
                    $resultadoabuelaM = "";
                }

                $sheet->setCellValue('F23', $nombreAbuelaM.PHP_EOL."K.C.B. ".$kcbAbuelaM.PHP_EOL."No. x Raza ".$abuelaM->num_tatuaje.PHP_EOL."Chip ".$abuelaM->chip.PHP_EOL."$examenabuelaM".PHP_EOL."$resultadoabuelaM".PHP_EOL."Color: ".$abuelaM->color);
                $sheet->getStyle('F23')->getAlignment()->setWrapText(true);

                if($abuelaM->padre_id != null){

                    $abueloSG   =Ejemplar::find($abuelaM->padre_id);

                    $kcbabueloMSG  = ($abueloSG)? $abueloSG->kcb:'' ;
                    $nombreabueloMSG  = ($abueloSG)? $abueloSG->nombre_completo:'' ;

                    $examenMascotaabueloSG = ExamenMascota::where('ejemplar_id','=',$abueloSG->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                    if($examenMascotaabueloSG){
                        $examenabueloSG = $examenMascotaabueloSG->examen->nombre;
                        $resultadoabueloSG = $examenMascotaabueloSG->resultado;
                    }else{
                        $examenabueloSG = "";
                        $resultadoabueloSG = "";
                    }
                    
                    $sheet->setCellValue('I23', $nombreabueloMSG.PHP_EOL."K.C.B. ".$kcbabueloMSG.PHP_EOL."No. x Raza ".$abueloSG->num_tatuaje.PHP_EOL."Chip ".$abueloSG->chip.PHP_EOL."$examenabueloSG".PHP_EOL."$resultadoabueloSG".PHP_EOL."Color: ".$abueloSG->color);
                    $sheet->getStyle('I23')->getAlignment()->setWrapText(true);

                    if($abueloSG->padre_id){

                        $abueloTG1   =Ejemplar::find($abueloSG->padre_id);

                        $kcbabueloMTG1  = ($abueloTG1)? $abueloTG1->kcb:'' ;
                        $nombreabueloMTG1  = ($abueloTG1)? $abueloTG1->nombre_completo:'' ;

                        $examenMascotaabueloTG1 = ExamenMascota::where('ejemplar_id','=',$abueloTG1->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaabueloTG1){
                            $examenabueloTG1 = $examenMascotaabueloTG1->examen->nombre;
                            $resultadoabueloTG1 = $examenMascotaabueloTG1->resultado;
                        }else{
                            $examenabueloTG1 = "";
                            $resultadoabueloTG1 = "";
                        }

                        $sheet->setCellValue('L23', $nombreabueloMTG1." K.C.B. ".$kcbabueloMTG1." No. x Raza ".$abueloTG1->num_tatuaje." Chip ".$abueloTG1->chip." $examenabueloTG1 "." $resultadoabueloTG1"." Color: ".$abueloTG1->color);
                        // $sheet->getStyle('L23')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L23', $nombreabueloMTG1.PHP_EOL."K.C.B. ".$kcbabueloMTG1.PHP_EOL."No. x Raza ".$abueloTG1->num_tatuaje.PHP_EOL."Chip ".$abueloTG1->chip.PHP_EOL."$examenabueloTG1".PHP_EOL."$resultadoabueloTG1".PHP_EOL."Color: ".$abueloTG1->color);
                        // $sheet->getStyle('L23')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbabueloMTG1  = '' ;
                        $nombreabueloMTG1  = '' ;
                    }
                    // la madre de la cuarta generacion
                    if($abueloSG->madre_id != null){

                        $abueloTG11   =Ejemplar::find($abueloSG->madre_id);

                        $kcbabueloMTG11  = ($abueloTG11)? $abueloTG11->kcb:'' ;
                        $nombreabueloMTG11  = ($abueloTG11)? $abueloTG11->nombre_completo:'' ;

                        $examenMascotaabueloTG11 = ExamenMascota::where('ejemplar_id','=',$abueloTG11->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaabueloTG11){
                            $examenabueloTG11 = $examenMascotaabueloTG11->examen->nombre;
                            $resultadoabueloTG11 = $examenMascotaabueloTG11->resultado;
                        }else{
                            $examenabueloTG11 = "";
                            $resultadoabueloTG11 = "";
                        }

                        $sheet->setCellValue('L24', $nombreabueloMTG11." K.C.B. ".$kcbabueloMTG11." No. x Raza ".$abueloTG11->num_tatuaje." Chip ".$abueloTG11->chip." $examenabueloTG11 "." $resultadoabueloTG11"." Color: ".$abueloTG11->color);
                        // $sheet->getStyle('L24')->getAlignment()->setWrapText(true);
                        // $sheet->setCellValue('L24', $nombreabueloMTG11.PHP_EOL."K.C.B. ".$kcbabueloMTG11.PHP_EOL."No. x Raza ".$abueloTG11->num_tatuaje.PHP_EOL."Chip ".$abueloTG11->chip.PHP_EOL."$examenabueloTG11".PHP_EOL."$resultadoabueloTG11".PHP_EOL."Color: ".$abueloTG11->color);
                        // $sheet->getStyle('L24')->getAlignment()->setWrapText(true);
                    }else{
                        $kcbabueloMTG11  = '' ;
                        $nombreabueloMTG11  = '' ;
                    }
                }else{
                    $kcbabueloMSG  = '' ;
                    $nombreabueloMSG  = '' ;
                }
                // de aqui comienza las madres de la abuela
                if($abuelaM->madre_id != null){

                    $abueloSGM2   =Ejemplar::find($abuelaM->madre_id);

                    $kcbabueloMSG2  = ($abueloSGM2)? $abueloSGM2->kcb:'' ;
                    $nombreabueloMSG2  = ($abueloSGM2)? $abueloSGM2->nombre_completo:'' ;

                    $examenMascotaabueloSGM2 = ExamenMascota::where('ejemplar_id','=',$abueloSGM2->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                    if($examenMascotaabueloSGM2){
                        $examenabueloSGM2 = $examenMascotaabueloSGM2->examen->nombre;
                        $resultadoabueloSGM2 = $examenMascotaabueloSGM2->resultado;
                    }else{
                        $examenabueloSGM2 = "";
                        $resultadoabueloSGM2 = "";
                    }

                    $sheet->setCellValue('I25', $nombreabueloMSG2.PHP_EOL."K.C.B. ".$kcbabueloMSG2.PHP_EOL."No. x Raza ".$abueloSGM2->num_tatuaje.PHP_EOL."Chip ".$abueloSGM2->chip.PHP_EOL."$examenabueloSGM2".PHP_EOL."$resultadoabueloSGM2".PHP_EOL."Color: ".$abueloSGM2->color);
                    $sheet->getStyle('I25')->getAlignment()->setWrapText(true);

                    if($abueloSGM2->padre_id != null){

                        $abueloSGM22   = Ejemplar::find($abueloSGM2->padre_id);

                        // dd($abueloSGM22);

                        $kcbabueloMSG22  = ($abueloSGM22)? $abueloSGM22->kcb:'' ;
                        $nombreabueloMSG22  = ($abueloSGM22)? $abueloSGM22->nombre_completo:'' ;

                        $examenMascotaabueloSGM22 = ExamenMascota::where('ejemplar_id','=',$abueloSGM22->id)
                                            ->where('examen_id','=',3)
                                            ->first();

                                            // dd($examenMascotaabueloSGM22);
                        if($examenMascotaabueloSGM22){
                            $examenabueloSGM22 = $examenMascotaabueloSGM22->examen->nombre;
                            $resultadoabueloSGM22 = $examenMascotaabueloSGM22->resultado;
                        }else{
                            $examenabueloSGM22 = '1';
                            $resultadoabueloSGM22 = '1';
                        }
                            // dd($resultadoabueloSGM22." - ".$resultadoabueloSGM22." nombre ".$nombreabueloMSG22." kcb: ".$kcbabueloMSG22." tatu: ".$abueloSGM22->num_tatuaje." chip: ".$abueloSGM22->chip." colo: ".$abueloSGM22->color);
                        // dd($nombreabueloMSG22);
                        if (!strstr($nombreabueloMSG22, '=')){
                            $sheet->setCellValue('L25', "$nombreabueloMSG22"." K.C.B. "."$kcbabueloMSG22"." No. x Raza "."$abueloSGM22->num_tatuaje"." Chip "."$abueloSGM22->chip"." $examenabueloSGM22 "." $resultadoabueloSGM22"." Color: "."$abueloSGM22->color");
                            // $sheet->getStyle('L25')->getAlignment()->setWrapText(true);
                            // $sheet->setCellValue('L25', "$nombreabueloMSG22".PHP_EOL."K.C.B. "."$kcbabueloMSG22".PHP_EOL."No. x Raza "."$abueloSGM22->num_tatuaje".PHP_EOL."Chip "."$abueloSGM22->chip".PHP_EOL."$examenabueloSGM22".PHP_EOL."$resultadoabueloSGM22".PHP_EOL."Color: "."$abueloSGM22->color");
                            // $sheet->getStyle('L25')->getAlignment()->setWrapText(true);
                        }
                        // $sheet->setCellValue('L25', "===");
                    }else{

                        $kcbabueloMSG22  = '' ;
                        $nombreabueloMSG22  = '' ;  
                    }
                    if($abueloSGM2->madre_id != null){

                        $abueloSGM222   =Ejemplar::find($abueloSGM2->madre_id);

                        $kcbabueloMSG222  = ($abueloSGM222)? $abueloSGM222->kcb:'' ;
                        $nombreabueloMSG222  = ($abueloSGM222)? $abueloSGM222->nombre_completo:'' ;

                        $examenMascotaabueloSGM222 = ExamenMascota::where('ejemplar_id','=',$abueloSGM222->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                        if($examenMascotaabueloSGM222){
                            $examenabueloSGM222 = $examenMascotaabueloSGM222->examen->nombre;
                            $resultadoabueloSGM222 = $examenMascotaabueloSGM222->resultado;
                        }else{
                            $examenabueloSGM222 = "";
                            $resultadoabueloSGM222 = "";
                        }
                        if(!strstr($nombreabueloMSG222, '=')){
                            $sheet->setCellValue('L26', $nombreabueloMSG222." K.C.B. ".$kcbabueloMSG222." No. x Raza ".$abueloSGM222->num_tatuaje." Chip ".$abueloSGM222->chip." $examenabueloSGM222 "." $resultadoabueloSGM222"." Color: ".$abueloSGM222->color);
                            // $sheet->getStyle('L26')->getAlignment()->setWrapText(true);
                            // $sheet->setCellValue('L26', $nombreabueloMSG222.PHP_EOL."K.C.B. ".$kcbabueloMSG222.PHP_EOL."No. x Raza ".$abueloSGM222->num_tatuaje.PHP_EOL."Chip ".$abueloSGM222->chip.PHP_EOL."$examenabueloSGM222".PHP_EOL."$resultadoabueloSGM222".PHP_EOL."Color: ".$abueloSGM222->color);
                            // $sheet->getStyle('L26')->getAlignment()->setWrapText(true);
                        }
                    }else{
                        $kcbabueloMSG222  = '' ;
                        $nombreabueloMSG222  = '' ;
                    }
                }else{
                    $kcbabueloMSG2  = '' ;
                    $nombreabueloMSG2  = '' ;
                }
            }else{
                $kcbAbuelaM     = '';
                $nombreAbuelaM  = '';
            }

        }else{
            $kcbMama = '';
            $nombreMama = '';
        }

        // ********* PIE DE PAGINA *************
        $sheet->setCellValue('E29', $ejemplar->lechigada);
        $sheet->setCellValue('E31', $ejemplar->fecha_emision);
        // exportamos el excel
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

    }

    public function ajaxGuardaEjemplar(Request $request){
        
        // dd($request->all());

        $ejemplar = new Ejemplar();
        
        $ejemplar->user_id              = Auth::user()->id;
        $ejemplar->nombre               = $request->input('edita_nuevo_nombre');
        $ejemplar->nombre_completo      = $request->input('edita_nuevo_nombre');
        $ejemplar->raza_id              = $request->input('edita_nuevo_raza');       
        $ejemplar->sexo                 = $request->input('edita_nuevo_sexo');
        $ejemplar->codigo_nacionalizado = $request->input('edita_nuevo_codigo');
        $ejemplar->color                = $request->input('edita_nuevo_color');
        $ejemplar->senas                = $request->input('edita_nuevo_senas');
        $ejemplar->origen               = $request->input('edita_nuevo_origen');
        $ejemplar->lugar_extranjero     = $request->input('edita_nuevo_lugar');
        $ejemplar->fecha_nacimiento     = $request->input('edita_nuevo_fecha_nacimiento');
        $ejemplar->titulos_extranjeros  = $request->input('edita_nuevo_titulos');
        $ejemplar->extranjero           = "si";

        $ejemplar->save();

        // $ejemplarEditar = Ejemplar::find($request->input('edita_ejemplar_id'));

        // if($request->input('edita_nuevo_sexo') == "Macho"){
        //     $ejemplarEditar->padre_id = $ejemplar->id;
        // }else{
        //     $ejemplarEditar->madre_id = $ejemplar->id;
        // }

        return view('ejemplar.ajaxGuardaEjemplar')->with(compact('ejemplar'));
    }

    public function registroNuevoEjemplarCamada(Request $request){
        // dd($request->all());
        $ejemplarHermano = Ejemplar::where('camada_id',$request->input('registro-nuevo-camada_id'))->first();

        $ejemplar = new Ejemplar();

        $ejemplar->user_id                  = Auth::user()->id;
        $ejemplar->madre_id                 = $ejemplarHermano->madre_id;
        $ejemplar->padre_id                 = $ejemplarHermano->padre_id;
        $ejemplar->raza_id                  = $ejemplarHermano->raza_id;
        $ejemplar->camada_id                = $ejemplarHermano->camada_id;
        $ejemplar->criadero_id              = $ejemplarHermano->criadero_id;
        $ejemplar->propietario_id           = $ejemplarHermano->propietario_id;
        $ejemplar->kcb                      = $request->input('registro-nuevo-kcb');                    
        $ejemplar->num_tatuaje              = $request->input('registro-nuevo-tatuaje');                    
        $ejemplar->chip                     = $request->input('registro-nuevo-chip');                    
        $ejemplar->fecha_nacimiento         = $ejemplarHermano->fecha_nacimiento;                    
        $ejemplar->color                    = $request->input('registro-nuevo-color');                    
        $ejemplar->senas                    = $request->input('registro-nuevo-senas');                    
        $ejemplar->nombre                   = $request->input('registro-nuevo-nombre');                    
        $ejemplar->primero_mostrar          = $ejemplarHermano->primero_mostrar;                    
        $ejemplar->prefijo                  = $ejemplarHermano->prefijo;                    
        $ejemplar->lechigada                = $ejemplarHermano->lechigada;                    
        $ejemplar->sexo                     = $request->input('registro-nuevo-sexo');
        $ejemplar->departamento             = $ejemplarHermano->departamento;                    
        $ejemplar->fecha_emision            = $ejemplarHermano->fecha_emision;                    

        $criadero = Criadero::find($ejemplarHermano->criadero_id);

        if($ejemplar->primero_mostrar == "Nombre"){
            $nombreCompleto         = $ejemplar->nombre;
            if($ejemplar->prefijo == ""){
                $nombreCompleto     = $nombreCompleto." ";
            }else{
                $nombreCompleto     = $nombreCompleto." ".$ejemplar->prefijo." ";
            }
            $nombreCompleto         = $nombreCompleto.$criadero->nombre;
        }else{
            $nombreCompleto         = $criadero->nombre;
            if($ejemplar->prefijo == ""){
                $nombreCompleto     = $nombreCompleto." ";
            }else{
                $nombreCompleto     = $nombreCompleto." ".$ejemplar->prefijo." "; 
            }
            $nombreCompleto         = $nombreCompleto." ".$ejemplar->nombre;
        }

        $ejemplar->nombre_completo  = $nombreCompleto;

        $ejemplar->save();

        return redirect("Ejemplar/listadoCamada/$ejemplarHermano->camada_id");
    }


    public function demoModificacion()
    {

        $arrayOriginal = array();
        $arrayModificacion = array();

        $arrayOriginal = [
                            'nombre'=>'SnoopyMOD',
                            'kcb'=>'45001',
        ];

        $arrayModificacion = [
                            'nombre'=>'Snoopy MOD 2',
                            'kcb'=>'45001',
        ];

        $modificacion              = new Modificacione();
        $modificacion->user_id     = Auth::user()->id;
        $modificacion->registro_id = 23;
        $modificacion->tabla       = 'ejemplares';
        $modificacion->original    = json_encode($arrayOriginal);
        $modificacion->cambio      = json_encode($arrayModificacion);
        $modificacion->save();
        
        echo 'Se guardo';
    }

    public function muestraModificacion(Request $request, $tabla, $registro) 
    {
        $modificaciones = Modificacione::where('tabla', $tabla)
                                        ->where('registro_id', $registro)
                                        ->orderBy('id', 'desc')
                                        ->get();

        $examenEjemplar = ExamenMascota::onlyTrashed()
                                        ->where('ejemplar_id',$registro)
                                        ->get();

        $transferenciaEjemplar = Transferencia::onlyTrashed()
                                        ->where('ejemplar_id',$registro)
                                        ->get();


        $tituloEjemplar = TituloEjemplar::onlyTrashed()
                                        ->where('ejemplar_id',$registro)
                                        ->get();

        $examenEjemplarAsignacion = ExamenMascota::withTrashed()
                                        ->where('ejemplar_id',$registro)
                                        ->get();

        $transferenciaEjemplarAsignacion = Transferencia::withTrashed()
                                        ->where('ejemplar_id',$registro)
                                        ->get();


        $tituloEjemplarAsignacion = TituloEjemplar::withTrashed()
                                        ->where('ejemplar_id',$registro)
                                        ->get();
                                        
        // dd($examenEjemplar);

        /*foreach($modificaciones as $m){
            $original = json_decode($m->original, true);
            dd($original['kcb']);
            // echo $m->original." - ".$original." - ";
            // echo $m->cambio."<br />";
        }*/

        return view('ejemplar.muestraModificacion')->with(compact('modificaciones', 'examenEjemplar', 'transferenciaEjemplar', 'tituloEjemplar', 'examenEjemplarAsignacion', 'transferenciaEjemplarAsignacion', 'tituloEjemplarAsignacion'));
    }

    private function guardaModificacion($tabla, $registro_id, $arrayOriginal, $arrayCambio)
    {

        // $arrayOriginal = array();
        // $arrayModificacion = array();

        /*$arrayOriginal = [
                            'nombre'=>'SnoopyMOD',
                            'kcb'=>'45001',
        ];

        $arrayModificacion = [
                            'nombre'=>'Snoopy MOD 2',
                            'kcb'=>'45001',
        ];*/

        $modificacion              = new Modificacione();
        $modificacion->user_id     = Auth::user()->id;
        $modificacion->registro_id = $registro_id;
        $modificacion->tabla       = $tabla;
        $modificacion->original    = json_encode($arrayOriginal);
        $modificacion->cambio      = json_encode($arrayCambio);
        $modificacion->save();


        // $arrayOriginal1 = json_encode($arrayOriginal);
        // $arrayCambio1   = json_encode($arrayCambio);

        
        $arrayOriginal1 = $arrayOriginal;
        $arrayCambio1   = $arrayCambio;

        if($arrayOriginal1['kcb'] != $arrayCambio1['kcb']){

            $this->addbitacora($registro_id, 'KCB', $arrayOriginal1['kcb'],$arrayCambio1['kcb'], 'Modificado');

        }

        if($arrayOriginal1['nombre'] != $arrayCambio1['nombre']){

            $this->addbitacora($registro_id, 'NOMBRE', $arrayOriginal1['nombre'],$arrayCambio1['nombre'], 'Modificado');

        }

        if($arrayOriginal1['padre_id'] != $arrayCambio1['padre_id']){

            $padreOrigen = Ejemplar::find($arrayOriginal1['padre_id']);
            if($padreOrigen){
                $padreOrigenadd = $padreOrigen->nombre;
            }else{
                $padreOrigenadd = "";
            }

            $padreCambio = Ejemplar::find($arrayCambio1['padre_id']);
            if($padreCambio){
                $padreCambioadd = $padreCambio->nombre;
            }else{
                $padreCambioadd = "";
            }

            $this->addbitacora($registro_id, 'PADRE', $padreOrigenadd, $padreCambioadd, 'Modificado');

        }

        if($arrayOriginal1['madre_id'] != $arrayCambio1['madre_id']){

            $madreOrigen = Ejemplar::find($arrayOriginal1['madre_id']);
            if($madreOrigen){
                $madreOrigenadd = $madreOrigen->nombre;
            }else{
                $madreOrigenadd = "";
            }

            $madreCambio = Ejemplar::find($arrayCambio1['madre_id']);
            if($madreCambio){
                $madreCambioadd = $madreCambio->nombre;
            }else{
                $madreCambioadd = "";
            }

            $this->addbitacora($registro_id, 'MADRE', $madreOrigenadd, $madreCambioadd, 'Modificado');

        }

        if($arrayOriginal1['raza_id'] != $arrayCambio1['raza_id']){

            $razaOrigen = Raza::find($arrayOriginal1['raza_id']);
            $razaCambio = Raza::find($arrayCambio1['raza_id']);
            // dd($razaOrigen);

            $this->addbitacora($registro_id, 'RAZA', ($razaOrigen != null)? $razaOrigen->nombre: '', $razaCambio->nombre, 'Modificado');

        }

        // dd($arrayOriginal1['criadero_id']);
        // dd($arrayCambio1['criadero_id']);

        if($arrayOriginal1['criadero_id'] != $arrayCambio1['criadero_id']){

            if($arrayOriginal1['criadero_id']){

                $criaderoOrigen1 = Criadero::find($arrayOriginal1['criadero_id']);
                
                if($criaderoOrigen1){
                    $criaderoOrigen = $criaderoOrigen1->nombre;
                }else{
                    $criaderoOrigen = null;
                }
            }else{
                $criaderoOrigen = null;
            }

            if($arrayCambio1['criadero_id']){
                $criaderoCambio1 = Criadero::find($arrayCambio1['criadero_id']);
                $criaderoCambio  = $criaderoCambio1->nombre;
            }else{
                $criaderoCambio = null;
            }

            $this->addbitacora($registro_id, 'CRIADERO', $criaderoOrigen, $criaderoCambio, 'Modificado');

        }

        if($arrayOriginal1['propietario_id'] != $arrayCambio1['propietario_id']){

            if($arrayOriginal1['propietario_id']){
                $propietarioOrigen1 = User::find($arrayOriginal1['propietario_id']);
                $propietarioOrigen  = $propietarioOrigen1->name;
            }else{
                $propietarioOrigen = null;
            }

            if($arrayCambio1['propietario_id']){
                $propietarioCambio1 = User::find($arrayCambio1['propietario_id']);
                $propietarioCambio  = $propietarioCambio1->nombre;
            }else{
                $propietarioCambio = null;
            }

            $this->addbitacora($registro_id, 'PROPIETARIO', $propietarioOrigen, $propietarioCambio, 'Modificado');

        }

        if($arrayOriginal1['codigo_nacionalizado'] != $arrayCambio1['codigo_nacionalizado']){

            $this->addbitacora($registro_id, 'CODIGO NACIONALIZADO', $arrayOriginal1['codigo_nacionalizado'], $arrayCambio1['codigo_nacionalizado'], 'Modificado');

        }

        if($arrayOriginal1['num_tatuaje'] != $arrayCambio1['num_tatuaje']){

            $this->addbitacora($registro_id, 'TATUAJE', $arrayOriginal1['num_tatuaje'], $arrayCambio1['num_tatuaje'], 'Modificado');

        }

        if($arrayOriginal1['chip'] != $arrayCambio1['chip']){

            $this->addbitacora($registro_id, 'CHIP', $arrayOriginal1['chip'], $arrayCambio1['chip'], 'Modificado');

        }

        if($arrayOriginal1['fecha_nacimiento'] != $arrayCambio1['fecha_nacimiento']){

            $this->addbitacora($registro_id, 'FECHA DE NACIMIENTO', $arrayOriginal1['fecha_nacimiento'], $arrayCambio1['fecha_nacimiento'], 'Modificado');

        }

        if($arrayOriginal1['color'] != $arrayCambio1['color']){

            $this->addbitacora($registro_id, 'COLOR', $arrayOriginal1['color'], $arrayCambio1['color'], 'Modificado');

        }

        if($arrayOriginal1['senas'] != $arrayCambio1['senas']){

            $this->addbitacora($registro_id, 'SENAS', $arrayOriginal1['senas'], $arrayCambio1['senas'], 'Modificado');

        }
        
        if($arrayOriginal1['lechigada'] != $arrayCambio1['lechigada']){

            $this->addbitacora($registro_id, 'LECHIGADA', $arrayOriginal1['lechigada'], $arrayCambio1['lechigada'], 'Modificado');

        }

        if($arrayOriginal1['sexo'] != $arrayCambio1['sexo']){

            $this->addbitacora($registro_id, 'SEXO', $arrayOriginal1['sexo'], $arrayCambio1['sexo'], 'Modificado');

        }

        if($arrayOriginal1['consanguinidad'] != $arrayCambio1['consanguinidad']){

            $this->addbitacora($registro_id, 'CONSANGUINIDAD', $arrayOriginal1['consanguinidad'], $arrayCambio1['consanguinidad'], 'Modificado');

        }

        if($arrayOriginal1['hermano'] != $arrayCambio1['hermano']){

            $this->addbitacora($registro_id, 'HERMANO', $arrayOriginal1['hermano'], $arrayCambio1['hermano'], 'Modificado');

        }

        if($arrayOriginal1['departamento'] != $arrayCambio1['departamento']){

            $this->addbitacora($registro_id, 'DEPARTAMENTO', $arrayOriginal1['departamento'], $arrayCambio1['departamento'], 'Modificado');

        }

        if($arrayOriginal1['fecha_fallecido'] != $arrayCambio1['fecha_fallecido']){

            $this->addbitacora($registro_id, 'FECHA FALLECIDO', $arrayOriginal1['fecha_fallecido'], $arrayCambio1['fecha_fallecido'], 'Modificado');

        }

        if($arrayOriginal1['fecha_emision'] != $arrayCambio1['fecha_emision']){

            $this->addbitacora($registro_id, 'FECHA EMISION', $arrayOriginal1['fecha_emision'], $arrayCambio1['fecha_emision'], 'Modificado');

        }

        if($arrayOriginal1['fecha_nacionalizado'] != $arrayCambio1['fecha_nacionalizado']){

            $this->addbitacora($registro_id, 'FECHA NACIONALIZADO', $arrayOriginal1['fecha_nacionalizado'], $arrayCambio1['fecha_nacionalizado'], 'Modificado');

        }

    }
    
    public function validaKcb(Request $request){
        // dd($request->all());
        $verificaKcb = Ejemplar::where('kcb', $request->kcb)
                            ->count();

        return response()->json(['vKcb'=>$verificaKcb]);
    }

    public function eliminaEjemplar(Request $request, $ejemplar_id){

        // actualizamos el campo eliminador 
        $ejemplar = Ejemplar::find($ejemplar_id);

        $ejemplar->eliminador_id    = Auth::user()->id;

        if($ejemplar->sexo == 'Macho'){
            $hijos = Ejemplar::where('padre_id',$ejemplar_id)->get();

            if($hijos){

                foreach ($hijos as $h){
    
                    $h->padre_id = null;
    
                    $h->save();
                }
    
            }
        }else{
            $hijos = Ejemplar::where('madre_id',$ejemplar_id)->get();

            if($hijos){

                foreach ($hijos as $h){
    
                    $h->madre_id = null;
    
                    $h->save();
                }
    
            }
        }

        // eliminamos al ejemplar como tal
        Ejemplar::destroy($ejemplar_id);
        
        $ejemplar->save();

        return redirect("Ejemplar/listado");
    }

    public function generaPdf(){
        $miNombre = "Cristiam Herrera Daza";

        // se carga la vista como se llama a cualquier vista para
        // se ha creado una carpeta en views/pdf para los archivos
        // de plantillas html, estan son como una pagina en blanco 
        // sin heredar ningun template
        $pdf    = PDF::loadView('pdf.pedigree', compact('miNombre'))->setPaper('letter');

        // si queremos que el pdf se descargue
        // return $pdf->download('boletinInscripcion_'.date('Y-m-d H:i:s').'.pdf');

        // siqueremos que el pdf se muestre
        return $pdf->stream('boletinInscripcion_'.date('Y-m-d H:i:s').'.pdf');        
    }

    public function certificadoRosado(Request $request, $ejemplar_id){

        $ejemplar = Ejemplar::find($ejemplar_id);

        return view('certificado.certificadoRosado')->with(compact('ejemplar'/*, 'examenEjemplar', 'transferenciaEjemplar', 'tituloEjemplar', 'examenEjemplarAsignacion', 'transferenciaEjemplarAsignacion', 'tituloEjemplarAsignacion'*/));
    }

    public function certificadoRosadoAdelante(Request $request,$ejemplar_id){
        
        $examenAptoCria = ExamenMascota::where('ejemplar_id',$ejemplar_id)
                                        ->where('examen_id',2)
                                        ->first();

        $ejemplar = Ejemplar::find($ejemplar_id);

                                    
        return view('certificado.certificadoRosadoAdelante')->with(compact('ejemplar'/*, 'examenEjemplar', 'transferenciaEjemplar', 'tituloEjemplar', 'examenEjemplarAsignacion', 'transferenciaEjemplarAsignacion', 'tituloEjemplarAsignacion'*/));
    }

    public function bitacora(Request $request){

        $modificaiones = ModificacionEspecifico::orderBy('id', 'desc')->get();

        return view('ejemplar.bitacora')->with(compact('modificaiones'));
        // dd("en desarrollo :v");
    }

    private function addbitacora($ejemplar, $campo, $dato_anterior, $dato_modificado, $accion){

        $modificaionEspecifica = new ModificacionEspecifico();

        $modificaionEspecifica->user_id             = Auth::user()->id;
        $modificaionEspecifica->ejemplar_id         = $ejemplar;
        $modificaionEspecifica->campo               = $campo;
        $modificaionEspecifica->dato_anteriror      = $dato_anterior;
        $modificaionEspecifica->dato_modificado     = $dato_modificado;
        $modificaionEspecifica->accion              = $accion;

        $modificaionEspecifica->save();
    }

    public function listaCamadasPadres(Request $request, $ejemplar_id, $padre ){
        $camada = Camada::where(($padre==1)?'padre_id':'madre_id',$ejemplar_id)
                            ->orderBy('id','desc')
                            ->get();

        return view('ejemplar.listaCamadasPadres')->with(compact('camada'));
    }

    public function certificadoExportacion(Request $request, $ejemplar_id){
        $ejemplar = Ejemplar::find($ejemplar_id);

        return view('certificado.certificadoExportacion')->with(compact('ejemplar'/*, 'examenEjemplar', 'transferenciaEjemplar', 'tituloEjemplar', 'examenEjemplarAsignacion', 'transferenciaEjemplarAsignacion', 'tituloEjemplarAsignacion'*/));

        // $pdf    = PDF::loadView('certificado.certificadoExportacion', compact('ejemplar'))->setPaper('landscape');

        // si queremos que el pdf se descargue
        // return $pdf->download('boletinInscripcion_'.date('Y-m-d H:i:s').'.pdf');

        // siqueremos que el pdf se muestre
        // return $pdf->stream('boletinInscripcion_'.date('Y-m-d H:i:s').'.pdf');   
    }

    public static function armaEjemplarCertificado($ejemplar,$generacion){

        if($generacion == 1){
            if($ejemplar->extranjero == 'si'){
                echo "<span class='text-danger'>".$ejemplar->titulosEjemplares."<br></span>";
            }else{
                $titulosw = TituloEjemplar::where('ejemplar_id',$ejemplar->id)->count();
                if($titulosw != 0){
                    $titulo = TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                    $i = 1;
                    foreach ($titulo as $t){
                        if($i <= 5){
                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                            $i++;
                        }else{
                            $i = 1;
                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                        }
                    }
                    echo "<br>";
                }
            }

            echo $ejemplar->nombre_completo."<br>";

            if(!($ejemplar->kcb == 'nulo' || $ejemplar->kcb == '')){
                echo "K.C.B. ".$ejemplar->kcb."<br>";
            }else{
                echo $ejemplar->codigo_nacionalizado."<br>";
            }

            if($ejemplar->num_tatuaje != ''){
                echo "No. x Raza ".$ejemplar->num_tatuaje."<br>";
            }

            if($ejemplar->chip != ''){
                echo "Chip ".$ejemplar->chip."<br>";
            }

            $examenMascotaPapa = ExamenMascota::where('ejemplar_id','=',$ejemplar->id)
                                                    ->get();
            foreach ($examenMascotaPapa as $e){
                echo $e->examen->nombre.": ".$e->resultado."<br>";
                // echo " ".$e->resultado."<br>";
            }

            if($ejemplar->color != '0' && $ejemplar->color != '.'){
                echo "Color: ".$ejemplar->color;
            }
        }elseif($generacion == 2){
            if($ejemplar->extranjero == 'si'){
                echo "<span class='text-danger'>".$ejemplar->titulos_extranjeros."<br></span>";
            }else{
                $titulosw = TituloEjemplar::where('ejemplar_id',$ejemplar->id)->count();
                if($titulosw != 0){
                    $titulo = TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                    $i = 1;
                    foreach ($titulo as $t){
                        if($t->titulo){
                            if($i <= 4){
                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                $i++;
                            }else{
                                $i = 1;
                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                            }
                        }
                    }
                    echo "<br>";
                }
            }
            
            echo $ejemplar->nombre_completo."<br>";
            if(!($ejemplar->kcb == 'nulo' || $ejemplar->kcb == '')){
                echo "K.C.B. ".$ejemplar->kcb."<br>";
            }else{
                echo $ejemplar->codigo_nacionalizado."<br>";
            }
            if($ejemplar->num_tatuaje != ''){
                echo "No. x Raza ".$ejemplar->num_tatuaje."<br>";
            }
            if($ejemplar->chip != ''){
                echo "Chip ".$ejemplar->chip."<br>";
            }
            // echo "K.C.B. ".$ejemplar->kcb."<br>";
            // echo "No. x Raza ".$ejemplar->num_tatuaje."<br>";
            // echo "Chip ".$ejemplar->chip."<br>";

            $examenMascotaPapa = ExamenMascota::where('ejemplar_id','=',$ejemplar->id)
                        ->get();
            foreach($examenMascotaPapa as $e){
                if($e->examen){
                    echo $e->examen->nombre.": ".$e->resultado."<br>";
                }
            }
            if($ejemplar->color != '0' && $ejemplar->color != '.'){
                echo "Color: ".$ejemplar->color;
            }
        }elseif($generacion == 3){
            if($ejemplar->extranjero == 'si'){
                echo "<span class='text-danger'>".$ejemplar->titulos_extranjeros."<br></span>";
            }else{
                $titulosw = TituloEjemplar::where('ejemplar_id',$ejemplar->id)->count();
                if($titulosw != 0){
                    $titulo = TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                    $i = 1;
                    foreach ($titulo as $t){
                        if($i <= 9){
                            if($t->titulo){
                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                $i++;
                            }
                        }else{
                            $i = 1;
                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                        }
                    }
                    echo "<br>";
                }
            }

            echo $ejemplar->nombre_completo." ";

            if(!($ejemplar->kcb == 'nulo' || $ejemplar->kcb == '')){
                echo "K.C.B. ".$ejemplar->kcb."<br>";
            }else{
                echo $ejemplar->codigo_nacionalizado."<br>";
            }
            if($ejemplar->num_tatuaje != ''){
                echo "No. x Raza ".$ejemplar->num_tatuaje." ";
            }
            if($ejemplar->chip != ''){
                echo "Chip ".$ejemplar->chip."<br>";
            }

            // echo "K.C.B. ".$ejemplar->kcb."<br>";
            // echo "No. x Raza ".$ejemplar->num_tatuaje." ";
            // echo "Chip ".$ejemplar->chip."<br>";

            $examenMascotaPapa = ExamenMascota::where('ejemplar_id','=',$ejemplar->id)
                        ->where('examen_id','=',3)
                        ->first();
            if($examenMascotaPapa){
                $examenPapa = $examenMascotaPapa->examen->nombre;
                $resultadoPapa = $examenMascotaPapa->resultado;
            }else{
                $examenPapa = "";
                $resultadoPapa = "";
            }

            if($examenPapa != ""){
                echo $examenPapa." ".$resultadoPapa."<br>";
            }
            if($ejemplar->color != '0' && $ejemplar->color != '.'){
                echo "Color: ".$ejemplar->color;
            }
        }else{
            if($ejemplar->extranjero == 'si'){
                echo "<span class='text-danger'>".$ejemplar->titulos_extranjeros."<br></span>";
            }else{
                $titulosw = TituloEjemplar::where('ejemplar_id',$ejemplar->id)->count();
                if($titulosw != 0){
                    $titulo = TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                    $i = 1;
                    foreach ($titulo as $t){
                        if($t->titulo){
                            if($i <= 12){
                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                $i++;
                            }else{
                                $i = 1;
                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                            }
                        }
                    }
                    echo "<br>";
                }
            }
            
            echo $ejemplar->nombre_completo." ";

            if(!($ejemplar->kcb == 'nulo' || $ejemplar->kcb == '')){
                echo "K.C.B. ".$ejemplar->kcb." ";
            }else{
                echo $ejemplar->codigo_nacionalizado."<br>";
            }
            if($ejemplar->num_tatuaje != ''){
                echo "No. x Raza ".$ejemplar->num_tatuaje." ";
            }
            if($ejemplar->chip != ''){
                echo "Chip ".$ejemplar->chip." ";
            }

            $examenMascotaPapa = ExamenMascota::where('ejemplar_id','=',$ejemplar->id)
                        ->where('examen_id','=',3)
                        ->first();
            if($examenMascotaPapa){
                $examenPapa = $examenMascotaPapa->examen->nombre;
                $resultadoPapa = $examenMascotaPapa->resultado;
            }else{
                $examenPapa = "";
                $resultadoPapa = "";
            }

            echo $examenPapa." ";
            echo $resultadoPapa." ";
            if($ejemplar->color != '0' && $ejemplar->color != '.'){
                echo "Color: ".$ejemplar->color." ";
            }   
        }
        // echo $ejemplar->id;
    }

    public function generaExcel(Request $request){
        // dd($request->all());
        
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

        $queryEjemplares->whereNull('extranjero');

        if ($request->filled('kcb_buscar') || $request->filled('nombre_buscar') || $request->filled('chip_buscar') || $request->filled('raza_buscar') || $request->filled('propietario_buscar')) {
            $queryEjemplares->limit(300);
        }else{
            $queryEjemplares->limit(200);
        }


        $ejemplares = $queryEjemplares->get();

        // generacion del excel
        $fileName = 'ListadoEjemplares.xlsx';
        $libro = new Spreadsheet();

        $hoja = $libro->getActiveSheet();
        
        $hoja->setCellValue('A1', 'LISTA DE EJEMPLARES');
        $hoja->setCellValue('A2', 'ID');
        $hoja->setCellValue('B2', 'KCB');
        $hoja->setCellValue('C2', 'NOMBRE');
        $hoja->setCellValue('D2', 'CHIP');
        $hoja->setCellValue('E2', 'RAZA');
        $hoja->setCellValue('F2', 'PROPIETARIO');
        $hoja->setCellValue('G2', 'DEPARTAMENTO');

        $libro->getActiveSheet()->mergeCells('A1:G1');

        $contador = 3;

        foreach($ejemplares as $key => $eje){
            
            $hoja->setCellValue("A$contador", $eje->id);
            $hoja->setCellValue("B$contador", $eje->kcb);
            $hoja->setCellValue("C$contador", $eje->nombre_completo);
            $hoja->setCellValue("D$contador", $eje->chip);
            $hoja->setCellValue("E$contador", ($eje->raza)? $eje->raza->nombre : '');
            $hoja->setCellValue("F$contador", ($eje->propietario)? $eje->propietario->name: '');
            $hoja->setCellValue("G$contador", $eje->departamento);

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

        $libro->getActiveSheet()->getStyle("A2:G$estilobor")->applyFromArray(
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

        $libro->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        $libro->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $libro->getActiveSheet()->getColumnDimension('E')->setWidth(70);
        $libro->getActiveSheet()->getColumnDimension('F')->setWidth(50);
        $libro->getActiveSheet()->getColumnDimension('G')->setWidth(17);


        $libro->getActiveSheet()->getStyle('A2:G2')->applyFromArray($fuenteNegrita);

        $style = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            )
        );

        $hoja->getStyle("A1")->applyFromArray($style);
        $hoja->getStyle("A2:G2")->applyFromArray($style);

        // exportamos el excel
        $writer = new Xlsx($libro);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

    } 
}
