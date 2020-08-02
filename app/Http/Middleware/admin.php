<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
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
//        if (isset(Auth::user()->role) && Auth::user()->role==='Admin')
//            return redirect()->intended('/');
//
//        else {
//            return $next($request);
//    }
        if (isset(Auth::user()->role) && (strpos(Auth::user()->role,'Admin')!==false) )
            return $next($request);

        else {
            return redirect('login');

        }
    }
}
