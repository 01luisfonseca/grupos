<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    //
    use Softdeletes;
    protected $table = 'casa';

    public function cuadra(){
    	$this->belongsTo('App\Cuadra');
    }

    public function estado_casa(){
    	$this->hasMany('App\EstadoCasa');
    }
}