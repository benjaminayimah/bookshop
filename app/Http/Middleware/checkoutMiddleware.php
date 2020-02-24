<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkoutMiddleware
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
        if( Auth::user() || session()->exists('bookIdses')){

            return $next($request);
        }
        return redirect()->route('get.cart');
    }
}

