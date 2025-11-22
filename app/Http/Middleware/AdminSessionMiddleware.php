<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSessionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Set session cookie name untuk admin SEBELUM request diproses
        config(['session.cookie' => 'laravel_session_admin']);
        
        return $next($request);
    }
}
