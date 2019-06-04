<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserState
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
        if (Auth::user()->state == "inactive"){

            $request->session()->put('status', '"Your Account is Suspended, try contacting a administrator"');

            return redirect('home');
        }
        else
            return $next($request);
    }
}
