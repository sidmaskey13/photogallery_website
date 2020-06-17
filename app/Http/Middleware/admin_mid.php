<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class admin_mid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        if(Auth::check()){
            if(Auth::user()->branches()->where('branches.id',1)->count() > 0 ){
                return $next($request);
            }
        }
        return redirect('/login');
    }
}
