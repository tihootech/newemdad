<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfNotUser
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
        if (is('user')) {
            abort(403);
        }else {
            return $next($request);
        }
    }
}
