<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if(Auth::check()){
            if (Auth::user()->root != 1 ) {
               //return redirect('profile');
               //return redirect->back();
            }
        }
        return $next($request);
    }
}
