<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Check if user is admin (you can modify this logic based on your user structure)
        if (Auth::user()->role !== 'admin' || Auth::user()->role_id !== 1 ) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}