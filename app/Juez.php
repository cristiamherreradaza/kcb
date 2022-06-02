<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public static function ejemplaresCategoria($categoria, $evento_id, $grupo){

        if($categoria == "Especiales"){
            
            $ejemplares = EjemplarEvento::select('ejemplares_eventos.numero_prefijo', 'ejemplares_eventos.raza_id', 'grupos_razas.grupo_id', 'ejemplares_eventos.categoria_pista_id')
                                        ->join('razas','ejemplares_eventos.raza_id','=','razas.id')
                                        ->join('grupos_razas','razas.id', '=', 'grupos_razas.raza_id')
                                        ->where("grupos_razas.grupo_id",$grupo)
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
}
