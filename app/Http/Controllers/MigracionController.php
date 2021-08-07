<?php

namespace App\Http\Controllers;

use App\Raza;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MigracionController extends Controller
{
    function razas()
    {
        $razasAnterior = DB::table('arazas')->get();

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
    public static function verifica($correo){
        $sw = false;
        $haber = User::where('email',$correo);
        dd($haber);
        return $sw;
    }
}
