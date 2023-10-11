<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Gathoken
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
        if ($request->gathoken == "5525233295GathoBaratoDeveloperHASH") {
            return $next($request);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'unauthorized',
                'No cuentas con los permisos necesarios para consumir este EndPoint'
            ]);
        }
    }
}
