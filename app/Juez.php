<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Svg\Tag\Rect;

class Juez extends Model
{
    use SoftDeletes;
    
    protected $table = 'jueces';
     
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'sucursal_id',
        'categoria_juez_id',
        'nombre',
        'email',
        'fecha_nacimiento',
        'direccion',
        'celulares',
        'ci',
        'departamento',
        'estado',
        'foto',
        'deleted_at',
    ];

    public function categoriaJuez(){

        return $this->belongsTo('App\CategoriaJuez', 'categoria_juez_id');

    }

    /*
    @return array ejemplares

    esta funcion te devuleve las categorias pero en conjunto tanto jovenes y jovenes campeones
    intermdias abiertas campeones grandes campeones en un solo blouqe

    ojo que ahora solo funciona con especiales
    */
    public static function ejemplaresCategoria($categoria, $evento_id, $grupo){

        if($categoria == "Especiales"){
            
            $ejemplares = EjemplarEvento::select('ejemplares_eventos.id as ejemplar_evento_id', 'ejemplares_eventos.ejemplar_id', 'ejemplares_eventos.numero_prefijo', 'ejemplares_eventos.raza_id', 'grupos_razas.grupo_id', 'ejemplares_eventos.categoria_pista_id as categoria_id')
                                        ->join('razas','ejemplares_eventos.raza_id','=','razas.id')
                                        ->join('grupos_razas','razas.id', '=', 'grupos_razas.raza_id')
                                        ->whereIn("grupos_razas.grupo_id",$grupo)
                                        // ->where("grupos_razas.grupo_id",$grupo)
                                        ->where("ejemplares_eventos.evento_id",$evento_id)
                                        ->where("ejemplares_eventos.categoria_pista_id",1)
                                        ->orderBy('ejemplares_eventos.raza_id')
                                        // ->toSql();
                                        ->get();
                                                
        }elseif($categoria == "Absolutos"){
            
            $ejemplares = EjemplarEvento::select('ejemplares_eventos.numero_prefijo', 'ejemplares_eventos.raza_id', 'grupos_razas.grupo_id', 'ejemplares_eventos.categoria_pista_id')
                                        ->join('razas','ejemplares_eventos.raza_id','=','razas.id')
                                        ->join('grupos_razas','razas.id', '=', 'grupos_razas.raza_id')
                                        ->where("grupos_razas.grupo_id",$grupo)
                                        ->where("ejemplares_eventos.evento_id",$evento_id)
                                        ->whereIn("ejemplares_eventos.categoria_pista_id",[11,2])
                                        ->orderBy('ejemplares_eventos.raza_id')
                                        // ->toSql();
                                        ->get();
                                                
        }elseif($categoria == "Jovenes"){
            
            $ejemplares = EjemplarEvento::select('ejemplares_eventos.numero_prefijo', 'ejemplares_eventos.raza_id', 'grupos_razas.grupo_id', 'ejemplares_eventos.categoria_pista_id')
                                        ->join('razas','ejemplares_eventos.raza_id','=','razas.id')
                                        ->join('grupos_razas','razas.id', '=', 'grupos_razas.raza_id')
                                        ->where("grupos_razas.grupo_id",$grupo)
                                        ->where("ejemplares_eventos.evento_id",$evento_id)
                                        ->whereIn("ejemplares_eventos.categoria_pista_id",[3,4,12,13])
                                        ->orderBy('ejemplares_eventos.raza_id')
                                        // ->toSql();
                                        ->get();
                                                
        }elseif($categoria == "Adultos"){
            
            $ejemplares = EjemplarEvento::select('ejemplares_eventos.numero_prefijo', 'ejemplares_eventos.raza_id', 'grupos_razas.grupo_id', 'ejemplares_eventos.categoria_pista_id')
                                        ->join('razas','ejemplares_eventos.raza_id','=','razas.id')
                                        ->join('grupos_razas','razas.id', '=', 'grupos_razas.raza_id')
                                        ->where("grupos_razas.grupo_id",$grupo)
                                        ->where("ejemplares_eventos.evento_id",$evento_id)
                                        ->whereIn("ejemplares_eventos.categoria_pista_id",[5,6,7,8,9,10,14,15,16,17,18,19,20])
                                        ->orderBy('ejemplares_eventos.raza_id')
                                        // ->toSql();
                                        ->get();
                                                
        }

        return $ejemplares;

    }

    public static function ejemplaresGrupos($evento_id, $grupo){

        $ejemplaseEvento = EjemplarEvento::select('ejemplares_eventos.raza_id')
                                        ->join('grupos_razas', 'ejemplares_eventos.raza_id', '=', 'grupos_razas.raza_id')
                                        ->where('ejemplares_eventos.evento_id',$evento_id)
                                        ->where('grupos_razas.grupo_id',$grupo)
                                        ->groupBy('ejemplares_eventos.raza_id')
                                        ->get();

        return $ejemplaseEvento;

    }

    public static function categoriaRaza($evento, $raza){

        $categoriasRazas = EjemplarEvento::select('categoria_pista_id')
                                        ->where('evento_id',$evento)
                                        ->where('raza_id',$raza)
                                        ->groupBy('categoria_pista_id')
                                        ->get();


        return $categoriasRazas;
    }

    // ESTA FUNCON DEVULVE LOS EJEMPLARES EVENTOS DE UNA DETERMINADA CATEGORIA , RAZA Y EVENTO
    public static function EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id){

        $ejemplares = EjemplarEvento::where('evento_id',$evento_id)
                                    ->where('categoria_pista_id',$categoria_id)
                                    ->where('raza_id',$raza_id)
                                    ->get();

        return $ejemplares;

    }

    public static function verificaEjemplar($ejemplar_evento_id, $categoria_id, $numero_prefijo, $num_pista){

        $cantidad = Calificacion::where('categoria_id', $categoria_id)
                                ->where('ejemplares_eventos_id', $ejemplar_evento_id)
                                ->where('numero_prefijo', $numero_prefijo)
                                ->where('pista', $num_pista)
                                ->count();

        return $cantidad;

    }

    /**
     * Funcion para sacar al unico ganador escojido como vencedor
     * @return ejemplar solo unico  first()
     */
    public static function ganadorEjemplarEvento($raza, $evento, $categoria, $sexo, $num_pista){

        $jemplar = Ganador::where('evento_id', $evento)
                        ->where('raza_id', $raza)
                        ->whereIn('categoria_id', $categoria)
                        ->where('sexo', $sexo)
                        ->where('mejor_escogido', 'Si')
                        ->where('pista', $num_pista)
                        ->first();

        return $jemplar;
    }

    // esta funcion devuelve la calificacion del ejemplar segun el id de ejemplares_eventos
    public static function ejemplarEventoInscrito($ejemplar_evento_id, $pista){

        $ejemplar_evento = Calificacion::where('ejemplares_eventos_id',$ejemplar_evento_id)
                                        ->where('pista', $pista)
                                        ->first();

        return $ejemplar_evento;

    }

    /**
     * Esta funcion deveolvera un array de nejor macho o ejro hembra
     */
    public static function getMejorMachooHebra($raza_id, $evento_id, $categorias, $num_pista){

        $mejores = Ganador::where('raza_id',$raza_id)
                          ->where('evento_id',$evento_id)
                          ->where('pista',$num_pista)
                          ->whereIn('categoria_id', $categorias)
                          ->where(function($query){

                            $query->where('mejor_macho', "Si")
                                ->orwhere('mejor_hembra',  "Si");

                          })
                          ->get();

        return $mejores;

    }

    /**
     * 
     * Esta function deveulve el sexo opuesto del ganador
     */
    public static function getsexoOpuesto($raza_id, $evento_id, $categorias, $sexo, $tipo, $num_pista){

        if($sexo == 'Macho'){$nuevoSexo = 'Hembra';}else{$nuevoSexo = 'Macho';}

        $querysexoOpuesto = Ganador::where('raza_id',$raza_id)
                                ->where('evento_id',$evento_id)
                                ->whereIn('categoria_id', $categorias)
                                ->whereNull($tipo)
                                ->where('sexo', $nuevoSexo)
                                ->where('pista', $num_pista)
                                ->where('mejor_escogido', 'Si');

        if($tipo == 'mejor_raza'){

            $querysexoOpuesto->where(function($query){
                $query->where('mejor_macho', "Si")
                    ->orwhere('mejor_hembra',  "Si");
            });

        }

        return $querysexoOpuesto->first();

    }

    /**
     * esta funcion devueve el grupo a que pertencece segun la raza_id
     */
    public static function getGrupo($raza_id){

        $grupo = GrupoRaza::where('raza_id',$raza_id)
                        ->first();

        return $grupo;

    }


    public static function getGanadores($evento_id, $categoria, $tipo_campo, $num_pista){

        $ganadores = Ganador::whereIn('categoria_id',$categoria)
                                ->where($tipo_campo, "Si")
                                ->where('evento_id', $evento_id)
                                ->where('pista', $num_pista)
                                ->orderBy('grupo_id','asc')
                                ->get();

        return $ganadores;

    }

    public static function recuperaGanadorBesting($ejemplar_evento_id, $tipo, $grupo_id, $evento_id, $num_pista){

        $besting = Besting::where('tipo', $tipo)
                        ->where('evento_id', $evento_id)
                        ->where('grupo_id', $grupo_id)
                        ->where('pista', $num_pista)
                        ->where('ejemplar_evento_id', $ejemplar_evento_id)
                        ->first();

        return $besting;

    }

    public static function getMejorGrupoMejorRecerbaTipo($grupo_id, $tipo, $mejor, $evento_id, $num_pista){

        $query = Besting::where('grupo_id',$grupo_id)
                        ->where('tipo', $tipo)
                        ->where('pista', $num_pista)
                        ->where('evento_id', $evento_id);

        if($mejor == 'mejor_grupo'){

            $query->where('mejor_grupo', 'Si')
                  ->where('lugar', '1');

        }else{

            $query->where('recerva_grupo', 'Si')
                  ->where('lugar', '2');

        }

        $bestibg = $query->first();

        return $bestibg;

    }

    public static function finalistasBesting($evento_id, $tipo, $num_pista){

        // $finalistas = Besting::where('evento_id',$evento_id)
        //                         ->where('tipo', $tipo)
        //                         ->where('mejor_grupo', 'Si')
        //                         ->where('pista', $num_pista)
        //                         ->get();

        $finalistas = Besting::select('*')
                                ->where('tipo',$tipo)
                                ->where('pista',$num_pista)
                                ->where('evento_id',$evento_id)
                                ->whereNull('lugar_finalista')
                                ->whereIn('lugar', function($query) use ($tipo, $evento_id, $num_pista){
                                    $query->selectRaw('min(lugar)')
                                          ->from('bestings')
                                          ->where('tipo',$tipo)
                                          ->where('pista',$num_pista)
                                          ->where('evento_id',$evento_id)
                                          ->whereNull('lugar_finalista')
                                          ->groupBy('bestings.grupo_id')
                                          ->get();
                                })
                                ->get();

        return $finalistas;

    }

    public static function getFinalistas($evento_id,  $grupo_id, $tipo, $num_pista){

        $ganadeores = Besting::where('grupo_id', $grupo_id)
                            ->where('evento_id',$evento_id)
                            ->where('tipo',$tipo)
                            ->where('pista',$num_pista)
                            ->where('mejor_grupo',"Si")
                            // ->whereNotNull('lugar_finalista')
                            ->get();


        return $ganadeores;

    }

    public static function getJuezSecreEvento($evento_id,  $secretario_id){

        $juez = Asignacion::where('evento_id',$evento_id)
                            ->where('secretario_id',$secretario_id)
                            ->first();

        return $juez;

    }

    public static function getCalificaciones($evento_id, $secretario_id, $ejemplar_evento_id){

        $calificacion = Calificacion::where('evento_id',$evento_id)
                                    ->where('secretario_id',$secretario_id)
                                    ->where('ejemplares_eventos_id',$ejemplar_evento_id)
                                    ->first();

        return $calificacion;

    }

    public static function getGanadoEventoSecretario($evento_id, $secretario_id, $categoria_pista_id, $raza_id, $pista){

        $ganador = Ganador::select('ganadores.*')
                            ->join('calificaciones','ganadores.calificacion_id', '=','calificaciones.id')
                            ->where('ganadores.evento_id',$evento_id)
                            ->where('calificaciones.secretario_id',$secretario_id)
                            ->where('ganadores.categoria_id',$categoria_pista_id)
                            ->where('ganadores.raza_id',$raza_id)
                            ->where('ganadores.pista', $pista)
                            ->first();

        return $ganador;

    }

    public static function getMejoresEscogidos($evento_id, $secretario_id, $categoria_pista_id, $pista, $raza_id){

        $mejoEscogido = Ganador::where('evento_id',$evento_id)
                                ->whereIn('categoria_id', $categoria_pista_id)
                                ->where('pista', $pista)
                                ->where('raza_id', $raza_id)
                                ->where('mejor_escogido', "Si")

                                ->first();

        return $mejoEscogido;

    }

    public static function getReservaSinCalificarSiguiente($num_pista, $tipo, $grupo_id, $lugar){

        while($lugar < 4){

            $lugarRecerva = $lugar+1;

            $recerba = Besting::where('pista', $num_pista)
                                ->where('tipo', $tipo)
                                ->where('lugar', $lugarRecerva)
                                ->whereNull('lugar_finalista')
                                ->where('grupo_id', $grupo_id)
                                ->first();

            if($recerba){
                break;
            }else{
                $lugar++;
            }
            
        }

        if($lugar < 4 && $recerba){

            return $recerba;
            
        }else{

            return null;

        }

    }

    public static function gruposEvento($evento_id){

        $grupos = GrupoRaza::select('grupos_razas.grupo_id')
                        ->join('ejemplares_eventos','grupos_razas.raza_id' , '=', 'ejemplares_eventos.raza_id')
                        ->where('ejemplares_eventos.evento_id', $evento_id)
                        ->groupBy('grupos_razas.grupo_id')
                        ->get();

        return $grupos;
    }


    public static function mejorCategoriaEscogito($evento_id, $categoria_id, $pista, $raza_id){

        $mejor = Ganador::where('pista',$pista)
                        ->where('evento_id',$evento_id)
                        ->where('raza_id',$raza_id)
                        ->whereIn('categoria_id',$categoria_id)
                        // ->where('categoria_id',$categoria_id)
                        ->where('estado',1)
                        ->first();

        return $mejor;

    }

    public static function mejorVencedorSexo($evento_id, $raza_id, $categoria_id, $pista, $tipo){

        $mejores = Ganador::where('raza_id',$raza_id)
                          ->where('evento_id',$evento_id)
                          ->where('pista',$pista)
                          ->whereIn('categoria_id', $categoria_id)
                          ->where($tipo ,"Si")
                          ->first();

        return $mejores;

    }

    /*
        Esta funcion devuelve los mejores escojidos de las raza como ser
        mejor_cachorro, mejjor_jove, mejor_reza
        la variable $tipo_busqueda ayuda por que campo vamos a buscar
     */
    public static function mejorCategoria($evento_id, $pista, $raza_id, $tipo_busqueda){

        $mejor = Ganador::where('evento_id',$evento_id)
                        ->where('pista',$pista)
                        ->where('raza_id',$raza_id)
                        ->where("mejor_escogido",'Si')
                        ->where($tipo_busqueda,'Si')
                        ->first();

        return $mejor;

    }

    public static function getCertificacionExtranjero($evento_id, $num_pista, $raza_id, $tipoCertificacion, $sexo){

        $certificado = Ganador::where('evento_id', $evento_id)
                             ->where('pista', $num_pista)
                             ->where('raza_id', $raza_id)
                             ->where($tipoCertificacion, "Si")
                             ->where('sexo', $sexo)
                             ->first();

        return $certificado;

    }

    public static function getGruposParticipantes($evento_id){

        $grupos = EjemplarEvento::select('grupos_razas.grupo_id')
                                ->join('grupos_razas','ejemplares_eventos.raza_id','=','grupos_razas.raza_id')
                                ->where('ejemplares_eventos.evento_id',$evento_id)
                                ->groupBy('grupos_razas.grupo_id')
                                ->get();

        return $grupos;
        
    }

    /**
     * esta funcion saca la calificaion del ejemplar ya calificado
     */
    public static function getCalificacion($ejemplar_evento_id, $pista, $numero_prefijo){

        $calificacion = Calificacion::where('ejemplares_eventos_id', $ejemplar_evento_id)
                                    ->where('numero_prefijo', $numero_prefijo)
                                    ->where('pista', $pista)
                                    ->first();

        return $calificacion;

    }

    /**
     * Esta funcion devuelve el ganador segun la calificacion
     */
    public static function getGanador($calificacion_id){

        $ganador = Ganador::where('calificacion_id', $calificacion_id)
                          ->first();

        return $ganador;

    }
}