<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'lastname', 
        'identificacion', 
        'birday', 
        'telefono', 
        'direccion', 
        'acudiente', 
        'tipo_sangre', 
        'tipo_usuario_id', 
        'estado', 
        'email', 
        'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    protected $dates = ['deleted_at'];

    // Requerido para cambiar el username de passport
    public function findForPassport($username) {
        return $this->where('identificacion', $username)->first();
    }

    public function tipo_usuario(){
        return $this->belongsTo('App\TipoUsuario');
    }

    public function alumnos(){
        return $this->hasMany('App\Alumnos');
    }

    public function empleados(){
        return $this->hasMany('App\Empleados');
    }
}
