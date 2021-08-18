<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoRaza extends Model
{
    use SoftDeletes;
    protected $table = 'grupos_razas';
    
    protected $fillable = [
        'codigo_anterior',
        'user_id',
        'raza_id',
        'grupo_id',
        'estado',
        'deleted_at',
    ];
    public function razas()
    {
        return $this->belongsTo('App\Raza', 'raza_id');
    }

    public function grupos()
    {
        return $this->belongsTo('App\Grupo', 'grupo_id');
    }
}
