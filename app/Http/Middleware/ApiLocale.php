<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiLocale
{
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale($request->segment(2));
        return $next($request);
    }
}
