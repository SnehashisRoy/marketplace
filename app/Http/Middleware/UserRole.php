<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        if(!Auth::check())
        {
            return redirect()->guest('/login');
            
        }
        
        if(!$request->user()->role()->firstOrfail()->hasRole($role))
        {
            return redirect()->guest('/login'); 
        }
        return $next($request);
    }
}
