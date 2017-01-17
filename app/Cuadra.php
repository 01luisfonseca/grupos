<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Cuadra extends Model
{
    //
    use Softdeletes;
    protected $table = 'cuadra';

    public function territorio(){
    	$this->belongsTo('App\Territorio');
    }

    public function ubicacion(){
    	$this->hasMany('App\Ubicacion');
    }

    public function casa(){
    	$this->hasMany('App\Casa');
    }
}