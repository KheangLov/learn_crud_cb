<?php

namespace App\Http\Middleware;

use Closure;

class MakePostPut
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
        $request->setMethod('PUT');
        return $next($request);
    }
}
