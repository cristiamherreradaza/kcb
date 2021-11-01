<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ejemplar extends Model
{
    use SoftDeletes;
    protected $table = "ejemplares";

    protected $fillable = [
        'codigo_anterior',
        'user_id',
        'modificador_id',
        'eliminador_id',
        'madre_id',
        'padre_id',
        'camada_id',
        'raza_id',
        'criadero_id',
        'propietario_id',
        'propietario_actual_id',
        'propietario_padre_id',
        'propietario_madre_id',
        'suscursal_id',
        'kcb',
        'codigo_nacionalizado',
        'extranjero',
        'num_tatuaje',
        'chip',
        'fecha_nacimiento',
        'color',
        'senas',
        'nombre',
        'nombre_completo',
        'primero_mostrar',
        'prefijo',
        'variedad',
        'lechigada',
        'sexo',
        'origen',
        'propietario_extranjero',
        'afijo_extranjero',
        'lugar_extranjero',
        'titulos_extranjeros',
        'consaiguinidad',
        'hermano',
        'departamento',
        'fallecido',
        'fecha_fallecido',
        'fecha_perdido',
        'descripcion_perdido',
        'fecha_emision',
        'fecha_nacionalizado',
        'estado',
        'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function raza()
    {
        return $this->belongsTo('App\Raza', 'raza_id');
    }

    public function propietario()
    {
        return $this->belongsTo('App\User', 'propietario_id');
    }

    public function padre()
    {
        return $this->belongsTo('App\Ejemplar', 'padre_id');
    }

    public function madre()
    {
        return $this->belongsTo('App\Ejemplar', 'madre_id');
    }

    public function criadero()
    {
        return $this->belongsTo('App\Criadero', 'criadero_id');
    }
    public function camada()
    {
        return $this->belongsTo('App\Camada', 'camada_id');
    }
}
