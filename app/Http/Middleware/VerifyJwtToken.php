<?php

namespace App\Http\Middleware;

use App\Auth\Jwt;
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

        $jwt = new Jwt();

        $valid = $jwt->check($bearerToken);

        if(!$valid) {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
        
    }
}
