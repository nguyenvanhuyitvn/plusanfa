<?php

namespace App\Http\Middleware;

use Closure;

class apiCheckLogout
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
        // dd(session());
        if(session('token')){
            return $next($request);
        }
        return redirect()->route('login');
    }
}
