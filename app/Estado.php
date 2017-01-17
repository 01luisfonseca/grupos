<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    use Softdeletes;
    protected $table = 'estado';

    public function estado_casa(){
    	$this->hasMany('App\EstadoCasa');
    }
}