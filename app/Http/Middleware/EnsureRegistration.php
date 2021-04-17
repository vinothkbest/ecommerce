<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRegistration
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
        $is_registered = session('is_registered');

        //dd($is_registered);

        if($is_registered == true){

            return $next($request);
        }
        else{
            return back();
        }
    }
}
