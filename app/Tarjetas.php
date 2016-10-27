<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Tarjetas extends Model
{
    //
    use Softdeletes;
    protected $table = 'tarjetas';

}
