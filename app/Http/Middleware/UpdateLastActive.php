<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Update last_active only if it's been more than 1 minute since last update
            // to avoid too many database writes
            if (!$user->last_active || $user->last_active->diffInSeconds(now()) > 60) {
                $user->last_active = now();
                $user->save();
            }
        }

        return $next($request);
    }
}
