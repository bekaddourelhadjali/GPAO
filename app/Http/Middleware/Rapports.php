<?php

namespace App\Http\Middleware;

use App\Dashboard\Locations;
use Closure;
use Illuminate\Support\Facades\Request;

class Rapports
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$zone)
    {
            $location = Locations::where('AdresseIp',Request::ip())->where('Zone',$zone)->get();
            if(sizeof($location)>0)
                return $next($request);
        return redirect('UnAuthorized');
    }
}
