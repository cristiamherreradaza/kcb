<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EjemplarEvento extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'evento_id',
        'ejemplar_id',
        'raza_id',
        'categoria_pista_id',
        'direccion',
        'codigo_nacionalizado',
        'nombre_completo',
        'color',
        'fecha_nacimiento',
        'sexo',
        'chip',
        'kcb_padre',
        'nombre_padre',
        'kcb_madre',
        'nombre_madre',
        'criador',
        'propietario',
        'ciudad',
        'telefono',
        'email',
        'estado',
        'deleted_at',
    ];
    
}
