<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if($user->tipo_usuario_id==6){
            return $next($request);
        }else{
            $msj='Acción solo de administradores';
            $ev=new EventlogRegister;
            $ev->registro(0,$msj,$user->id);
            return response('',404);
        }
    }
}
