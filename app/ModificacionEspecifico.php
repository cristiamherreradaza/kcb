<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModificacionEspecifico extends Model
{
    use SoftDeletes;

    protected $table = "modificaciones_especificos";
    
    protected $fillable = [
        'user_id', 
        'ejemplar_id', 
        'campo',
        'dato_anteriror', 
        'dato_modificado', 
        'action', 
        'estado',
        'deleted_at'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
