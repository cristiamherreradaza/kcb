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
        'estado',
        'deleted_at',
    ];
}
