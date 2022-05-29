<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Juez extends Model
{
    use SoftDeletes;
    
    protected $table = 'jueces';
     
    protected $fillable = [
        'user_id',
        'modificador_id',
        'eliminador_id',
        'sucursal_id',
        'categoria_juez_id',
        'nombre',
        'email',
        'fecha_nacimiento',
        'direccion',
        'celulares',
        'ci',
        'departamento',
        'estado',
        'foto',
        'deleted_at',
    ];

    public function categoriaJuez(){

        return $this->belongsTo('App\CategoriaJuez', 'categoria_juez_id');

    }
}
