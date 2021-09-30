<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camada extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'codigo_anterior',
        'padre_id',
        'madre_id',
        'criadero_id',
        'sucursale_id',
        'raza_id',
        'tipo_pelo',
        'variedad',
        'fecha_nacimiento',
        'camada',
        'lechigada',
        'num_parto_madre',
        'cachorros_encontrados',
        'visado',
        'lugar',
        'departamento',
        'fecha_registro',
        'estado',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function padre()
    {
        return $this->belongsTo('App\Ejemplar', 'padre_id');
    }

    public function madre()
    {
        return $this->belongsTo('App\Ejemplar', 'madre_id');
    }

    public function raza()
    {
        return $this->belongsTo('App\Raza', 'raza_id');
    }
}
