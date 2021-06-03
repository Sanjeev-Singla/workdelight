<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = NULL)
    {
        dd($guard);
        if ( !Auth::guard($guard)->guest() ) {
            if(Auth::user()->role == 1 ){
                return $next($request);
            }
            else{
                $request->session()->invalidate();
                Auth::guard()->logout();
                \session()->flash('flash_danger', 'Sorry, You do not have access permission');
                return redirect('/admin');
            }
        }
        return redirect('/admin')->with('error','You do not have admin access');
    }
}
