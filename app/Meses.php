<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Meses extends Model
{
    //
    use Softdeletes;
    protected $table = 'mes';

    public function pago_salario(){
    	return $this->hasMany('App\PagoSalario');
    }

    public function pago_pension(){
    	return $this->hasMany('App\PagoPension');
    }
}
