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
                            ->get();
                            // ->first();

        return $juez;
        
    }

    public static function razasParticipantesEventoGanadores($evento_id, $pistas){

        $razas = Ganador::select('ganadores.raza_id')
                        ->where('evento_id',$evento_id)
                        ->where('pista',$pistas)
                        ->groupBy('ganadores.raza_id')
                        ->get();


        return $razas; 
    }

    public static function ganadoresBesting($evento_id, $pista, $tipo, $lugar){

        $ganadores = Besting::where('evento_id',$evento_id)
                            ->where('pista', $pista)
                            ->where('tipo', $tipo)
                            ->where('lugar_finalista', $lugar)
                            ->first();

        return $ganadores;

    }

}
