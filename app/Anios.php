<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Anios extends Model
{
    //
    use Softdeletes;
    protected $table = 'anios';

    public function periodos(){
    	return $this->hasMany('App\Periodos');
    }

}
