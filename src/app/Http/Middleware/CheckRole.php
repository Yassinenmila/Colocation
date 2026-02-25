<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!auth()->check()) {
            return redirect()->route('login')->withErrors(['email' => 'You must be logged in to access this page.']);
        }

        if (Auth::user()->role !== $role) {
            abort(403, "Accès interdit : rôle requis {$role}");
        }
        return $next($request);
    }
}
