<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventlog extends Model
{
    //
    protected $table = 'eventlog';
    protected $fillable= ['users_id','nivel','descripcion'];

    public function usuarios(){
    	$this->belongsTo('App\User');
    }
}