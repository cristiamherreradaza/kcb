<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignacion extends Model
{
    use SoftDeletes;
    protected $table = "asignaciones";
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'sucursal_id',
        'juez_id',
        'secretario_id',
        'evento_id',
        'estado',
        'deleted_at',
    ];
}
