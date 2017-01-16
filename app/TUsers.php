<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class TUsers extends Model
{
    //
    use Softdeletes;
    protected $table = 't_users';

    public function users(){
    	$this->hasMany('App\User');
    }
}
