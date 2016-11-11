<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\EventlogRegister;

class TrabajadorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=$request->user();
        if($user->tipo_usuario_id==3 || $user->tipo_usuario_id>=5){
            return $next($request);
        }else{
            $msj='Acción solo de trabajadores, coordinadores o admins';
            $ev=new EventlogRegister;
            $ev->registro(0,$msj,$user->id);
            return response('',404);
        }
    }
}
