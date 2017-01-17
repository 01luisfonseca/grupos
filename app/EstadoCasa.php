<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class EstadoCasa extends Model
{
    //
    use Softdeletes;
    protected $table = 'estado_casa';

    public function casa(){
    	$this->belongsTo('App\Casa');
    }
}