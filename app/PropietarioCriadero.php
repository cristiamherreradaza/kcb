<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropietarioCriadero extends Model
{
    use SoftDeletes;
    protected $table = 'propietarios_criaderos';
    
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'propietario_id',
        'criadero_id',
        'estado',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function propietario()
    {
        return $this->belongsTo('App\User', 'propietario_id');
    }

    public function criadero()
    {
        return $this->belongsTo('App\Criadero', 'criadero_id');
    }

}
