<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        if ($user = User::where('email', $request->email)->first()) {
            if ($user->role == 'admin') {
                return $next($request);
            }
        }
        return response()->json(['message' => 'Unauthorized'], 401);

    }
}
