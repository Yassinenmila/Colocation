<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_banned) {
            auth()->logout();
            return redirect()->route('login')->withErrors(['email' => 'Votre compte a été banni. Veuillez contacter le support pour plus d\'informations.']);
        }
        return $next($request);
    }
}
