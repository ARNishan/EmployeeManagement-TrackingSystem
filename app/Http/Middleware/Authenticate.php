<?php

namespace App\Http\Middleware;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request/*AuthenticationException $exception*/)
    {
        if (! $request->expectsJson()) {
            // if (! $request->expectsJson()) { 
            // $guard = array_get($exception->guards(), 0);
            // switch ($guard) {
            //     case 'admin':
            //         $login = 'admin';

            //         break;
                
            //     default:
            //         $login = 'user';
            //         break;
            // }
            // return redirect()->guest(route($login));
           // if ($request->is('admin') || $request->is('admin/*')) {
           //      return redirect('/admin');
           //  }
           //  if ($request->is('user') || $request->is('user/*')) {
           //      return redirect('/user');
           //  }

           //   }
          
            if (Route::is('admin.*')) {
                return route('admin');
            }
            return route('user');
  
          
        }
    }
}
