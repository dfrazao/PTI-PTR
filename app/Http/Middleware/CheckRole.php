<?php

namespace App\Http\Middleware;

use Closure;
use http\Client\Curl\User;
use Auth;
class CheckRole
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

        if (Auth::user()->role != 'admin') {
            return redirect('');
        }else{

            return $next($request);
        }

   }
}
