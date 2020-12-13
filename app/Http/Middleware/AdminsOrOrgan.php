<?php

namespace App\Http\Middleware;

use Closure;

class AdminsOrOrgan
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
        if ( is('master') || is('expert') || is('organ')) {
            return $next($request);
        }else {
            abort(403);
        }
    }
}
