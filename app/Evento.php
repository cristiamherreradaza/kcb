<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'hora',
        'direccion',
        'departamento',
        'numero_pista',
        'circuito',
        'habilitado',
        'estado',
        'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function bestingTipos($tipo, $evento, $num_pista){

        $besting = Besting::where('evento_id',$evento)
                        ->where('tipo',$tipo)
                        ->where('pista',$num_pista)
                        ->orderBy('grupo_id','asc')
                        ->get();

        return $besting;
    }

    public static function getPuestoGanador($evento_id, $tipo, $puesto, $num_pista){

        $ganador = Besting::where('evento_id',$evento_id)
                            ->where('tipo',$tipo)
                            // ->where('lugar',1)
                            ->where('pista',$num_pista)
                            ->where('lugar_finalista', $puesto)
                            ->first();

        return $ganador;
        
    }

    public static function getJuez($evento_id, $num_pista){

        $juez = Asignacion::where('evento_id',$evento_id)
                            ->where('num_pista', $num_pista)
                            ->first();

        return $juez;
        
    }

}
