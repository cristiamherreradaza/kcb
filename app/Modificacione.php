<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modificacione extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tabla',
        'original',
        'cambio',
        'estado',
        'deleted_at',
    ];


}
