<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use SoftDeletes;
    protected $table = "sucursales";
    protected $fillable = [
        'user_id',
        'nombre',
        'direccion',
        'celulares',
        'departamento',
        'cuenta',
        'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
