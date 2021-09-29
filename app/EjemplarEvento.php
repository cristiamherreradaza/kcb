<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EjemplarEvento extends Model
{
    use SoftDeletes;
    protected $table = "ejemplares_eventos";

    protected $fillable = [
        'user_id',
        'evento_id',
        'ejemplar_id',
        'raza_id',
        'categoria_pista_id',
        'direccion',
        'codigo_nacionalizado',
        'nombre_completo',
        'color',
        'fecha_nacimiento',
        'sexo',
        'chip',
        'kcb_padre',
        'nombre_padre',
        'kcb_madre',
        'nombre_madre',
        'criador',
        'propietario',
        'ciudad',
        'tatuaje',
        'telefono',
        'email',
        'edad',
        'estado',
        'deleted_at',
    ];

    public function raza()
    {
        return $this->belongsTo('App\Raza', 'raza_id');
    }

    public function ejemplar()
    {
        return $this->belongsTo('App\Ejemplar', 'ejemplar_id');
    }

    public function categoriaPista()
    {
        return $this->belongsTo('App\CategoriasPista', 'categoria_pista_id');
    }
    public function grupoRaza()
    {
        return $this->belongsTo('App\GrupoRaza', 'raza_id');
    }
}
