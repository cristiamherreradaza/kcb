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
        'ejemplar_evento_id',
        'evento_id',
        'juez_id',
        'secretario_id',
        'ejemplar_id',
        'raza_id',
        'categoria_id',
        'grupo',
        'numero_prefijo',
        'grupo_id',
        'sexo',
        'calificacion',
        'lugar',
        'estado',
        'deleted_at',
    ];

    public function inscripcion()
    {
        return $this->belongsTo('App\EjemplarEvento', 'inscripcion_id');
    }

    public function juez()
    {
        return $this->belongsTo('App\Juez', 'juez_id');
    }

    public function raza()
    {
        return $this->belongsTo('App\Raza', 'raza_id');
    }

}
