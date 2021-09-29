<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuPerfil extends Model
{
    use SoftDeletes;

    protected $table = "menus_perfiles";

    protected $fillable = [
        'nombre',
        'direccion',
        'icono',
        'padre',
        'orden',
        'estado',
        'deleted_at',
    ];
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id');
    }
}
