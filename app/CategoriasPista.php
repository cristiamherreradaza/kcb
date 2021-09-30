<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriasPista extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'nombre',
        'desde',
        'hasta',
        'tipo',
        'orden',
        'descripcion',
        'estado',
        'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
