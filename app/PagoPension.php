<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class PagoPension extends Model
{
    //
    use Softdeletes;
    protected $table = 'pago_pension';

    public function alumnos(){
    	return $this->belongsTo('App\Alumnos');
    }
    
    public function meses(){
    	return $this->belongsTo('App\Meses');
    }
}
