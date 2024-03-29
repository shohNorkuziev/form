<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next,$role): Response
    {
        if (Auth::user()->role === $role) {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
