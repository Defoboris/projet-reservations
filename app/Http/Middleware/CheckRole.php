<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
       $user = $request->user();

        // If not logged in
        if (!$user) {
            return redirect()->route('login');
        }

        // Block "user" role from accessing dashboard/admin routes
        if ($request->is('admin/*') && $user->role === 'user') {
            return redirect()->route('home')
                ->with('error', 'You are not allowed to access the dashboard.');
        }

        // Allow if admin (admin can bypass restrictions)
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Check if the role is allowed
        if (!in_array($user->role, $roles, true)) {
            return redirect()->route('home')
                ->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
