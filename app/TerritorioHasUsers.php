<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class TerritorioHasUsers extends Model
{
    //
    use Softdeletes;
    protected $table = 'territorio_has_users';

    public function territorio(){
    	$this->belongsTo('App\Territorio');
    }

    public function users(){
    	$this->belongsTo('App\User');
    }
}