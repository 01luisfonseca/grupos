<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    //
    use Softdeletes;
    protected $table = 'tipo_usuario';

    public function usuarios(){
    	$this->hasMany('App\User');
    }
}
