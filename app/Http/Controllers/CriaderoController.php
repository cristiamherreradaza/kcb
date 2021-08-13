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
        // dd($id);
        if ($id != 0) {
            $criadero = Criadero::find($id);
        } else {
            $criadero = null;
        }

        $user = User::all();

        return view('criaderos.formulario')->with(compact('criadero', 'user'));
        // return view('criaderos.formulario')->with(compact('criadero'));                  
    }

    public function guarda(Request $request)
    {
        if ($request->filled('criadero_id')) {
            $criadero = Criadero::find($request->input('criadero_id'));
        } else {
            $criadero = new Criadero();
        }

        $criadero->user_id = Auth::user()->id;

        if($request->filled('propietario_id')){
            $criadero->propietario_id = $request->input('propietario_id');
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
        $criadero->observacion         = $request->input('observacion');

        $criadero->save();

        return redirect('Criadero/listado');
    }

    public function elimina(Request $request)
    {
        Criadero::destroy($request->id);
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
        if($request->filled('nombre_buscar') || $request->filled('criador_buscar') || $request->filled('departamento_buscar')){
            $criaderos->limit(20);
        }else{
            $criaderos->limit(100);
        }

        $datosCriaderos = $criaderos->get();

        return view('criaderos.ajaxListadoCriadero')->with(compact('datosCriaderos'));
    }
}
