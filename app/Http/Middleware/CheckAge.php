<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAge
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
        if (auth('web')){
            $age = Auth::user()->age;
        }elseif (auth('admin')){
            $age = auth('admin')->age;
        }
        if ($age < 18){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
