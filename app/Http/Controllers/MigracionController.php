<?php

namespace App\Http\Controllers;

use App\Raza;
use App\User;
use App\Criadero;
use App\Ejemplar;
use App\Examen;
use App\Grupo;
use App\GrupoRaza;
use App\PropietarioCriadero;
use App\Titulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Foreach_;

class MigracionController extends Controller
{
    function razas()
    {
        $razasAnterior = DB::table('arazas')
                        ->get();

        foreach ($razasAnterior as $r) {
            echo 'id-'.$r->id." Nombre ".$r->nombre."<br />";

            $raza = new Raza();
            $raza->codigo_anterior = $r->id;
            $raza->user_id = 1;
            $raza->nombre = $r->nombre;
            $raza->descripcion = $r->descripcion;
            $raza->save();
        }

    }
    function propietarios(){
        $propietarios = DB::table('apropietarios')->get();
        $contador = 1;
        $cuantos = 1;
        foreach ($propietarios as $pro) {
            echo 'id-'.$pro->id." Nombre ".$pro->nombre.' email=>'.$pro->email1.' cuantos =>'.$cuantos;
            echo "Estado =>".$pro->estado."Genero => ".$pro->genero." <br> ";
            $user = new User();
            $user->codigo_anterior = $pro->id;
            $user->perfil_id = "4";
            $user->sucursal_id = $pro->sucursale_id;
            $user->user_id = 1;
            $user->name = $pro->nombre;
            $sw = 1;
            if(strlen($pro->email1) >= 5){
                $sw = 0;
            }
            if($sw == 0){
                $correoUser = DB::table('users')->where('email','=',$pro->email1)->count();
                if($correoUser == 0){
                    $user->email = $pro->email1;
                }else{
                    $user->email = $contador."@gmail.org.bo";
                    $contador = $contador + 1;    
                }
            }else{
                $user->email = $contador."@gmail.org.bo";
                $contador = $contador + 1;
            }
            if($pro->ci == null || $pro->ci == ""){
                $contrasenia = Hash::make("123456789");
            }else{
                $contrasenia = Hash::make($pro->ci);
            }
            $user->password = $contrasenia;
            if($pro->fecha_nacimiento == "0000-00-00"){
                $user->fecha_nacimiento = "2021-08-08";
            }else{
                $user->fecha_nacimiento = $pro->fecha_nacimiento;
            }
            $user->direccion = $pro->direccion;
            $user->celulares = $pro->telefono1." ".$pro->telefono2." ".$pro->celular;
            $user->genero = $pro->genero;
            if($pro->tipo_id == 1){
                $user->tipo = "Socio";
            }else{
                $user->tipo = "Criador";
            }
            $user->ci = $pro->ci;
            $user->departamento = $pro->ciudad_pais;
            $user->save();
            $cuantos = $cuantos + 1;
        }
        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }
    // private function verifica(){
    //     $sw = "hola joel";
    //     return $sw;
    // }
    public function criaderos(){
        $criaderosAnterior = DB::table('acriaderos')->get();
        foreach ($criaderosAnterior as $cri) {
            echo 'id-'.$cri->id." Nombre ".$cri->nombre."<br />";
            $criadero = new Criadero();
            $criadero->codigo_anterior = $cri->id;
            $criadero->user_id = 1;
            $copropietario = DB::table('users')->where('codigo_anterior','=',$cri->copropietario_id)->first();
            if($copropietario){
                $criadero->copropietario_id = $copropietario->id;
            }else{
                $criadero->copropietario_id = null;
            }
            $criadero->nombre = $cri->nombre;
            $criadero->registro_fci = $cri->registro_fci;
            switch ($cri->departamento_id) {
                case 1:
                    $departamento = "La Paz";
                    break;
                case 2:
                    $departamento = "Cochabamba";
                    break;
                case 3:                    
                    $departamento = "Santa Cruz";
                    break;
                case 4:
                    $departamento = "Oruro";
                    break;
                case 5:
                    $departamento = "Potosi";
                break;
                case 6:
                    $departamento = "Tarija";
                    break;
                case 7:
                    $departamento = "Beni";
                    break;
                case 8:
                    $departamento = "Pando";
                    break;
                default:
                    $departamento = "Sucre";
                    break;
            }
            $criadero->departamento = $departamento;
            $criadero->fecha = $cri->fecha_desde;
            $criadero->modalidad_ingreso = $cri->modalidad_ingreso;
            $criadero->direccion = $cri->direccion;
            $telefono = "";
            if($cri->telefono1 != 0){
                $telefono = $telefono ." ".$cri->telefono1;
            }
            if($cri->telefono2 != 0){
                $telefono = $telefono ." ".$cri->telefono2;
            }
            if($cri->celular1 != 0){
                $telefono = $telefono ." ".$cri->celular1;
            }

            if($cri->celular2 != 0){
                $telefono = $telefono ." ".$cri->celular2;
            }
            
            $criadero->celulares = $telefono;
            $criadero->pagina_web = $cri->paginaweb;
            $criadero->email = $cri->email1;
            $criadero->save();
        }
        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }
    // migraciones de propietarios criaderos
    function propietarioCriadero(){
        $criaderosAnterior = DB::table('acriaderos')->get();
        foreach ($criaderosAnterior as $cri) {
            echo 'id-'.$cri->id." Nombre ".$cri->nombre."<br />";
            $propietarioCriadero = new PropietarioCriadero();

            $acriadero = DB::table('criaderos')->where('codigo_anterior','=',$cri->id)->first();
            if($acriadero){
                $propietarioCriadero->criadero_id = $acriadero->id;
            }else{
                $propietarioCriadero->criadero_id = null;
            }
            $propietario = DB::table('users')->where('codigo_anterior','=',$cri->propietario_id)->first();
            if($propietario){
                $propietarioCriadero->propietario_id = $propietario->id;
            }else{
                $propietarioCriadero->propietario_id = null;
            }
            $propietarioCriadero->save();
        }
        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }

