<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transferencia extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'codigo_anterior',
        'user_id',
        'modificador_id',
        'eliminador_id',
        'propietario_id',
        'ejemplar_id',
        'fecha_transferencia',
        'estado',
        'pedigree_exportacion',
        'fecha_exportacion',
        'pais_destino',
        'deleted_at',
    ];    
    public function propietario()
    {
        return $this->belongsTo('App\User', 'propietario_id');
    }

    public function userEliminador()
    {
        return $this->belongsTo('App\User', 'eliminador_id');
    }
    
    public function asignador()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
