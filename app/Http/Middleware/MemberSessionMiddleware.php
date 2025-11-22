<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberSessionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Set session cookie name untuk member SEBELUM request diproses
        config(['session.cookie' => 'laravel_session_member']);
        
        return $next($request);
    }
}
