<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level == 2) {
            return redirect()->route('pengiriman.index');
        }

        return $next($request);
    }
}