<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

use Closure;

class checksession
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
        if(Session::has('userid'))
        {

            return $next($request);
        }
        if(Cookie::has('userid'))
        {
            $request->session()->put('userid', Cookie::get('userid'));
            return $next($request);
        }
        return view("login");
    }
}
