<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckOwner
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasRole(['admin', 'owner']))
            return $next($request);
        else
            return redirect('/admin');
    }
}
