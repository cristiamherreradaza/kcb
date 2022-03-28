<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calificacion extends Model
{
    use SoftDeletes;

    protected $table = 'calificaciones';

    protected $fillable = [
        'creador_id',
        'modificador_id',
        'eliminador_id',
        'evento_id',
        'juez_id',
        'secretario_id',
        'ejemplar_id',
        'raza_id',
        'categoria_id',
        'grupo',
        'calificacion',
        'lugar',
        'estado',
        'deleted_at',
    ];
}