    // TODO - pasar funcion al controlador de migraciones
    public function mascotas()
    {
        $mascotas = DB::table('amascotas')
                            // ->orderBy('id', 'desc')
                            // ->limit(50)
                            ->get();
        // dd($razasAnterior);

        foreach ($mascotas as $key => $mascota) {

            echo $mascota->id . " - " . $mascota->nombre. "<br />";

            $ejemplar                   = new Ejemplar();
            $ejemplar->user_id          = 1;
            $ejemplar->kcb              = $mascota->kcb;
            $ejemplar->codigo_anterior  = $mascota->id;
            $ejemplar->num_tatuaje      = $mascota->num_tatuaje;

            if($mascota->fecha_nacimiento = '0000-00-00'){
                $fecha_nac = null;
            }else{
                $fecha_nac = $mascota->fecha_nacimiento;
            }

            $ejemplar->fecha_nacimiento = $fecha_nac;
            $ejemplar->chip             = $mascota->chip;
            $ejemplar->color            = $mascota->color;
            $ejemplar->senas            = $mascota->senas;
            $ejemplar->nombre           = $mascota->nombre;
            $ejemplar->nombre_completo  = $mascota->nombre_completo;

            if($mascota->orden == 0 || $mascota->orden == null){
                $mostrar = 'Nombre';
            }else{
                $mostrar = 'Afijo';
            }

            $ejemplar->primero_mostrar = $mostrar;
            $ejemplar->prefijo = $mascota->prefijo;
            
            $raza = Raza::where('codigo_anterior', $mascota->raza_id)->first();
            // dd($raza);
            if($raza){
                $raza_id = $raza->id;
            }else{
                $raza_id = null;
            }
            
            $ejemplar->raza_id              = $raza_id;
            $ejemplar->lechigada            = $mascota->lechigada;
            if ($mascota->sexo == 'macho') {
                $sexo = 'Macho';
            }else{
                $sexo = 'Hembra';
            }
            $ejemplar->sexo                 = $sexo;
            $ejemplar->origen               = $mascota->origen;
            $ejemplar->hermano              = $mascota->hermano;
            $ejemplar->codigo_nacionalizado = $mascota->codigo;
            $ejemplar->consanguinidad       = $mascota->consanguinidad;


            switch ($mascota->departamento_id) {
                case 1:
                    $departamento = "La Paz";
                    break;
                case 2:
                    $departamento = "Cochabamba";
                    break;
                case 3:                    
                    $departamento = "Santa Cruz";
                    break;
                case 4:
                    $departamento = "Oruro";
                    break;
                case 5:
                    $departamento = "Potosi";
                break;
                case 6:
                    $departamento = "Tarija";
                    break;
                case 7:
                    $departamento = "Beni";
                    break;
                case 8:
                    $departamento = "Pando";
                    break;
                case 9:
                    $departamento = "Sucre";
                    break;
                case null:
                    $departamento = "Extranjero";
                    break;
            }

            $propietario = User::where('codigo_anterior', $mascota->propietario_id)->first();

            if($propietario && $mascota->propietario_id != null){
                $propietario_id = $propietario->id;
            }else{
                $propietario_id = null;
            }

            $ejemplar->propietario_id = $propietario_id;
            $ejemplar->sucursal_id    = $mascota->sucursale_id;

            $ejemplar->save();
        }
    }

