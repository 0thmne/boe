<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'agent') {
            return $next($request);
        }
        
        return redirect('/')->with('error', 'Unauthorized access. Only agents can access this page.');
    }
} 