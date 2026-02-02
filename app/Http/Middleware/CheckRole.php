<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @param  string|null  $guard
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role = null, string $guard = 'admin'): Response
    {
        // Check if the user is authenticated using the specified guard
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('admin.login');  // Redirect to admin login if not authenticated
        }

        // Check if the user has the required role (if role is provided)
        if ($role && Auth::guard($guard)->user()->role !== $role) {
            return redirect('/');  // Redirect to a different page if the user doesn't have the required role
        }

        return $next($request);  // Proceed with the request if everything matches
    }
}
