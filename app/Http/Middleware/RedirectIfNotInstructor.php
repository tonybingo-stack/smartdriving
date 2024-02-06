<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotInstructor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->isInstructor()) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
