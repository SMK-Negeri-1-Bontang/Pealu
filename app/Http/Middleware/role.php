<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$allowedRoles): Response
    {
        $user = Auth::user()->load('role'); // Eager loading role

        if (!$user) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!$user->hasRole($allowedRoles)) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
