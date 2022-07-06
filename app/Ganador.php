<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ganador extends Model
{
    use SoftDeletes;

    protected $table = "ganadores";

    protected $fillable = [
        'creador_id',
        'modificador_id',
        'eliminador_id',
        'calificacion_id',
        'ejemplar_id',
        'evento_id',
        'ejemplar_evento_id',
        'calificacion',
        'lugar',
        'mejor_escogido',
        'mejor_macho',
        'mejor_hembra',
        'mejor_cachorro',
        'sexo_opuesto_cachorro',
        'mejor_joven',
        'sexo_opuesto_joven',
        'mejor_raza',
        'sexo_opuesto_raza',
        'estado',
        'deleted_at',
    ];

    public function calificacion()
    {
        return $this->belongsTo('App\Calificacion', 'calificacion_id');
    }
}
