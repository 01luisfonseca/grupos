<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Asiserved extends Model
{
    //
    protected $table = 'asiserved';
    use Softdeletes;

}
