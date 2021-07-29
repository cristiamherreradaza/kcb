<?php

namespace App\Http\Controllers;

use App\Pago;
use App\User;
use App\Perfil;
use App\Sector;
use DataTables;
use App\Sucursal;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listado()
    {
        $usuarios = User::all();
        $sucursales = Sucursal::all();
        $perfiles = Perfil::all();

        return view('user.listado')->with(compact('usuarios', 'sucursales', 'perfiles'));
    }

    public function listadoPropietarios()
    {
        $usuarios = User::where('perfil_id', 3)
                        ->get();

        $sucursales = Sucursal::all();
        $perfiles = Perfil::all();

        return view('user.listadoPropietarios')->with(compact('usuarios', 'sucursales', 'perfiles'));
    }

    public function formulario(Request $request, $id)
    {
        if ($id != 0) {
            $user = User::find($id);
        }else{
            $user = null;
        }

        $sucursales = Sucursal::all();
        $perfiles = Perfil::all();

        return view('user.formulario')->with(compact('sucursales', 'perfiles', 'user'));                  
    }

    public function guarda(Request $request)
    {

        if($request->filled('user_id')){
            $persona = User::find($request->input('user_id'));
        }else{
            $persona = new User();
        }

        $persona->user_id = Auth::user()->id;
        $persona->name    = $request->input('name');
        $persona->email   = $request->input('email');
        if($request->filled('password')){
            $persona->password = Hash::make($request->input('password'));
        }
        $persona->perfil_id        = $request->input('perfil_id');
        $persona->sucursal_id      = $request->input('sucursal_id');
        $persona->direccion        = $request->input('direccion');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->ci               = $request->input('ci');
        $persona->genero           = $request->input('genero');
        $persona->celulares        = $request->input('celulares');
        $persona->socio            = $request->input('socio');
        
        $persona->save();
            
        return redirect('User/listado');
    }

    public function elimina(Request $request)
    {
        User::destroy($request->id);
        return redirect('User/listado');

    }

    public function edita(Request $request, $id)
    {
        $datosUsuario = User::findOrFail($id);
        $categorias = Categoria::all();
        return view('user.edita')->with(compact('datosUsuario', 'categorias'));                   
    }

    public function validaEmail(Request $request)
    {
        // dd($request->all());
        $verificaEmail = User::where('email', $request->email)
                            ->count();

        return response()->json(['vEmail'=>$verificaEmail]);

    }
}
