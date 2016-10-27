<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class PagoSalario extends Model
{
    //
    use Softdeletes;
    protected $table = 'pago_salario';

    public function empleados(){
    	return $this->belongsTo('App\Empleados');
    }
    
    public function meses(){
    	return $this->belongsTo('App\Meses');
    }
}
