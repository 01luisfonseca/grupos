<?php

namespace App\Helpers;

use App\Helpers\Contracts\EventlogContract;
use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\Eventlog;

class EventlogRegister implements EventlogContract
{

    public function registro($nivel=0,$desc='')
    {
    	$req=Request::capture();
    	$ev=new Eventlog;
    	$ev->users_id=$req->user()->id;
    	$ev->nivel=$nivel;
    	$ev->descipcion=$desc;
    	$ev->save();
    	return true;

    }

}
