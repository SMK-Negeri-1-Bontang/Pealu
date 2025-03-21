<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request):
     * (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the user is authenticated
        if (\Auth::check()) {
            // Get the authenticated user's role
            $userRole = \Auth::user()->hasRole()->value('role') ?? 'user'; // Default to 'user' if no role found

            // Check if the user's role is allowed to access the route
            if (in_array($userRole, $roles)) {
                return $next($request); // Allow access if the role matches
            }

            // Redirect to the dashboard if the role doesn't match
            return redirect('/dashboard')->with('error', 'You do not have permission to access this page.');
        }

        // If the user is not authenticated, redirect to the login page
        return redirect('/')->with('error', 'Please log in to continue.');
    }
}
