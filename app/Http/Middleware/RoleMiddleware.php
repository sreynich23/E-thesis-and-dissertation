<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() && !Auth::guard('student')->check()) {
            return redirect()->route('login');
        }

        $user = Auth::user() ?? Auth::guard('student')->user();

        if ($user->role !== $role) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
