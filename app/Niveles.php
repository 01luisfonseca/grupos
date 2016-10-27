<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Niveles extends Model
{
    //
    use Softdeletes;
    protected $table = 'niveles';

    public function alumnos(){
    	return $this->hasMany('App\Alumnos');
    }

    public function niveles_has_anios(){
    	return $this->hasMany('App\NivelesHasAnios');
    }

}
