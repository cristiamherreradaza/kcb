<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criadero extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'codigo_anterior',
        'nombre',
        'registro_fci',
        'departamento',
        'fecha',
        'modalidad_ingreso',
        'direccion',
        'celulares',
        'pagina_web',
        'email',
        'estado',
        'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function copropietario()
    {
        return $this->belongsTo('App\User', 'copropietario_id');
    }

    public function propietarios()
    {
        return $this->hasMany('App\PropietarioCriadero');
    }
}
