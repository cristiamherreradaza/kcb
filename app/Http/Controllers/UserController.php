<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Pago;
use App\User;
use App\Perfil;
use App\Sector;
use DataTables;
use App\Criadero;
use App\Sucursal;
use App\Categoria;
use App\MenuUsers;
use App\MenuPerfil;
use App\PropietarioCriadero;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
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
        $usuarios = User::where('perfil_id', '<>', 4)
                        ->get();
        $sucursales = Sucursal::all();
        $perfiles = Perfil::all();
        

        return view('user.listado')->with(compact('usuarios', 'sucursales', 'perfiles'));
    }
    
    public function formulario(Request $request, $id)
    {
        if ($id != 0) {
            $user = User::find($id);
        }else{
            $user = null;
        }

        $sucursales = Sucursal::all();
        $perfiles = Perfil::where('id','<>',4)
                            ->get();

        return view('user.formulario')->with(compact('sucursales', 'perfiles', 'user'));                  
    }

    public function guarda(Request $request)
    {

        if($request->filled('user_id')){
            $sw = false;
            $persona = User::find($request->input('user_id'));
        }else{
            $sw = true;
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

        // esto es para la firma digital de los secretarios
        if($request->file('firma_digital')){
            
            // subiendo el archivo al servidor
            $archivo    = $request->file('firma_digital');

            $direcion   = "imagenesFirmaJuezSecre/";
            $nombreArchivo = date('YmdHis').".".$archivo->getClientOriginalExtension();
            $archivo->move($direcion,$nombreArchivo);

            $persona->estado    = $nombreArchivo;

        }
        
        $persona->save();

        if($sw){
            $user_id = $persona->id;
    
            $menus = MenuPerfil::where('perfil_id',$persona->perfil_id)->get();
    
            foreach($menus as $m){
                $menuUser = new MenuUsers();
    
                $menuUser->user_id      = $user_id;
                $menuUser->menu_id      = $m->menu_id;
                $menuUser->estado       = $m->estado;
    
                $menuUser->save();
            }     
        }
            
        return redirect('User/listado');
    }

    public function elimina(Request $request)
    {
        // ELIMINAMOS EL USUARIO
        User::destroy($request->id);

        // ELIMINAMOS SUS PERFILES
        $menus = MenuUsers::where('user_id',$request->id)->get();

        foreach($menus as $m){

            MenuUsers::destroy($m->id);

        }

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

    public function ajaxBuscaPropietario(Request $request)
    {
        $nombre = $request->input('search');
        $propietarios = User::where('name', 'like', "%$nombre%")
                            ->limit(15)
                            ->get();

        $response = array();
        foreach($propietarios as $p){
            $response[] = array(
                'id'=>$p->id,
                'text'=>$p->name." ($p->ci)",
            );
        }

        return response()->json($response);
    }


    // -----  PROPIETARIOS  ------

    public function formularioPropietario(Request $request, $id)
    {
        if ($id != 0) {
            $user = User::find($id);
        }else{
            $user = null;
        }

        $sucursales = Sucursal::all();

        return view('propietarios.formulario')->with(compact('sucursales', 'user'));                  
    }

    public function guardaPropietario(Request $request)
    {

        if($request->filled('user_id')){
            $persona = User::find($request->input('user_id'));
        }else{
            $persona = new User();
            $persona->password     = Hash::make($request->input('ci'));
        }

        $persona->user_id          = Auth::user()->id;
        $persona->name             = $request->input('name');
        $persona->email            = $request->input('email');
        $persona->perfil_id        = "4";
        $persona->departamento     = $request->input('departamento');
        $persona->direccion        = $request->input('direccion');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->ci               = $request->input('ci');
        $persona->genero           = $request->input('genero');
        $persona->celulares        = $request->input('celulares');
        $persona->tipo             = $request->input('socio');
        
        $persona->save();
            
        return redirect('User/listadoPropietario');
    }

    public function listadoPropietario()
    {

        $sucursales = Sucursal::all();
        $perfiles = Perfil::all();

        return view('propietarios.listado')->with(compact('sucursales', 'perfiles'));
    }

    public function eliminaPropietario(Request $request)
    {
        User::destroy($request->id);
        return redirect('User/listadoPropietario');

    }
    // listamos los criaderos de un respectivo Usuario
    public function listadoCriadero(Request $request, $propietario_id)
    {
        $criaderos = PropietarioCriadero::where('propietario_id', $propietario_id)
                                        ->get();

        $propietario = User::find($propietario_id);

        return view('user.listadoCriadero')->with(compact('criaderos', 'propietario'/*, 'sucursales', 'perfiles'*/));
    }

    public function ajaxListadoPropietarios(Request $request)
    {

        $propietarios = User::orderBy('id', 'desc');
        
        if($request->filled('nombre_buscar')){
            $nombre = $request->input('nombre_buscar');
            $propietarios->where('name', 'like', "%$nombre%");
        }

        if($request->filled('cedula_buscar')){
            $cedula = $request->input('cedula_buscar');
            $propietarios->where('name', 'like', "%$cedula%");
        }

        // pregunto si los campos estan vacios
        if($request->filled('nombre_buscar') || $request->filled('cedula_buscar')){
            $propietarios->limit(20);
        }else{
            $propietarios->limit(100);
        }

        $propietarios->where('perfil_id', 4);

        $datosPropietarios = $propietarios->get();

        return view('user.ajaxListadoPropietarios')->with(compact('datosPropietarios'));
    }

    public function ajaxBuscaPropietarioTransferencia(Request $request){
        // dd($request->all());
        $queryPropietarios = User::query();


        if($request->filled('cedula')){
            $cedula = $request->input('cedula');
            $queryPropietarios->where('ci', 'like', "%$cedula%");
        }

        if($request->filled('nombre')){
            $nombre = $request->input('nombre');
            $queryPropietarios->where('name', 'like', "%$nombre%");
        }

        $queryPropietarios->limit(8);

        $propietarios = $queryPropietarios->get();

        return view('user.ajaxBuscaPropietario')->with(compact('propietarios'));
    }

    function ajaxGuardaNuevoPropietario(request $request){

        $persona = new User();

        $persona->user_id          = Auth::user()->id;
        $persona->name             = $request->input('nombre');
        $persona->email            = $request->input('email');
        $persona->perfil_id        = "4";
        $persona->departamento     = $request->input('departamento');
        $persona->direccion        = $request->input('direccion');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->ci               = $request->input('cedula');
        $persona->genero           = $request->input('genero');
        $persona->celulares        = $request->input('celular');
        $persona->tipo             = $request->input('tipo');
        $persona->password         = Hash::make($request->input('cedula'));

        
        $persona->save();
        
        $ultimaPersona = User::find($persona->id);

        return view('user.ajaxNuevoPropietario')->with(compact('ultimaPersona'));
        // return redirect('User/listadoPropietario');
    }

    public function validaCedula(Request $request)
    {
        // dd($request->all());
        $verificaCedula = User::where('CI', $request->cedula)
                            ->count();

        return response()->json(['vCedula'=>$verificaCedula]);
    }

    public function ajaxPermisos(Request $request){
        // dd("en desarrollo :v");
        $menus =  MenuUsers::where('user_id',$request->input('user_id'))->get();

        return view('user.ajaxPermisos')->with(compact('menus'));

    }

    public function guardaPermiso(Request $request){
        // dd($request->input('user'));s
        $menuUsers = MenuUsers::find($request->input('user'));
        $menusEstado       = Menu::find($menuUsers->menu_id);

        if($menusEstado->direccion == '#'){
            $hijos = Menu::where('padre',$menusEstado->id)
                                ->get();

            foreach ($hijos as $h){
                $menusUsuario = MenuUsers::where('user_id',$menuUsers->user_id)
                                        ->where('menu_id',$h->id)
                                        ->first();
                if($request->input('valor') == 'true'){
                    $menusUsuario->estado = 'Visible';
                }else{
                    $menusUsuario->estado = 'Oculto';
                }

                $menusUsuario->save();
            }

            if($request->input('valor') == 'true'){
                $menuUsers->estado = 'Visible';
            }else{
                $menuUsers->estado = 'Oculto';
            }

            $menuUsers->save();

        }else{

            if($request->input('valor') == 'true'){
                $menuUsers->estado = 'Visible';
                $menuPadre = Menu::find($menuUsers->menu_id);
                $menusUsuarioChek = MenuUsers::where('user_id', $menuUsers->user_id)
                                            ->where('menu_id',$menuPadre->padre)
                                            ->first();
                if($menusUsuarioChek->estado != 'Visible'){
                    $menusUsuarioChek->estado = 'Visible';

                    $menusUsuarioChek->save();
                }
            }else{
                $menuUsers->estado = 'Oculto';
            }

            $menuUsers->save();
        }

        $menus =  MenuUsers::where('user_id',$menuUsers->user_id)->get();

        return view('user.ajaxPermisos')->with(compact('menus'));
    }

    public function listaPermisos(Request $request){
        $perfiles = Perfil::all();

        return view('user.listaPermisos')->with(compact('perfiles'));
        
    }

    public function ajaxBuscaPermisos(Request $request){
        
        $permisos = MenuPerfil::where('perfil_id',$request->input('perfil_id'))->get();

        return view('user.ajaxBuscaPerfil')->with(compact('permisos'));
    }
    
    public function cambiaEstadoMenuPerfil(Request $request){

        $menuPerfil = MenuPerfil::find($request->input('menu_id'));

        if($menuPerfil->estado == 'Visible'){
            $menuPerfil->estado = 'Oculto' ;
        }else{
            $menuPerfil->estado = 'Visible' ;
        }

        $menuPerfil->save();

        $permisos = MenuPerfil::where('perfil_id',$request->input('perfil_id'))->get();

        return view('user.ajaxBuscaPerfil')->with(compact('permisos'));
        // return redirect('User/listaPermisos');
    }

    public function ajaxPermisosPerfil(Request $request){
        $menusPerfiles =  MenuPerfil::where('perfil_id',$request->input('user_id'))->get();

        return view('user.ajaxPermisosPerfiles')->with(compact('menusPerfiles'));
    }

    public function guardaPermisoPerfil(Request $request){

        // dd($request->input('valor')." < ----- > ".$request->input('user'));
        $menuUsers = MenuPerfil::find($request->input('user'));
        // dd($menuUsers);
        $menusEstado       = Menu::find($menuUsers->menu_id);
        // dd($menusEstado);

        if($menusEstado->direccion == '#'){
            $hijos = Menu::where('padre',$menusEstado->id)
                                ->get();
            // dd($hijos);

            foreach ($hijos as $h){
                $menusUsuario = MenuPerfil::where('perfil_id',$menuUsers->perfil_id)
                                        ->where('menu_id',$h->id)
                                        ->first();
                // dd($menusUsuario);
                if($request->input('valor') == 'true'){
                    $menusUsuario->estado = 'Visible';
                }else{
                    $menusUsuario->estado = 'Oculto';
                }

                $menusUsuario->save();
            }

            if($request->input('valor') == 'true'){
                $menuUsers->estado = 'Visible';
            }else{
                $menuUsers->estado = 'Oculto';
            }

            $menuUsers->save();

        }else{

            if($request->input('valor') == 'true'){
                $menuUsers->estado = 'Visible';
                $menuPadre = Menu::find($menuUsers->menu_id);
                $menusUsuarioChek = MenuPerfil::where('perfil_id', $menuUsers->perfil_id)
                                            ->where('menu_id',$menuPadre->padre)
                                            ->first();
                if($menusUsuarioChek->estado != 'Visible'){
                    $menusUsuarioChek->estado = 'Visible';

                    $menusUsuarioChek->save();
                }
            }else{
                $menuUsers->estado = 'Oculto';
            }

            $menuUsers->save();
        }

        $menusPerfiles =  MenuPerfil::where('perfil_id',$menuUsers->perfil_id)->get();

        return view('user.ajaxPermisosPerfiles')->with(compact('menusPerfiles'));
    }
}
