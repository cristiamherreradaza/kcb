<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examen extends Model
{
    use SoftDeletes;
    protected $table = 'examenes';
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'nombre',
        'descripcion',
        'estado',
        'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
