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
    protected $fillable = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $dates = ['deleted_at'];

    // Requerido para cambiar el username de passport
    public function findForPassport($username) {
        return $this->where('email', $username)->where('status',1)->first();
    }

    public function t_users(){
        return $this->belongsTo('App\TUsers');
    }

    public function eventlog(){
        return $this->hasMany('App\Eventlog');
    }

    public function grupo(){
        return $this->hasMany('App\Grupo');
    }

    public function territorio_has_users(){
        return $this->hasMany('App\TerritorioHasUsers');
    }
}
