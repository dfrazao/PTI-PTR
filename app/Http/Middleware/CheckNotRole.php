<?php

namespace App\Http\Middleware;

use Closure;
use http\Client\Curl\User;
use Auth;
class CheckNotRole
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
        if (Auth::check()) {
            if (Auth::user()->role != 'admin') {
                return $next($request);
            } else {
                return abort('403');
            }
        } else {
            return redirect('');
        }
   }
}
