<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuUsers extends Model
{
    use SoftDeletes;

    protected $table = "menus_users";

    protected $fillable = [
        'user_id',
        'menu_id',
        'estado',
        'deleted_at',
    ];
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id');
    }
}
