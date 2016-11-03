<?php

namespace App\Helpers;

use App\Helpers\Contracts\EventlogContract;
use Illuminate\Http\Request;
use App\Eventlog;

class EventlogRegister implements EventlogContract
{

    public function registro($nivel=0,$desc='',$id=0)
    {
    	
        $ev=new Eventlog;
    	$ev->users_id=$id;
    	$ev->nivel=$nivel;
    	$ev->descripcion=$desc;
    	$ev->save();
    	return true;

    }

}
