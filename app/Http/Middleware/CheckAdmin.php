<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
