<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
      //  dump(Auth::check());
       if (Auth::check()) {
         //  dd(Auth::user()->isAdmin());
           if (Auth::user()->isAdmin()){
               return $next($request);
           }
       }
       abort(403);
       // return back();
    }
}
