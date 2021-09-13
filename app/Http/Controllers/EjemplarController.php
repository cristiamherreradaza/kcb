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
use App\Transferencia;
use App\TituloEjemplar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        $nuevoExamen                    = new ExamenMascota();
        $nuevoExamen->user_id           = Auth::user()->id;
        $nuevoExamen->ejemplar_id       = $request->input('ejemplar_examen_id');
        $nuevoExamen->examen_id         = $request->input('nombre_examen');
        $nuevoExamen->fecha_examen      = $request->input('fecha_examen');
        $nuevoExamen->dcf               = $request->input('examen_dcf');
        $nuevoExamen->resultado         = $request->input('resultado');
        $nuevoExamen->numero_formulario = $request->input('examen_num_formulario');
        $nuevoExamen->revisor           = $request->input('doctor_examen');
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
        
        return view('ejemplar.ajaxGuardaTitulo')->with(compact('titulosEjemplares'));
    }

    public function ajaxEliminaTitulo(Request $request){

        $tituloEjemplar = TituloEjemplar::find($request->idTituloEjemplar);

        $eliminaTitulo = TituloEjemplar::destroy($request->idTituloEjemplar);

        $titulosEjemplares = TituloEjemplar::where('ejemplar_id', $tituloEjemplar->ejemplar_id)
                                            ->orderBy('id', 'desc')  
                                            ->get();

        return view('ejemplar.ajaxGuardaTitulo')->with(compact('titulosEjemplares'));
    }

    public function informacion(Request $request, $ejemplarId)
    {
        // dd($id);
        $ejemplar = Ejemplar::find($ejemplarId);
        // dd($ejemplar);
        return view('ejemplar.informacion')->with(compact('ejemplar'));
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
        // dd($request->input("ejemplar.0.nombre"));
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
        $sheet->setCellValue('C3', "$ejemplar->nombre_completo");

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
}
