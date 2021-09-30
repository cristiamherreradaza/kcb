<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pista extends Model
{
    use SoftDeletes;
    protected $table = 'pistas';
    
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'nombre',
        'estado',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
