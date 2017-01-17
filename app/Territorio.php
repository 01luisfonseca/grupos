<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Territorio extends Model
{
    //
    use Softdeletes;
    protected $table = 'territorio';

    public function territorio_has_users(){
    	$this->hasMany('App\TerritorioHasUsers');
    }

    public function cuadra(){
    	$this->hasMany('App\Cuadra');
    }

    public function grupo(){
    	$this->belongsTo('App\Grupo');
    }
}