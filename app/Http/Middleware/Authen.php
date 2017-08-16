<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param   $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {
        if(!Auth::guard($guard)->check())
        {
            return redirect()->route('/');
        }
        return $next($request);

    }
}
