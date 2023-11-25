<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->error([ 'message' => 'token is required', 'code' => 400 ], 400);
        }
        if (!auth()->user()) {
            return response()->error([ 'message' => 'token not valid', 'code' => 401 ], 401);
        }
        return $next($request);
    }
}
