<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Use the API guard to check the authenticated user
        if (auth('api')->user()->role !== 'admin') {
            return redirect('/home');  // Redirect to a non-admin area
        }

        return $next($request);
    }
}
