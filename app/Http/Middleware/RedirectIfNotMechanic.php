<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotMechanic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->isMechanic()) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
