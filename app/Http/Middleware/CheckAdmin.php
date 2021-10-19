<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckAdmin
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasRole(['admin']))
            return $next($request);
        else
            return redirect('/admin');
    }
}
