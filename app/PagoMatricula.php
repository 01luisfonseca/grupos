<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class PagoMatricula extends Model
{
    //
    use Softdeletes;
    protected $table = 'pago_matricula';

    public function alumnos(){
    	return $this->belongsTo('App\Alumnos');
    }
}
