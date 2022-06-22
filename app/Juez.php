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
            
            $ejemplares = EjemplarEvento::select('ejemplares_eventos.numero_prefijo', 'ejemplares_eventos.raza_id', 'grupos_razas.grupo_id', 'ejemplares_eventos.categoria_pista_id as categoria_id')
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

    public static function verificaEjemplar($ejemplar_evento_id, $categoria_id, $numero_prefijo){

        $cantidad = Calificacion::where('categoria_id', $categoria_id)
                                ->where('ejemplares_eventos_id', $ejemplar_evento_id)
                                ->where('numero_prefijo', $numero_prefijo)
                                ->count();


        return $cantidad;

    }

    /**
     * Funcion para sacar al unico ganador escojido como vencedor
     * @return ejemplar solo unico  first()
     */
    public static function ganadorEjemplarEvento($raza, $evento, $categoria, $sexo){

        $jemplar = Ganador::where('evento_id', $evento)
                        ->where('raza_id', $raza)
                        ->whereIn('categoria_id', $categoria)
                        ->where('sexo', $sexo)
                        ->where('mejor_escogido', 'Si')
                        ->first();

        return $jemplar;
    }

    // esta funcion devuelve la calificacion del ejemplar segun el id de ejemplares_eventos
    public static function ejemplarEventoInscrito($ejemplar_evento_id){

        $ejemplar_evento = Calificacion::where('ejemplares_eventos_id',$ejemplar_evento_id)->first();

        return $ejemplar_evento;

    }

    /**
     * Esta funcion deveolvera un array de nejor macho o ejro hembra
     */
    public static function getMejorMachooHebra($raza_id, $evento_id, $categorias){

        $mejores = Ganador::where('raza_id',$raza_id)
                          ->where('evento_id',$evento_id)
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
    public static function getsexoOpuesto($raza_id, $evento_id, $categorias, $sexo, $tipo){

        if($sexo == 'Macho'){$nuevoSexo = 'Hembra';}else{$nuevoSexo = 'Macho';}

        $querysexoOpuesto = Ganador::where('raza_id',$raza_id)
                                ->where('evento_id',$evento_id)
                                ->whereIn('categoria_id', $categorias)
                                ->whereNull($tipo)
                                ->where('sexo', $nuevoSexo)
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


    public static function getGanadores($evento_id, $categoria, $tipo_campo){

        // dd($evento_id, $categoria, $tipo_campo);

        $ganadores = Ganador::whereIn('categoria_id',$categoria)
                                ->where($tipo_campo, "Si")
                                ->where('evento_id', $evento_id)
                                ->orderBy('grupo_id','asc')
                                ->get();

        return $ganadores;

    }
}
