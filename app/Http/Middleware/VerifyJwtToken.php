<?php

namespace App\Http\Middleware;

use Closure;

class VerifyJwtToken
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
     
        $bearerToken = $request->bearerToken();

        if($bearerToken != 'teste') {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
    }
}
