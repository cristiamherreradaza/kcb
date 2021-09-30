<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamenMascota extends Model
{
    use SoftDeletes;
    protected $table = 'examenes_mascotas';
    
    protected $fillable = [
        'codigo_anterior',
        'user_id',
        'modificador_id',
        'eliminador_id',
        'ejemplar_id',
        'examen_id',
        'aptocriaseleccion_uno',
        'aptocriaseleccion_dos',
        'fecha_examen',
        'dcf',
        'resultado',
        'observacion',
        'numero_formulario',
        'estado',
        'deleted_at',
    ];
    public function examen()
    {
        return $this->belongsTo('App\Examen', 'examen_id');
    }

    public function userEliminador()
    {
        return $this->belongsTo('App\User', 'eliminador_id');
    }
}
