<?php

namespace App\Http\Controllers;

use App\User;
use App\Criadero;
use App\PropietarioCriadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\queue;

class CriaderoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listado()
    {
        // $criaderos = Criadero::all();
        $criaderos = PropietarioCriadero::all();
        // dd($criaderos);

        return view('criaderos.listado')->with(compact('criaderos'));
    }

    // public function listadoPropietarios()
    // {
    //     $usuarios = User::where('perfil_id', 3)
    //                     ->get();

    //     $sucursales = Sucursal::all();
    //     $perfiles = Perfil::all();

    //     return view('user.listadoPropietarios')->with(compact('usuarios', 'sucursales', 'perfiles'));
    // }

    public function formulario(Request $request, $id)
    {

        if($id != 0){
            $propietarioCriador = PropietarioCriadero::where("criadero_id",$id)
                                            ->first();
        }else{
            $propietarioCriador = null;
        }

        return view('criaderos.formulario')->with(compact('propietarioCriador'));                  
    }

    public function guarda(Request $request)
    {
        // dd($request->all());
        // dd($request->filled('criadero_id'));


        if ($request->filled('criadero_id')) {
            $criadero                   = Criadero::find($request->input('criadero_id'));
            $criadero->modificador_id   = Auth::user()->id;
        } else {
            $criadero           = new Criadero();
            $criadero->user_id  = Auth::user()->id;
        }

        if($request->filled('copropietario_id')){
            $criadero->copropietario_id = $request->input('copropietario_id');
        }

        $criadero->nombre              = $request->input('nombre');
        $criadero->registro_fci        = $request->input('registro_fci');
        $criadero->departamento        = $request->input('departamento');
        $criadero->fecha               = $request->input('fecha');
        $criadero->modalidad_ingreso   = $request->input('modalidad_ingreso');
        $criadero->direccion           = $request->input('direccion');
        $criadero->celulares           = $request->input('celulares');
        $criadero->pagina_web          = $request->input('pagina_web');
        $criadero->email               = $request->input('email');

        $criadero->save();

        if($request->filled('criadero_id')){
            if($request->filled('propietario_id')){
                $propietarioCriadero = PropietarioCriadero::where('criadero_id',$request->input('criadero_id'))
                                                        ->first();
                $propietarioCriadero->propietario_id = $request->input('propietario_id');
    
                $propietarioCriadero->save();
            }
        }else{
            if($request->filled('propietario_id')){
                $propietarioCriadero = new PropietarioCriadero();

                $propietarioCriadero->propietario_id    = Auth::user()->id;
                $propietarioCriadero->propietario_id    = $request->input('propietario_id');
                $propietarioCriadero->criadero_id       = $criadero->id;
    
                $propietarioCriadero->save();
            }
        }

        return redirect('Criadero/listado');
    }

    public function elimina(Request $request)
    {
        // dd($request->id);
        $eli = PropietarioCriadero::find($request->id);

        Criadero::destroy($eli->criadero_id);

        PropietarioCriadero::destroy($request->id);

        return redirect('Criadero/listado');
    }

    public function edita(Request $request, $id)
    {
        $datosUsuario = Criadero::findOrFail($id);
        $categorias = Criadero::all();
        return view('user.edita')->with(compact('datosUsuario', 'categorias'));
    }

    public function validaEmail(Request $request)
    {
        // dd($request->all());
        $verificaEmail = Criadero::where('email', $request->email)
            ->count();

        return response()->json(['vEmail' => $verificaEmail]);
    }


    //buscado ajax

    public function ajaxListadoCriadero(Request $request)
    {
        $criaderos = PropietarioCriadero::query()
                    ->join('criaderos', 'criaderos.id', "propietarios_criaderos.criadero_id");

        //buscamos por nombr de criador
        if($request->filled('nombre_buscar')){
            $nombre = $request->input('nombre_buscar');
            $criaderos->where('criaderos.nombre', 'like', "%$nombre%");
        }

        //buscamos por criador
        if($request->filled('criador_buscar')){
            $criaderos->select('*','propietarios_criaderos.id as idProCria');
            $criador = $request->input('criador_buscar');
            $criaderos->join('users', 'users.id', "propietarios_criaderos.propietario_id")
                      ->where('propietarios_criaderos.propietario_id', '=', "$criador");
        }

        // buscamos por departamento
        if($request->filled('departamento_buscar')){
            $departamento = $request->input('departamento_buscar');
            $criaderos->where('criaderos.departamento', '=', "$departamento");
        }

        // // pregunto si los campos estan vacios

        $criaderos->orderBy('criaderos.id', 'desc');

        if($request->filled('nombre_buscar') || $request->filled('criador_buscar') || $request->filled('departamento_buscar')){
            $criaderos->limit(20);
        }else{
            $criaderos->limit(100);
        }


            
        $datosCriaderos = $criaderos 
                            // ->toSql();
                    //    dd($datosCriaderos);     
                            ->get();

        return view('criaderos.ajaxListadoCriadero')->with(compact('datosCriaderos'));
    }

    public function ajaxBuscaCriadero(Request $request)
    {
        $nombre = $request->input('search');
        $propietarios = Criadero::where('nombre', 'like', "%$nombre%")
                            ->limit(15)
                            ->get();

        $response = array();
        foreach($propietarios as $p){
            $response[] = array(
                'id'=>$p->id,
                'text'=>$p->nombre." ($p->registro_fci)",
            );
        }

        return response()->json($response);
    }

    public function ajaxBuscaCriaderoPropietario(Request $request){

        $queryCriaderos = Criadero::query();

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $queryCriaderos->where('nombre','like', "%$nombre%");
        }

        $queryCriaderos->limit(8);

        $criaderos = $queryCriaderos->get();
        // dd($criaderos);

        return view('criaderos.ajaxBuscaCriaderoPropietario')->with(compact('criaderos'));

        // dd("en desarrollo :v");
    }

    public function guardaCriaderoPropietario(Request $request){
        // dd($request->all());

        $propietarioCriadero = new PropietarioCriadero();

        $propietarioCriadero->user_id               = Auth::user()->id;
        $propietarioCriadero->propietario_id        = $request->input('propietario_id');
        $propietarioCriadero->criadero_id           = $request->input('criadero_id');

        $propietarioCriadero->save();

        return redirect('User/listadoCriadero/'.$request->input('propietario_id'));
    }

    public function guardaCriaderoNuevoPropietario(Request $request){
        // dd($request->all());
        $criadero = new Criadero();

        $criadero->user_id                      = Auth::user()->id;
        if($request->filled('copropietario_id')){
            $criadero->copropietario_id         = $request->input('copropietario_id');
        }
        $criadero->nombre                       = $request->input('nombre');
        $criadero->registro_fci                 = $request->input('registro_fci');
        $criadero->departamento                 = $request->input('departamento');
        $criadero->fecha                        = $request->input('fecha');
        $criadero->modalidad_ingreso            = $request->input('modalidad_ingreso');
        $criadero->direccion                    = $request->input('direccion');
        $criadero->celulares                    = $request->input('celulares');
        $criadero->pagina_web                   = $request->input('pagina_web');
        $criadero->email                        = $request->input('email');

        $criadero->save();

        // procedemos al guiardado deol id del criadero con el id del propietariuo

        $propietarioCriadero = new PropietarioCriadero();

        $propietarioCriadero->user_id                       = Auth::user()->id;
        $propietarioCriadero->propietario_id                = $request->input('propietario_id');
        $propietarioCriadero->criadero_id                   = $criadero->id;

        $propietarioCriadero->save();

        return redirect('User/listadoCriadero/'.$request->input('propietario_id'));
    }
}
