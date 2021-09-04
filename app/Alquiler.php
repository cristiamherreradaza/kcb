<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alquiler extends Model
{
    use SoftDeletes;
    protected $table = 'alquileres';
    
    protected $fillable = [
        'user_id',
        'criadero_id',
        'ejemplar_id',
        'propietario_original_id',
        'propietario_alquilado_id',
        'numero',
        'fecha',
        'estado',
        'deleted_at',
    ];
}
