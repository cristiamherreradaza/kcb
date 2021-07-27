<?php

namespace App\Http\Controllers;

use App\User;
use App\Pago;
use App\Sector;
use DataTables;
use App\Categoria;
use Illuminate\Http\Request;
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

        return view('user.listado')->with(compact('usuarios'));
    }

    public function ajax_listado()
    {
        // $usuarios = User::all();
        // return Datatables::of($usuarios)
        //         ->addColumn('action', function($usuarios){
        //             if($usuarios->id != 1){
        //                 return '<a href="#" class="btn btn-icon btn-warning btn-sm mr-2" onclick="edita('.$usuarios->id.')">
        //                             <i class="fas fa-edit"></i>
        //                         </a>
        //                         <a href="#" class="btn btn-icon btn-success btn-sm mr-2" onclick="cuotas('.$usuarios->id.')">
        //                             <i class="fas fa-list-alt"></i>
        //                         </a>
        //                         <a href="#" class="btn btn-icon btn-danger btn-sm mr-2" onclick="elimina('.$usuarios->id.', \''.$usuarios->name.'\')">
        //                             <i class="flaticon2-delete"></i>
        //                         </a>';
        //             }
        //         })->make(true);
    }

    public function nuevo()
    {
        // $categorias = Categoria::all();
        // return view('user.nuevo')->with(compact('categorias'));        			
        return view('user.nuevo');                  
    }

    public function ajaxDistrito(Request $request)
    {
        $distritos = Sector::where('departamento', $request->departamento)
                        ->whereNull('padre_id')
                        ->get();
        
        return view('user.ajaxDistritos')->with(compact('distritos'));                   
    }

    public function ajaxOtb(Request $request)
    {
        $otbs = Sector::where('padre_id', $request->distrito)
                        ->get();

        return view('user.ajaxOtb')->with(compact('otbs'));                   
    }

    public function guarda(Request $request)
    {
        // dd($request->all());

        if($request->has('user_id')){
            $persona = User::find($request->id);
        }else{
            $persona = new User();
        }

        $persona->name             = $request->nombre;
        $persona->email            = $request->correo;
        if($request->has('contrasenia')){
            $persona->password         = Hash::make($request->contrasenia);
        }
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->ci               = $request->cedula;
        $persona->direccion        = $request->direccion;
        $persona->celulares        = $request->celulares;
        $persona->save();
        $personaId = $persona->id;
            
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

    public function pagos(Request $request, $user_id)
    {
        $pagos = Pago::where('user_id', $user_id)
                    ->get();

        $datosUsuario = User::find($user_id);

        return view('user.pagos')->with(compact('pagos', 'datosUsuario'));                 
    }

    public function cambiaPago(Request $request, $id, $estado)
    {
        $datosPago = Pago::find($id);

        if($estado == 'Pagar'){
            $pago = Pago::where('id', $id)
                        ->update(['estado'=>'Pagado']);
        }else{
            $pago = Pago::where('id', $id)
                        ->update(['estado'=>'Debe']);
        }

        $pagos = Pago::where('user_id', $datosPago->user_id)
                    ->get();

        $datosUsuario = User::find($datosPago->user_id);

        return view('user.pagos')->with(compact('pagos', 'datosUsuario'));                 

    }
}
