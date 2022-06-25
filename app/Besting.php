<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Besting extends Model
{

    use SoftDeletes;
     
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'categoria_pista_id',
        'ejemplar_evento_id',
        'raza_id',
        'grupo_id',
        'evento_id',
        'ejemplar_id',
        'ganador_id',
        'numero_prefijo',
        'lugar',
        'tipo',
        'mejor_grupo',
        'recerva_grupo',        
        'lugar_finalista',
        'estado',
        'deleted_at',
    ];
}
