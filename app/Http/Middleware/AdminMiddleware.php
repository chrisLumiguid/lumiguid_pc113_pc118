<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (Auth::check() && Auth::user()->role == 'admin') {
                return $next($request);
            }
            return response()->json(['message' => 'Unauthorized! You are not an admin!'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error processing request', 'error' => $e->getMessage()], 500);
        }
    }
}

