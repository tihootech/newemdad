<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmins
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
        if ( is('master') || is('expert')) {
            return $next($request);
        }else {
            abort(403);
        }
    }
}
