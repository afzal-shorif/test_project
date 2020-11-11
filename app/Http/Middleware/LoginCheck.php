<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('authorize') && $request->session()->get('authorize')=='anyValue'){

            return $next($request);
        }else{
            //print_r( $request->session()->all());
            return redirect('/login');
        }

    }
}
