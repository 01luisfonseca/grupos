<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    //
    use Softdeletes;
    protected $table = 'grupo';

    public function territorio(){
    	$this->hasMany('App\Territorio');
    }

    public function users(){
    	$this->belongsTo('App\User');
    }
}
