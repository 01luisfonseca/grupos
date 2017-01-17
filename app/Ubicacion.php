<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    //
    use Softdeletes;
    protected $table = 'ubicacion';

    public function cuadra(){
    	$this->belongsTo('App\Cuadra');
    }
}