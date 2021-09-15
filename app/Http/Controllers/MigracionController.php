<?php

namespace App\Http\Controllers;

use App\Raza;
use App\User;
use App\Grupo;
use App\Camada;
use App\Examen;
use App\Titulo;
use App\Criadero;
use App\Ejemplar;
use App\GrupoRaza;
use App\ExamenMascota;
use App\Transferencia;
use App\TituloEjemplar;
use App\PropietarioCriadero;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                            // ->limit(2000)
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
        $examenes_mascotas = DB::table('aexamenes_mascotas')->get();
        
        foreach ($examenes_mascotas as $em) {
            echo 'id-'.$em->id."<br>";

            $examenMascota = new ExamenMascota();

            $examenMascota->codigo_anterior       = $em->id;
            $examenMascota->user_id               = 1;
            $ejemplar                             = DB::table('ejemplares')->where('codigo_anterior',$em->mascota_id)->first();
            if($ejemplar){
                $examenMascota->ejemplar_id       = $ejemplar->id;
            }else{
                $examenMascota->ejemplar_id       = null;
            }
            $examen                               = DB::table('examenes')->where('codigo_anterior',$em->examene_id)->first();
            if($examen){
                $examenMascota->examen_id         = $examen->id;
            }else{
                $examenMascota->examen_id         = null;
            }
            $examenMascota->aptocriaseleccion_uno = $em->aptocriaseleccion_uno;
            $examenMascota->aptocriaseleccion_dos = $em->aptocriaseleccion_dos;
            if($em->fecha_examen != "0000-00-00"){
                $examenMascota->fecha_examen      = $em->fecha_examen;
            }else{
                $examenMascota->fecha_examen      = now();
            }
            $examenMascota->dcf                   = $em->dcf;
            $examenMascota->resultado             = $em->resultado;
            $examenMascota->observacion           = $em->observacion;
            $examenMascota->numero_formulario     = $em->numero_formulario;
            $examenMascota->revisor               = $em->revisor;

            $examenMascota->save();
        }
        
    }

    // MIGRACION DE CAMADAS
    public function camadas(){
        $camadas = DB::table('acamada')->get();

        foreach ($camadas as $c) {

            echo "ID => ".$c->id." REGISTRO PADRE => ".$c->numregistropadre. " REGISTRO MADRE => ".$c->numregistromadre."<br>";

            $camada = new Camada();

            $camada->codigo_anterior       = $c->id;
            $camada->user_id               = 1;
            $padre                         = DB::table('ejemplares')->where('codigo_anterior',intval($c->numregistropadre))->first();           
            if($padre){
                $camada->padre_id          = $padre->id;
            }else{
                $camada->padre_id          = null;
            }
            $madre                         = DB::table('ejemplares')->where('codigo_anterior',intval($c->numregistromadre))->first();           
            if($madre){
                $camada->madre_id          = $madre->id;
            }else{
                $camada->madre_id          = null;
            }
            $criadero                      = DB::table('criaderos')->where('codigo_anterior',$c->criadero_id)->first();
            if($criadero){
                $camada->criadero_id       = $criadero->id;
            }else{
                $camada->criadero_id       = null;
            }
            $sucursal                      = DB::table('sucursales')->where('id',$c->sucursale_id)->first();
            if($sucursal){
                $camada->sucursal_id       = $sucursal->id;
            }else{
                $camada->sucursal_id       = null;
            }
            $raza                          = DB::table('razas')->where('codigo_anterior',$c->raza_id)->first();
            if($raza){
                $camada->raza_id           = $raza->id;
            }else{
                $camada->raza_id           = null;
            }
            $tipo_pelo                     = $c->tipospelo_id;
            switch ($tipo_pelo) {
                case 1:
                    $camada->tipo_pelo     = "Duro";
                    break;
                case 2:
                    $camada->tipo_pelo     = "Liso";
                    break;
                case 3:
                    $camada->tipo_pelo     = "Corto";
                    break;
                case 4:
                    $camada->tipo_pelo     = "Largo";
                    break;
                default:
                    $camada->tipo_pelo     = null;
                break;
            }
            $camada->variedad              = $c->variedad;  
            $camada->fecha_nacimiento      = $c->fecha_nacimiento;
            $camada->camada                = $c->camada;
            $camada->lechigada             = $c->lechigada;
            $camada->num_parto_madre       = $c->numpartomadre;
            $camada->cachorros_encontrados = $c->cachorrosencontrados;
            $camada->visado                = $c->visado;
            $camada->lugar                 = $c->lugar;
            switch ($c->departamento_id) {
                case 1:
                    $departamento          = "La Paz";
                    break;
                case 2:
                    $departamento          = "Cochabamba";
                    break;
                case 3:                    
                    $departamento          = "Santa Cruz";
                    break;
                case 4:
                    $departamento          = "Oruro";
                    break;
                case 5:
                    $departamento          = "Potosi";
                break;
                case 6:
                    $departamento          = "Tarija";
                    break;
                case 7:
                    $departamento          = "Beni";
                    break;
                case 8:
                    $departamento          = "Pando";
                    break;
                case 9:
                    $departamento          = "Sucre";
                    break;
                default:
                    $departamento          = null;
                    break;
            }
            $camada->departamento          = $departamento;
            $camada->fecha_registro        = $c->fecha;

            $camada->save();
        }

        echo "<h1 class='text-success'>SUCCESSFUL</h1>";

    }

    // MIGRACION DE PADRES MADRES
    public function padres_madres(){
        $mascotas = DB::table('amascotas')
                            // ->orderBy('id', 'desc')
                            // ->limit(2000)
                            ->get();
        // $mascotas = DB::table('amascotas')->where('id',42218)->first();
        // dd($mascotas);

        // $mascota = Ejemplar::where('codigo_anterior',$mascotas->id)->first();
        // dd($mascota);

        // $padre = DB::table('ejemplares')->where('codigo_anterior',$mascotas->reproductor_id)->first();
        // dd($padre);

        // dd($mascotas);

        foreach ($mascotas as $m) {
            echo  "ID => ".$m->id." Nombre => ".$m->nombre."<br>";

            $mascota = Ejemplar::where('codigo_anterior',$m->id)->first();
            // dd($mascota);

            $padre = DB::table('ejemplares')->where('codigo_anterior',$m->reproductor_id)->first();
            if($padre){
                $mascota->padre_id = $padre->id;
            }else{
                $mascota->padre_id = null;
            }
            $madre = DB::table('ejemplares')->where('codigo_anterior',$m->reproductora_id)->first();
            if($madre){
                $mascota->madre_id = $madre->id;
            }else{
                $mascota->madre_id = null;
            }
            $camada = DB::table('camadas')->where('codigo_anterior',$m->camada_id)->first();
            if($camada){
                $mascota->camada_id = $camada->id;
            }else{
                $mascota->camada_id = null;
            }
            $criadero = DB::table('criaderos')->where('codigo_anterior',$m->criadero_id)->first();
            if($criadero){
                $mascota->criadero_id = $criadero->id;
            }else{
                $mascota->criadero_id = null;
            }
            $propietario = DB::table('criaderos')->where('codigo_anterior',$m->criadero_id)->first();
            if($propietario){
                $mascota->criadero_id = $criadero->id;
            }else{
                $mascota->criadero_id = null;
            }
            // dd($mascota);
            $mascota->save();
        }

        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
        
    }

    // MIGRACION DE TRAMSFERENCIA
    public function tramsferencia(){

        $tramsferencias = DB::table('amascotas_propietarios')
                            // ->where('id',15673)
                            ->get();
        $contador = 1;
        $contadorRegistros = 0;
        $contadorNoPropietarios = 0;
        $contadorNoMascotas = 0;
        $contadorPropietariosError = 0;
        $contadorMascotasError = 0;

        foreach ($tramsferencias as $tra) {
            echo "id=> ".$tra->id." Contador de Ciclos =>".$contador." Contador de Registros =>".$contadorRegistros." Contador No existentes propietarios => ".$contadorNoPropietarios." Contador No existentes Mascotas => ".$contadorNoMascotas." Contador Error propietarios => ".$contadorPropietariosError." Contador Error mascotas => ".$contadorMascotasError."<br><br>";
            $sw = true;

            $transferencia = new Transferencia();
            
            $transferencia->codigo_anterior = $tra->id;
            $transferencia->user_id         = 1;
            if($tra->propietario_id == 0 || $tra->propietario_id > 7000){
                $sw = false;
                $contadorPropietariosError++;
            }else{
                $propietario = User::where('codigo_anterior', $tra->propietario_id)->first();
                if($propietario){
                    $transferencia->propietario_id = $propietario->id;
                }else{
                    $sw = false;
                    $contadorNoPropietarios++;
                }
            }
            if($tra->mascota_id == 0 || $tra->mascota_id > 50000){
                $contadorMascotasError++;
                $sw = false;
            }else{
                $mascota = Ejemplar::where('codigo_anterior', $tra->mascota_id)->first();
                if($mascota){
                    $transferencia->ejemplar_id = $mascota->id;
                }else{
                    $contadorNoMascotas++;
                    $sw = false;
                }
            }
            if($tra->fecha_transfer == '0000-00-00' || $tra->fecha_transfer == '0202-00-22'){
                $transferencia->fecha_transferencia = now();
            }else{
                $transferencia->fecha_transferencia = $tra->fecha_transfer;
            }
            if($tra->estado == 1){
                $transferencia->estado  = "Actual";
            }else{
                $transferencia->estado  = "Anterior";
            }
            if($tra->pedigree_exportacion == 1){
                $transferencia->pedigree_exportacion = "Si";
            }else{
                $transferencia->pedigree_exportacion = "No";
            }
            if($tra->fecha_exportacion == '0000-00-00'){
                $transferencia->fecha_exportacion = now();
            }else{
                $transferencia->fecha_exportacion = $tra->fecha_exportacion;
            }
            $transferencia->pais_destino    = $tra->pais_destino;
            if($sw){
                $transferencia->save();
                $contadorRegistros++;
            }

            $contador++;
        }

        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }

    // MIGRACIUON DE MASCOTAS TITULOS
    public function mascotas_titulos(){
        $titulos_mascotas = DB::table('amascotas_titulos')->get();

        foreach ($titulos_mascotas as $ti) {
            echo "ID => ".$ti->id."<br>";

            $tituloEjemplar = new TituloEjemplar();
            $tituloEjemplar->codigo_anterior        = $ti->id;
            $tituloEjemplar->user_id                = 1;
            $titulo = Titulo::where('codigo_anterior', $ti->titulo_id)->first();
            if($titulo){
                $tituloEjemplar->titulo_id          = $titulo->id;
            }else{
                $tituloEjemplar->titulo_id          = null;
            }
            $mascota = Ejemplar::where('codigo_anterior', $ti->mascota_id)->first();
            if($mascota){
                $tituloEjemplar->ejemplar_id        = $mascota->id;
            }else{
                $tituloEjemplar->ejemplar_id        = null;
            }
            if($ti->fecha_obtencion == '0000-00-00'){
                $tituloEjemplar->fecha_obtencion    = now();
            }else{
                $tituloEjemplar->fecha_obtencion    = $ti->fecha_obtencion;
            }

            $tituloEjemplar->save();
        }

        echo "<h1 class='text-success'>SUCCESSFUL</h1>";
    }
}