    // Migracion de GRUPOS
    public function grupos(){
        $grupos = DB::table('agrupos')->get();
        foreach ($grupos as $gru) {
            echo 'id-'.$gru->id." Nombre ".$gru->nombre."<br />";
            $grupo = new Grupo();
            $grupo->codigo_anterior = $gru->id;
            $grupo->user_id = 1;
            $grupo->nombre = $gru->nombre;
            $grupo->descripcion = $gru->descripcion;

            $grupo->save();
        }
        
        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }

    // Migracion de GRUPOS_RAZAS
    public function grupos_razas(){
        $grupos = DB::table('agrupos_razas')->get();
        foreach ($grupos as $gru) {
            echo 'id-'.$gru->id;

            $grupo = new GrupoRaza();

            $grupo->codigo_anterior = $gru->id;
            $grupo->user_id         = 1;
            $raza = DB::table('razas')->where('codigo_anterior','=',$gru->raza_id)->first();
            $grupo->raza_id         = $raza->id;
            $g = DB::table('grupos')->where('codigo_anterior','=',$gru->grupo_id)->first();
            $grupo->grupo_id        = $g->id;

            $grupo->save();
        }
        
        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }

    //MIGRACION DE TITULOS
    public function titulos(){

        $titulos = DB::table('atitulos')->get();
        foreach ($titulos as $ti) {
            echo 'id-'.$ti->id." nombre => ".$ti->nombre."<br>";
            
            $titulo = new Titulo();

            $titulo->codigo_anterior = $ti->id;
            $titulo->user_id         = 1;
            $titulo->nombre          = $ti->nombre;
            $titulo->descripcion     = $ti->descripcion;

            $titulo->save();
        }

        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }

    //MIGRACION DE TITULOS
    public function examenes(){

        $examenes = DB::table('aexamenes')->get();
        foreach ($examenes as $ex) {
            echo 'id-'.$ex->id." nombre => ".$ex->descripcion."<br>";
            
            $examen = new Examen();

            $examen->codigo_anterior = $ex->id;
            $examen->user_id         = 1;
            $examen->nombre          = $ex->descripcion;

            $examen->save();
        }

        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }

    //MIGRACION DE EXAMENES_MASCOTAS
    public function examenes_mascotas(){
        
    }

}
