<?php

namespace App\Http\Middleware;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Closure;

class ApiCheckLogin
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
    //    dd(session('token'));
        if (!session('token')) {
            return $next($request);
        }
        return redirect()->route('dashboard');
    }
}

