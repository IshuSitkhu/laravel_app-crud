<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) { //NOT LOGGED IN(SEND TO LOGIN)
            return redirect()->route('login');
        }

        if (!in_array(Auth::user()->role, $roles)) { //IF ROLE NOT ALLOWED
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}