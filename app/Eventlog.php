<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventlog extends Model
{
    //
    protected $table = 'eventlog';

    public function users(){
    	$this->belongsTo('App\User');
    }
}