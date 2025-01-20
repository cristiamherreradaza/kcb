<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_anterior',
        'perfil_id',
        'sucursale_id',
        'user_id',
        'name',
        'email',
        'password',
        'fecha_nacimiento',
        'estado',
        'direccion',
        'celulares',
        'genero',
        'tipo',
        'ci',
        'departamento',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function criaderos()
    {
        return $this->hasMany('App\Criadero');
    }

    public function perfil(){
        return $this->belongsTo('App\Perfil', 'perfil_id');
    }

    public function adminDatosEliminar(){
        $permisos = json_decode($this->permisos);
        if($permisos){
            return $permisos->adminDatos->eliminar;
        }else{
            return false;
        }
    }

    public function adminDatosEditar(){
        $permisos = json_decode($this->permisos);
        if($permisos){
            return $permisos->adminDatos->editar;
        }else{
            return false;
        }
    }

    public function adminDatosAgregar(){
        $permisos = json_decode($this->permisos);
        if($permisos){
            return $permisos->adminDatos->agregar;
        }else{
            return false;
        }
    }

    public function adminEjemplarRegistroExamen(){
        $permisos = json_decode($this->permisos);
        if($permisos){
            return $permisos->adminEjemplar->registroExamen;
        }else{
            return false;
        }
    }

    public function adminEjemplarRegistroTramsferencia(){
        $permisos = json_decode($this->permisos);
        if($permisos){
            return $permisos->adminEjemplar->registroTramsferencia;
        }else{
            return false;
        }
    }

    public function adminEjemplarRegistroTitulo(){
        $permisos = json_decode($this->permisos);
        if($permisos){
            return $permisos->adminEjemplar->registroTitulo;
        }else{
            return false;
        }
    }

    public function adminEjemplarImpresionPedigree(){
        $permisos = json_decode($this->permisos);
        if($permisos){
            return $permisos->adminEjemplar->impresionPedigree;
        }else{
            return false;
        }
    }

}
