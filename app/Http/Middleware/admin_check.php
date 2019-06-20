<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin_check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(Auth::guard('admin')->check())
          {
            return redirect()->route('admin');
          }
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/user-dashboard');
        // }

        return $next($request);
    }
}
