<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class Administrador
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

        if (empty(session('id_usuario'))) {
            Redirect::to(url('cuenta'))->send();
        }

        if (session('tipo') === 'ciudadano') {

            Redirect::to(url()->previous())->send();
        } else if (session('tipo') === 'revisor') {
            
            Redirect::to(url()->previous())->send();
        }

        return $next($request);
    }
}
