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

    public function criadero()
    {
        return $this->belongsTo('App\Criadero', 'criadero_id');
    }

    public function propietario_antiguo()
    {
        return $this->belongsTo('App\user', 'propietario_original_id');
    }

    public function propietario_alquilado()
    {
        return $this->belongsTo('App\user', 'propietario_alquilado_id');
    }
    public function ejemplar()
    {
        return $this->belongsTo('App\Ejemplar', 'ejemplar_id');
    }
}
