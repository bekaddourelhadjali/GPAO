<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class admin
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
        if (isset(Auth::user()->role) && Auth::user()->role==='Admin')
            return $next($request);

    else {
        return redirect('login');

    }

    }
}
