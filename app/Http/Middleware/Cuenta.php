<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class Cuenta
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

        if (!empty(session('id_usuario'))) {

            switch (session('tipo')) {

                case 'ciudadano':
                        Redirect::to(url('ciudadano/tramites'))->send();
                    break;

                case 'revisor':
                    Redirect::to(url('revisor/solicitudes'))->send();
                    break;

                case 'administrador':
                    Redirect::to(url('administrador/ciudadanos'))->send();
                    break;
            }
        }

        return  $next($request);
        
    }
}
