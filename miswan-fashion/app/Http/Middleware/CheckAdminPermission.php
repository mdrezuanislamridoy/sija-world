<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to access the admin panel.');
        }

        $admin = Auth::guard('admin')->user();

        if (!$admin->hasPermission($permission)) {
            return redirect()->route('admin.dashboard')->with('error', 'Access Denied: You do not have permission to access that page.');
        }

        return $next($request);
    }
}
