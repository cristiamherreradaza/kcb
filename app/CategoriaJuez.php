<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaJuez extends Model
{
    use SoftDeletes;

    protected $table = "categoria_juezes";
    
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'nombre',
        'descripcion',
        'estado',
        'deleted_at',
    ];
    
}
