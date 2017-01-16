<?php

namespace App;

use Illuminate\Database\Eloquent\Softdeletes;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    //
    use Softdeletes;
    protected $table = 'options';

}
