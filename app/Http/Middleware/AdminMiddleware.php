<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized. Admin access required.'], 403);
            }
            return redirect('/')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
