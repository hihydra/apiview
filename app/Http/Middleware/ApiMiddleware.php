<?php

namespace App\Http\Middleware;

use Closure;

class ApiMiddleware
{
    public function handle($request, Closure $next)
    {
    	//return $request->route();
        return $next($request);
    }
}
