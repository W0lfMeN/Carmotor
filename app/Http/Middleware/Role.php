<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /* check comprueba si hay un usuario logueado, independientemente quien sea */
        if(auth()->check()){
            /* Este if comprueba el rol del usuario que ya sabemos que está autenticado.
               Si el rol es 2 es que es admin por lo tanto permite acceder al enlace que se solicite
            */
            if(auth()->user()->rol == '2'){
                return $next($request);
            }
        }

        return response()->view('errors.' . '404', [], 404); # Si no hay login o el usuario logueado no es admin, se lanza la pagina de error 404
    }
}
