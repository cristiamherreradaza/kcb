<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TituloEjemplar extends Model
{
    use SoftDeletes;

    protected $table = "titulos_ejemplares";
    protected $fillable = [
        'codigo_anterior',
        'user_id',
        'modificador_id',
        'eliminador_id',
        'titulo_id',
        'ejemplar_id',
        'fecha_obtencion',
        'estado',
        'deleted_at',
    ];

    public function titulo()
    {
        return $this->belongsTo('App\Titulo', 'titulo_id');
    }
}
