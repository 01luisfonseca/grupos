<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Generales extends Model
{
    //
    use Softdeletes;
    protected $table = 'generales';

}
