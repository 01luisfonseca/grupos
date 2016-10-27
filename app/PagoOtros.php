<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class PagoOtros extends Model
{
    //
    use Softdeletes;
    protected $table = 'pago_otro';

    public function alumnos(){
    	return $this->belongsTo('App\Alumnos');
    }
}
